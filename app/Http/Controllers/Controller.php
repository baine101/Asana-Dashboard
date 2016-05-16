<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Cache\Repository;
use Cache;
use Torann\LaravelAsana\Asana;
use Config;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public $config;
    public $asana;

    public function __construct(){

        //elixir(function(mix) {
        //    mix.sass('app.scss');
        //});

        //define config settings and make new instance
        $this->config = Config::get('asana');
        $this->asana = new Asana($this->config);
    }

    public function workspace(){

        global $workspace;

        //define config settings and make new instance
        $this->config = Config::get('asana');
        $this->asana = new Asana($this->config);

        //get workspace object
        $workspace = $this->asana->getWorkspaces();

        //convert workspace object to string
        $workspace = json_decode(json_encode($workspace), true);
        
        return $workspace;
        //close workspace function
    }

    public function users($workspaceId){

        //get all users in the workspace assign them to userNameArray
        $userNameArray = $this->asana->getWorkspaceUsers($workspaceId);

        //convert name object to string
        $userNameArray = json_decode(json_encode($userNameArray), true);
        
        return $userNameArray;
        //close users function
    }

    public function tasks($workspace, $userNameId){

        //call get workspace tasks
        $tasks = $this->asana->getWorkspaceTasks($workspace, $userNameId);

        //convert tasks object to string
        $tasks = json_decode(json_encode($tasks), true);

        $tasks2 = array_slice($tasks['data'] ,0 ,6);


        return $tasks2;
        //close tasks function
    }



    public function buildArray(){

        $masterArray = array();


        //return the workspace array
        $workspace = $this->workspace();
        $workspace = $workspace['data'];

        foreach($workspace as $wsKey => $wsData) {


            $wsId = $wsData['id'];

                    if(array_key_exists('name' ,$wsData)  && !isset($wsData['name'])) {
                    echo"nope workspace";

                    }else{
                            //set first array elements to be workspaces
                            $masterArray[$wsKey] = $wsData;

                    }
                    //call users function
                    $users = $this::users($wsId);
                    //convert users object to string
                    $users = json_decode(json_encode($users), true);


                    foreach ($users['data'] as $userKey => $userData) {

                            $userId = $userData['id'];

                            if (array_key_exists('name' ,$userData) && !isset($userData['name'])){
                                echo"nope user ";


                                //close if userData
                            }else{
                                //set second array elements to be users
                                $masterArray[$wsKey]['users'][$userKey] = $userData;
                            }


                        //call tasks function
                        $tasks = $this::tasks($wsId, $userId);

                        foreach ($tasks as $taskWrapperKey => $taskWrapper) {



                                if (!array_key_exists('name', $taskWrapper) && !isset($taskWrapper['name'])) {


                                    echo "nope task ";
                                    //close if taskData

                                } else {
                                    
                                     //set third array elements to be tasks
                                    $masterArray[$wsKey]['users'][$userKey]['tasks'][] = $taskWrapper;


                                }

                        //close foreach task array
                        }
                    //close foreach userNameArray
                    }
        //close foreach workspace id
        }

        //dd($taskWrapper,$userData,$wsData);

        $masterArray = json_decode(json_encode($masterArray),true);

        return $masterArray;
    //close function buildArray
    }
//close controller class
}

