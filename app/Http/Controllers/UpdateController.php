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
                //for debug
                //$masterArray = Controller::buildArray();

            }else{

                $masterArray = Controller::buildArray();

                Cache::put('asanaData',$masterArray , 15);

            }
            //return $value;
        }

}
