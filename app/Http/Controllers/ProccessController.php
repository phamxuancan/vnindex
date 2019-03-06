<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vnindex;

class ProccessController extends Controller
{
    public function pullData(){
        try{
            $url = 'https://price-cmchn-02.vndirect.com.vn/priceservice/secinfo/snapshot/q=floorCode:10';
            $curlSession = curl_init();
            curl_setopt($curlSession, CURLOPT_URL, $url);
            curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
            $jsonData = json_decode(curl_exec($curlSession));
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
                Vnindex::insert($total_data_insert);
            }
            curl_close($curlSession);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
