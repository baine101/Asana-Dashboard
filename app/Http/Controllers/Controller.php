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

        //$tasks2 = array_slice($tasks['data'], 0, 6);
        $tasks2 = $tasks['data'];

        return $tasks2;
        //close tasks function
    }

    public function buildArray()
    {
        $totalTasks = 0;
        $wsActive = false;

        $masterArray = array();


        //return the workspace array
        $workspace = $this->workspace();
        $workspace = $workspace['data'];

        foreach ($workspace as $wsKey => $wsData) {


            $wsId = $wsData['id'];

            if (array_key_exists('name', $wsData) && !isset($wsData['name'])) {
                echo "nope workspace";

            } else {
                //set first array elements to be workspaces


                $masterArray[$wsKey] = $wsData;

                $masterArray[$wsKey]['active'] = $wsActive;

            }
            //call users function
            $users = $this->users($wsId);
            //convert users object to string
            $users = json_decode(json_encode($users), true);

            foreach ($users['data'] as $userKey => $userData) {

                $userId = $userData['id'];



                if (!array_key_exists('name', $userData) or !isset($userData['name'])) {

                    echo "nope user ";
                } else {

                    $true = true;

                    //set second array elements to be users

                    $masterArray[$wsKey]['users'][$userKey] = $userData;
                    //$masterArray[$wsKey]['active'] = $true;
                }

                //call tasks function
                $tasks = $this::tasks($wsId, $userId);

                foreach ($tasks as $taskWrapperKey => $taskWrapper) {


                    if (!array_key_exists('id', $taskWrapper) or !isset($taskWrapper['name'])) {


                        $masterArray[$wsKey]['active'] = false;

                        echo "nope task ";
                        //close if taskData

                    } else {

                        if (!array_key_exists('id', $taskWrapper)) {


                            $masterArray[$wsKey]['active'] = false;

                        }

                        //set third array elements to be tasks
                        $masterArray[$wsKey]['active'] = true;

                        $totalTasks ++;
                        $masterArray[$wsKey]['users'][$userKey]['tasks'][] = $taskWrapper;



                    }
                    //close foreach task array

                }

              /*
                foreach($masterArray as $masterKey => $masterData) {

                    $users = $masterArray[$masterKey]['users'];

                    foreach ($users as $userKey => $userData) {


                      $tasks = $userData['tasks'];
                        //dd($tasks);
                        $taskCount = count($tasks);

                        $totalTasks = $totalTasks + $taskCount;

                    }
                }
                */

            //close foreach userNameArray
            }
        //close foreach workspace id
        }


        $masterArray = json_decode(json_encode($masterArray), true);

        dd($totalTasks);

        return $masterArray;
    //close function buildArray
    }
//close controller class
}


