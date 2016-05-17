<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Cache;

class DisplayController extends UpdateController
{
    public  function display(){

        if(Cache::has('asanaData')){

            //get the master value from cache
            $value = Cache::get('asanaData');

            UpdateController::cacheIn();

            return view('welcome', compact("value"));


            //return cache
        }else{

            //store something in the cache
            UpdateController::cacheIn();

            $value = Cache::get('asanaData');

            return view('welcome', compact("value"));
        }


    }

}
