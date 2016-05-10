<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Torann\LaravelAsana\Asana;
use Config;
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    public function buildArray()
    {
        global $usernameId;
        global $username;

        //define config settings and make new instance
        $config =  Config::get('asana');
        $asana = new Asana($config);


        //get all users in the workspace
        $userNameArray = $asana->getWorkspaceUsers($config['workspaceId']);

        //convert name array to string objects
        $userNameArray = json_decode(json_encode($userNameArray), true);

         var_dump($userNameArray);

        //for loop to get all users ids / increment counter
        /*    for ($i=0 ; ;$i++) {

                // if the array elements are not empty
                if (!isset($userNameArray['data'][$i]['id'])) {

                    break;}
                else{


                    //individual name ids
                    $usernameId = json_encode($userNameArray['data'][$i]['id']);
                    $username = json_encode($userNameArray['data'][$i]['name']);


                    //get tasks for users
                    $usersTasks = $asana->getTasksByFilter([
                        'assignee' => $usernameId,
                        'workspace' => $config['workspaceId']
                    ]);

                    //convert to string
                   $usersTasks = json_decode(json_encode($usersTasks), true);

                    //assign userTasks the tasks array accordingly
                    $usersTasks = $asana->getTask($usersTasks['data'][0]['id']);



                    $userData = array("userId" => $usernameId , "username" => $username,"tasks" => $usersTasks);

                    //   var_dump($userData);




                //close if isset
                }

            //close for loop
            }

           */

        //return view('welcome', compact("userNameArray"));
        //close build array function
    }


//close controller class
}