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
    public $totalTasks;


    public function __construct()
    {


        //define config settings and make new instance
        $this->config = Config::get('asana');
        $this->asana = new Asana($this->config);
    }

    public function workspace()
    {

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

    public function users($workspaceId)
    {

        //get all users in the workspace assign them to userNameArray
        $userNameArray = $this->asana->getWorkspaceUsers($workspaceId);


        //convert name object to string
        $userNameArray = json_decode(json_encode($userNameArray), true);

        return $userNameArray;
        //close users function
    }

    public function tasks($workspace, $userNameId)
    {

        //call get workspace tasks (workspace id , usernameId)

        $tasks = $this->asana->getWorkspaceTasks($workspace, $userNameId);

        //convert tasks object to string
        $tasks = json_decode(json_encode($tasks), true);

        $this->totalTasks += count($tasks['data']);


        return $tasks;
        //close tasks function
    }

    public function limitTasks($tasks){

        $tasks = array_slice($tasks['data'], 0, 6);

        return $tasks;
    }




    public function buildArray()
    {
        $wsActive = false;
        $wsKey = "";
        $userTaskCount = null;
        $masterArray = array();
        $totalTasks = 0;


        //return the workspace array
        $workspace = $this->workspace();
        $workspace = $workspace['data'];

        foreach ($workspace as $wsKey => $wsData) {


            $wsId = $wsData['id'];

            if (!array_key_exists('name', $wsData) or !isset($wsData['name'])) {

                $masterArray[$wsKey] = 'false';

            }else {
                //set first array elements to be workspaces
                $masterArray[$wsKey] = 'true';

                $masterArray[$wsKey] = $wsData;
                $masterArray[$wsKey]['active'][] = 'true';
            }

            //call users function
            $users = $this->users($wsId);
            //convert users object to string
            $users = json_decode(json_encode($users), true);

            foreach ($users['data'] as $userKey => $userData) {

                $userId = $userData['id'];



                if (!array_key_exists('name', $userData) or !isset($userData['name'])) {

                    $masterArray[$wsKey]['active'] = false;

                }else {

                    $masterArray[$wsKey]['active'] = 'true';

                    //add second array elements to workspace witch is users
                    $masterArray[$wsKey]['users'][$userKey] = $userData;

                }


                //call tasks function
                $tasks = $this::tasks($wsId, $userId);


                foreach ($tasks as $taskWrapperKey => $taskWrapper) {


                    foreach($taskWrapper as $taskKey => $taskData) {


                        if (!array_key_exists('name', $taskData) or !isset($taskData['name'])){

                        } else {
                            $userTaskCount = count($taskWrapper);

                            var_dump($userTaskCount);
                        }

                        $taskLimit = $this::limitTasks($tasks);


                        $taskLimit = json_decode(json_encode($taskLimit), true);




                         if (array_key_exists('name', $taskWrapper) or isset($taskWrapper['name'])) {

                            $masterArray[$wsKey]['active'] = 'false';

                         }else {
                            $masterArray[$wsKey]['active'] = 'true';


                             //add task array to master array
                             $masterArray[$wsKey]['users'][$userKey]['tasks'] = $taskLimit;
                             $masterArray[$wsKey]['users'][$userKey]['taskCount'] = $userTaskCount;

                             if (!array_key_exists('users', $wsData) or !isset($wsData['users'])) {

                            $masterArray[$wsKey]['totalTasks'] = $this->totalTasks;
                            }
                         }
                    }

                }

            }
            $masterArray[$wsKey]['active'] = $wsActive;

        }

       // dd($this->totalTasks);
        global $userKey;

        foreach($masterArray as $masterKey => $masterData){

            if(!isset($masterData['users'])) {

            }else {
                $userData = $masterData['users'];

                foreach ($userData as $userKey => $data) {


                    global $percent;


                    //    dd($masterArray[$masterKey]['users'][$userKey]);

                    if (!isset($masterArray[$masterKey]['users'][$userKey]['name'])) {

                    }else {


                        $percDiv = $userTaskCount / $this->totalTasks;
                        $percent = $percDiv * 100;

                        
                        $masterArray[$wsKey]['users'][$userKey]['percent'] = $percent;
                    }//dd($percent);
                }
            }
        }


        //dd($masterArray[$wsKey]['users']);
       // dd(array_sum());
        dd($masterArray);



       // dd($this->totalTasks );


        $masterArray = json_decode(json_encode($masterArray), true);




        return $masterArray;
    //close function buildArray
    }
//close controller class
}


