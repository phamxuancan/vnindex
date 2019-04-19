<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vnindex;
use App\Stock;
use GuzzleHttp\Client;
use DB;
class ProccessController extends Controller
{
    public function pullData(){
        try{
//            echo phpinfo();die;

            $url = 'https://price-cmchn-02.vndirect.com.vn/priceservice/secinfo/snapshot/q=floorCode:10';
            $data = file_get_contents($url);
            $jsonData = json_decode($data);
            $dataAll = $jsonData->{'10'};
            if(count($dataAll)){
                $date = date('Y-m-d');
                Vnindex::where('ngaythang',$date)->delete();
                $total_data_insert = array();
                $i=0;
                foreach($dataAll as $data){
                    $convert_to_array = explode('|',$data); 
                    $code = $convert_to_array['3'];
                    $tcToday = $convert_to_array['19'];
                    $klToday = $convert_to_array['36'];
                    $nnmua = $convert_to_array['37'];
                    $nnban = $convert_to_array['38'];
                    $tchomqua = $convert_to_array['8'];
                    $data_insert = array(
                        'code' => $code,
                        'thamchieu' => (float)$tcToday,
                        'khoiluong' => $klToday,
                        'nnmua' => (int)$nnmua,
                        'nnban' => (int)$nnban,
                        'ngaythang' => $date,
                        'tchomqua' => (float)$tchomqua
                    );
                    array_push($total_data_insert,$data_insert);
                }
                // dd($total_data_insert);
                Vnindex::insert($total_data_insert);
                return response()->json([
                    'status' => 200,
                    'message' => 'success'
                ]);
            }
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function displayVNindex(Request $request){
        $date = Vnindex::orderBy('id','DESC')->first()->toArray();
        $date = $date['ngaythang'];
        if($request->code){
            $datas = Vnindex::with('stock')
            ->where('code','=',$request->code)
            ->get()->toArray();
        }elseif($request->desc){
            $results = DB::select( DB::raw("SELECT CODE,SUM(nnmua) as tong1 ,SUM(nnban) as tong2,(SUM(nnmua)-SUM(nnban)) as nfsdf FROM vnindexs GROUP BY code HAVING nfsdf > 0 ORDER BY nfsdf DESC"));
            // $datas = Vnindex::with('stock')->sum('nnmua')->groupBy('code');
        }elseif($request->asc){

        }
        elseif($request->from){
            $datas = Vnindex::with('stock')
            ->where('thamchieu','>',(int)$request->from)
            ->where('thamchieu','<=',(int)$request->to)
            ->where('ngaythang',$date)
            ->where('khoiluong','>',10000)
            ->orderby('thamchieu','ASC')
            ->get()->toArray();
        }elseif($request->nnban){
            $datas = Vnindex::with('stock')
            ->where('nnban','>=',(int)$request->nnban)
            ->where('ngaythang',$date)
            ->where('khoiluong','>',10000)
            ->orderby('nnmua','DESC')
            ->get()->toArray();
        }elseif($request->nnmua){
            $datas = Vnindex::with('stock')
            ->where('nnmua','>',(int)($request->nnmua))
            ->where('ngaythang',$date)
            ->where('khoiluong','>',20000)
            ->orderby('nnmua','DESC')
            ->get()->toArray();
        }elseif($request->category){
            $categoryName = $request->category;
            $datas = Vnindex::with('stock')->whereHas('stock', function($query) use ($categoryName){
                return $query->where('industryName', $categoryName);
            })
            ->get()->toArray();
        }else{
            $datas = Vnindex::with('stock')->get()->toArray();
        }
        $array_by_date = [];
        $data_date = [];
        foreach($datas as $data){
            // dd($data);
            $array_by_date[$data['code']][] = $data;
            if(!in_array($data['ngaythang'],$data_date)){
                array_push($data_date,$data['ngaythang']);
            }
        }
        // dd($data_date);
        // dd($array_by_date);
         return response()->json([
            'array_by_date' => $array_by_date,
            'data_date' => $data_date
        ]);
    }
    public function generateStock(){
        try{
            $url = 'https://finfo-api.vndirect.com.vn/stocks';
            $data = file_get_contents($url);
            $jsonData = json_decode($data,true);
            $stock_list = $jsonData['data'];
            if(count($stock_list)){
                Stock::insert($stock_list);
            }
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function updateEPSVNINDEX(){
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $Machungkhoan = Stock::select('symbol','id')->where('floor', 'HOSE')->get()->toArray();
        foreach($Machungkhoan as $code){
            $response = $client->request('POST', 'https://finance.vietstock.vn/company/tradinginfo',[
                'connect_timeout' => 4000,
                'form_params' => [
                    'code' => $code['symbol'],
                    's' => 0,
                ]
            ]);
            $body = json_decode($response->getBody(),true);
            $status = $response->getStatusCode();
                if($status == 200){
                    $body = json_decode($response->getBody(),true);
                    $stock = Stock::find($code['id']);
                    $stock->eps = $body['EPS'];
                    $stock->pe = $body['PE'];
                    $stock->save();
                    echo 'success'. $code['symbol'] .'<br/>' ;
                }else{
                    echo 'fail';
                }
            }
    }
    public function sort(Request $request){
        if($request->asc){
            $results = DB::select( DB::raw("SELECT code,SUM(nnmua) as tong_mua ,SUM(nnban) as tong_ban,(SUM(nnban)-SUM(nnmua)) as nfsdf FROM vnindexs GROUP BY code HAVING nfsdf > 5000 ORDER BY nfsdf DESC"));
            // $datas = Vnindex::with('stock')->sum('nnmua')->groupBy('code');
        }elseif($request->desc){
            $results = DB::select( DB::raw("SELECT code,SUM(nnmua) as tong_mua ,SUM(nnban) as tong_ban,(SUM(nnmua)-SUM(nnban)) as nfsdf FROM vnindexs GROUP BY code HAVING nfsdf > 5000 ORDER BY nfsdf DESC"));
            // $datas = Vnindex::with('stock')->sum('nnmua')->groupBy('code');
        }
        return view('sort',compact('results'));
    }   
}
