<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use App\Vnindex;
use App\Stock;
use GuzzleHttp\Client;
use DB;

class PullDatas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:pulldata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull data from website';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->pullData();
        Mail::to('kudo2616@gmail.com')->send(new OrderShipped());
        //
    }
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
}
