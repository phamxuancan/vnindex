<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vnindex;
use App\Stock;
use GuzzleHttp\Client;
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
                foreach($dataAll as $data){
                    $convert_to_array = explode('|',$data);
                    $code = $convert_to_array['3'];
                    $tcToday = $convert_to_array['23'];
                    $klToday = $convert_to_array['36'];
                    $nnmua = $convert_to_array['37'];
                    $nnban = $convert_to_array['38'];
                    $data_insert = array(
                        'code' => $code,
                        'thamchieu' => $tcToday,
                        'khoiluong' => $klToday,
                        'nnmua' => $nnmua,
                        'nnban' => $nnban,
                        'ngaythang' => $date
                    );
                    array_push($total_data_insert,$data_insert);
                }
                // dd($total_data_insert);
                Vnindex::insert($total_data_insert);
            }
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function displayVNindex(Request $request){
        if($request->category){
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
        return view('vnindex',compact('array_by_date','data_date'));
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
}
