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

        $tasks = $this->asana->getWorkspaceTasks($workspace, $userNameId ,'completed');

        //convert tasks object to string
        $tasks = json_decode(json_encode($tasks), true);

        $this->totalTasks += count($tasks['data']);


        return $tasks;
        //close tasks function
    }
/**
    public function completedTasks()
    {

            $workspace = $this->workspace();
            $workspaceId = null;
        foreach($workspace as $wsWrapperKey => $wsWrapper) {

            foreach($wsWrapper as $wsKey => $wsData){

                $workspaceId = $wsData['id'];
                $userWrapper = $this->users($workspaceId);

                foreach($userWrapper as $userKey => $userData)
                {
                    foreach($userData as $userItemKey => $userItem) {

                        global $userId;


                        $userId = $userItem['id'];


                    }
                }

            }
        }

        $compTasks = $this->asana->getCompletedWorkspaceTasks($workspace, $userId);
        dd($compTasks);

        return $compTasks;

    }
*/


    public function limitTasks($tasks){

        $tasks = array_slice($tasks['data'], 0, 6);

        return $tasks;
    }

    public function percent($masterArray)
    {

        foreach ($masterArray as $wsKey => $wsData) {

            if (array_key_exists('totalTasks', $wsData) or isset($wsData['totalTasks'])){

                $tasksTotal = $wsData['totalTasks'];
                $users = $wsData['users'];

                foreach ($users as $userKey => $userData) {

                    $userTasksTotal = $userData['taskCount'];

                    $perDiv = $userTasksTotal / $tasksTotal;
                    $percent = $perDiv * 100;

                    $percent = round($percent , 3);

                    $masterArray[$wsKey]['users'][$userKey]['percent'] = $percent;


                }

            }else{
                //do nothing
            }

        }
        return $masterArray;
    }



    public function buildArray()
    {
       // $this->completedTasks();


        $wsActive = false;
        $wsKey = "";
        $masterArray = array();
        $totalTasks = 0;


        //return the workspace array
        $workspace = $this->workspace();
        $workspace = $workspace['data'];

        foreach ($workspace as $wsKey => $wsData) {

            $userTaskCount = 0;
            $wsId = $wsData['id'];
            $taskKey = null;
            $userKey = null;

            if (!array_key_exists('name', $wsData) or !isset($wsData['name'])) {

                $masterArray[$wsKey] = 'false';

            }else {
                //set first array elements to be workspaces
                $masterArray[$wsKey] = 'true';

                $masterArray[$wsKey] = $wsData;
                $masterArray[$wsKey]['active'] = 'true';
            }

            //call users function
            $users = $this->users($wsId);
            //convert users object to string
            $users = json_decode(json_encode($users), true);


            foreach ($users['data'] as $userKey => $userData) {

                $userId = $userData['id'];


            $userTaskCount = 0;

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

        $masterArray2 = $this->percent($masterArray);

        $masterArray2 = json_decode(json_encode($masterArray2), true);



        return $masterArray2;
    //close function buildArray
    }
//close controller class
}


