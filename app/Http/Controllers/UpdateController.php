<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cache;

class UpdateController extends Controller
{




        public function cacheIn(){

            if(Cache::has('asanaData')){

                echo"bunya";


            }else{
                $masterArray = Controller::buildArray();



                $value = json_decode(json_encode($masterArray),true);


                Cache::put('asanaData',$masterArray, 15);
            }
            //return $value;
        }
    /*
        /* public function cacheOut()
        {



             if(Cache::has('asanaData')){
                 $value = Cache::get('asanaData');
                echo number_format((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]),3);
                //return view('welcome', compact("value"));
                return $value;
             }else{
                $this->cacheIn();
                $value = Cache::get('asanaData','Nothing stored in cache');
                //return view('welcome', compact("value"));
                return $value;
            }

     }
*/



}
