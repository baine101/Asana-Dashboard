<?php

namespace App\Http\Controllers;

use Response;
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
    public $workspace;
    public $tasks;


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

    public function limitTasks($tasks)
    {

        $limTasksArray = [];

        $limTasks = array_slice($tasks, 0, 6);

        $limTasksArray[] = $limTasks;
        $limTasksArray[] = $tasks;

       // dd($limTasksArray);
        return $limTasksArray;

    }

    public function tasks($workspace, $userNameId)
    {

        //call get workspace tasks (workspace id , usernameId)

        $tasks = $this->asana->getWorkspaceTasks($workspace, $userNameId);

        //convert tasks object to string
        $tasks = json_decode(json_encode($tasks), true);

        $taskWrapper = null;

        foreach($tasks as $taskWrapKey => $taskWrapper);

        //if their is a bunch of tasks set in an array
        if(isset($taskWrapper)){

            //for each task
            foreach ($taskWrapper as $taskKey => $taskData) {

                    if(array_key_exists($taskKey,$taskWrapper) or isset($taskData['id'])) {

                        if ($taskWrapper[$taskKey]['completed'] == true){

                            unset($tasks['data'][$taskKey]);
                        }

                    }
                }
            }



        $this->totalTasks += count($tasks['data']);


        return $tasks;
        //close tasks function
    }

    public function percent($masterArray)
    {

        foreach ($masterArray as $wsKey => $wsData) {

            if (array_key_exists('totalTasks', $wsData) or isset($wsData['totalTasks'])) {

                $tasksTotal = $wsData['totalTasks'];
                $users = $wsData['users'];

                foreach ($users as $userKey => $userData) {

                    $userTasksTotal = $userData['taskCount'];

                    $perDiv = $userTasksTotal / $tasksTotal;
                    $percent = $perDiv * 100;

                    $percent = round($percent, 3);

                    $masterArray[$wsKey]['users'][$userKey]['percent'] = $percent;


                }

            } else {
                //do nothing
            }

        }
        return $masterArray;
    }

    public function buildArray()
    {


        global $wsKey;
        global $userKey;
        global $taskData;
        $masterArray = array();


        //return the workspace array
        $workspace = $this->workspace();
        $workspace = $workspace['data'];


        //loops through the workspaces
        foreach ($workspace as $wsKey => $wsData) {

            $wsId = $wsData['id'];
            $taskKey = null;
            $userKey = null;
            //if their is a key set then set first array elements to be workspaces
            if (array_key_exists('name', $wsData) or isset($wsData['name'])) {

                $masterArray[$wsKey] = $wsData;
                $masterArray[$wsKey]['active'] = false;
            }


            //call users function
            $users = $this->users($wsId);
            //convert users object to string
            $users = json_decode(json_encode($users), true);

            $userCount = count($users['data']);
            $masterArray[$wsKey]['userCount'] = $userCount;





            //loops through each user in the workspace
            foreach ($users['data'] as $userKey => $userData) {

                $userId = $userData['id'];

                $userTaskCount = 0;

                if (!array_key_exists('name', $userData) or !isset($userData['name'])) {


                    $masterArray[$wsKey]['active'] = true;
                } else {

                    $masterArray[$wsKey]['active'] = false;
                }

                //add second array elements to workspace witch is users
                $masterArray[$wsKey]['users'][$userKey]['id'] = $userId;
                $masterArray[$wsKey]['users'][$userKey]['name'] = $userData['name'];
                $masterArray[$wsKey]['users'][$userKey]['photo'] = $userData['photo']['image_27x27'];




                //call tasks function
                $tasks = $this::tasks($wsId, $userId);

                foreach ($tasks as $taskWrapperKey => $taskWrapper) {


                    foreach ($taskWrapper as $taskKey => $taskData) {

                        if (!array_key_exists('name', $taskData) or !isset($taskData['name'])) {
                        } else {

                            if ($taskData['completed'] == false) {

                                $userTaskCount++;

                            } else {
                            }
                        }


                        if (!array_key_exists('name', $taskWrapper) or !isset($taskWrapper['name'])) {

                            $masterArray[$wsKey]['active'] = true;

                        } else {

                            $masterArray[$wsKey]['active'] = false;

                        }


                        //add task array to master array
                        $masterArray[$wsKey]['users'][$userKey]['taskCount'] = $userTaskCount;
                        $masterArray[$wsKey]['users'][$userKey]['tasks'] = $tasks;


                        if (!array_key_exists('users', $wsData) or !isset($wsData['users'])) {

                            $masterArray[$wsKey]['totalTasks'] = $this->totalTasks;

                        }

                    }


                }
            }

        }


        $masterArray = $this->percent($masterArray);

        //if  is set do this  :: or if user isn't set don't do this
        foreach ($masterArray as $wsKey => $wsData) {

            if (isset($wsData['users'])) {
                //if user is set do this  :: or if user isnt set dont do this

                foreach ($wsData['users'] as $userKey => $user) {


                    if(isset($user['tasks'])) {


                        //var_dump($user['tasks']['data']);

                         $taskArray = $user['tasks']['data'];

                        dd($taskArray);


                        //limit tasks to 6
                        $taskLimit = $this::limitTasks($taskArray);

                        $taskLimit = json_decode(json_encode($taskLimit), true);

                        $masterArray[$wsKey]['users'][$userKey]['tasks'] = $taskLimit;

                    }
                }


            }
        }

        $masterArray2 = json_decode(json_encode($masterArray), true);

        return $masterArray2;
    }
//close controller class
}


