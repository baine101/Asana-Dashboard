<?php

namespace App\Http\Controllers;

ini_set('display_errors', 'On');
error_reporting(E_ALL);

use Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as javascript;
use App\Http\Controllers\UpdateController as UpdateController;
use Cache;

class DisplayController extends Controller
{
    public function display(){

        if(Cache::has('asanaData')){

            //$cacheIn = new UpdateController;
            //store something in the cache
            //$cacheIn->cacheIn();


            //get the master value from cache
            $masterArray = Cache::get('asanaData');

            $jsArray = array();

            foreach ($masterArray as $wsKey => $wsData) {

                if($wsData['active'] == true) {

                    $users = $wsData['users'];
                    $totalTasks =$wsData['totalTasks'];

                    foreach ($users as $userKey => $userData) {


                        $username =$userData['name'];
                        $taskCount = $userData['taskCount'];

                        $jsSub = array($username,$taskCount,$totalTasks);

                        $jsArray[$userKey] = $jsSub;


                    }

                }

            }


            return view('welcome', compact("masterArray", "jsArray"));


            //return cache
        }else {

            $cacheIn = new UpdateController;
            //store something in the cache
            $cacheIn->cacheIn();

            $masterArray = Cache::get('asanaData');

            $jsArray = array();


            foreach ($masterArray as $wsKey => $wsData) {

                if ($wsData['active'] == true) {

                    $users = $wsData['users'];
                    $totalTasks = $wsData['totalTasks'];


                    foreach ($users as $userKey => $userData) {


                        $username = $userData['name'];
                        $taskCount = $userData['taskCount'];

                        $jsSub = array($username, $taskCount, $totalTasks);

                        $jsArray[$userKey] = $jsSub;


                    }

                }

            }

            $jsArray = json_encode($jsArray);

           return view('welcome', compact("masterArray", "jsArray"));
        }

    }


}