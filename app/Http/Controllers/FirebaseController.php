<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Kreait\Firebase\Contract\Database;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class FirebaseController extends Controller
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    private function updateSessionList()
    {
        $user = Session::get('user');


        $userLists = json_encode($this->database->getReference('userTasks/' . $user['username'])->getValue());
        $userValue = $this->database->getReference('users/' . $user['username'] . '/completedTasks')->getValue();

        $userWithNewList = [
            "username" => $user['username'],
            "email" => $user['email'],
            "name" => $user['name'],
            "lists" => $userLists,
            "completedTasks" => $userValue
        ];

        Session::put('user', $userWithNewList);
    }

    function sanitize($input)
    {
        // removes whitespace from ends
        $input = trim($input);
        // removes backslashes
        $input = stripslashes($input);
        // converts special characters to HTML entities
        $input = htmlspecialchars($input);
        return $input;
    }

    public function loginValidation(Request $request)
    {
        $rules = [
            'username' => 'required|string|max:15|regex:/^[a-zA-Z\s]+$/',
            'password' => 'required|string|min:5|max:20|',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $validator->errors()->toArray(); // Return errors indicate validation failure
        }


        $providedUsername = $request->username;


        $userExists = $this->database->getReference('users/' . $providedUsername)->getSnapshot()->exists();


        if (!$userExists) {
            return ['user' => 'Username does not exist'];
        }

        // Return an empty array to indicate successful validation
        return [];
    }

    //user update validation --------------------------------------------------
    public function updateValidation(Request $request)
    {

        $request->validate([
            'name' => ['required','string','min:5','max:15'],
            'password' => ['required','string','min:5','max:20'],
        ]);

        // $rules = [
        //     'name' => 'required|string|max:15|',
        //     'password' => 'required|string|min:5|max:20|',
        // ];

        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //     return $validator->errors()->toArray(); // Return errors indicate validation failure
        // }

        // // Return an empty array to indicate successful validation
        // return [];
    }

    public function registerValidation(Request $request)
    {
        

        $request->validate([
            'username' => ['required','string','max:15','regex:/^[a-zA-Z\s]+$/'],
            'password' => ['required','string','min:5','max:20'],
            'name' => ['required','string','max:30'],
            'email' => ['required' ,'email','max:255' ],
        ]);

        $providedUsername = $request->username;

        $userExists = $this->database->getReference('users/' . $providedUsername)->getSnapshot()->exists();

        if ($userExists) {
            return ['user' => 'Username already exists'];
        }
    }


    public function listValidation(Request $request)
    {
        $request->validate([
            'list' => ['required','string','max:20'],
            'priority' => ['required','integer','between:1,3'],
            'date' => ['required','date'],
            'color' => ['required' ,'string','regex:/^#[0-9a-fA-F]{6}$/' ],
        ]);


        // $rules = [
        //     'list' => 'required|string|max:10|regex:/^[a-zA-Z\s]+$/',
        //     'priority' => 'required|integer|between:1,3',
        //     'date' => 'required|date',
        //     'color'    => 'required|string|regex:/^#[0-9a-fA-F]{6}$/',
        //     //'taskDisplay' => 'required|string|max:25|regex:/^[a-zA-Z\s]+$/',
        // ];


        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //     return $validator->errors()->toArray(); // Return errors indicate validation failure
        // }

        // $listName = $request->listName;

        // $listExists = $this->database->getReference('lists/' . $listName)->getSnapshot()->exists();

        // if ($listExists) {
        //     return ['listName' => 'listName already exists'];
        // }

        // // Return an empty array to indicate successful validation
        // return [];
    }

    public function taskValidation(Request $request)
    {

        $request->validate([
            'taskDisplay' => ['required','string','max:50'],
        ]);

        // $rules = [

        //     'taskDisplay' => 'required|string|max:100|',
        // ];

        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //     return $validator->errors()->toArray(); // Return errors indicate validation failure
        // }

        // // Return an empty array to indicate successful validation
        // return [];
    }

    // public function validation(Request $request)
    // {
    //     $rules = [
    //         'username' => 'required|string|max:15|regex:/^[a-zA-Z\s]+$/',
    //         'password' => 'required|string|min:5|max:20|',
    //         'email' => 'required|email|max:255',
    //         'name' => 'required|string|max:10|regex:/^[a-zA-Z\s]+$/',
    //         'listName' => 'required|string|max:10|regex:/^[a-zA-Z\s]+$/',
    //         'date' => 'required|date',
    //         'color'    => 'required|string|regex:/^#[0-9a-fA-F]{6}$/',
    //         'priority' => 'required|integer|between:1,3',
    //         'taskDisplay' => 'required|string|max:25|regex:/^[a-zA-Z\s]+$/',
    //         // Add more validation rules for other fields
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         // Handle validation errors if needed
    //         return $validator->errors()->toArray(); // Return errors indicate validation failure
    //     }


    //     // Check if username and listName already exist in Firebase
    //     $providedUsername = $request->username;
    //     $listName = $request->listName;

    //     $userExists = $this->database->getReference('users/' . $providedUsername)->getSnapshot()->exists();
    //     $listExists = $this->database->getReference('lists/' . $listName)->getSnapshot()->exists();

    //     if ($userExists) {
    //         return ['user' => 'Username already exists'];
    //     }
    //     if ($listExists) {
    //         return ['listName' => 'listName already exists'];
    //     }

    //     // Return an empty array to indicate successful validation
    //     return [];
    // }


    // ----------------------
    // -------- USER --------
    // ----------------------
    public function registerFunc(Request $request)
    {
        
        $validationResult = $this->registerValidation($request);

        if (empty($validationResult)) {

            $providedUsername = $this->sanitize($request->username);
            $providedEmail = $this->sanitize($request->email);
            $providedName = $this->sanitize($request->name);
            $providedPassword = $this->sanitize($request->password);


            $dataToSave = [
                "username" => $providedUsername,
                "email" => $providedEmail,
                "name" => $providedName,
                "password" => encrypt($providedPassword),
                "completedTasks" => 0
            ];

            //this should run only after validation
            $this->database->getReference('users/' . $dataToSave['username'])->set($dataToSave);

            $user = [
                "username" => $dataToSave['username'],
                "email" => $dataToSave['email'],
                "name" => $dataToSave['name'],
                "lists" => [],
                "completedTasks" => 0
            ];

            Session::put('user', $user);
            Session::put('logged', true);
            $this->loginDisplay();

            return redirect()->route('home');
        } else {
            // render same page with $validationResult (that is a array of errors)
        }
    }

    public function loginDisplay()
    {
        if (Session::get('logged')) {

            $this->updateSessionList();

            return Inertia::render('Home', Session::get('user'));
        }

        return Inertia::render('Landing');
    }

    public function loginFunc(Request $request)
    {
        $validationResult = $this->loginValidation($request);

        if (empty($validationResult)) {
            $providedPassword = $this->sanitize($request->password);
            $providedUsername = $this->sanitize($request->username);

            $userFromDB = $this->database->getReference('users/' . $providedUsername)->getValue();


            if (decrypt($userFromDB['password']) == $providedPassword) {
                $user = [
                    "username" => $userFromDB['username'],
                    "email" => $userFromDB['email'],
                    "name" => $userFromDB['name'],
                    "lists" => [],
                    "completedTasks" => $userFromDB['completedTasks'],
                ];

                Session::put('user', $user);
                Session::put('logged', true);

                return redirect()->route('home');
            } else {
                return redirect()->route('landing');
            }
        } else {
            // render same page with $validationResult (that is a array of errors)
        }
    }

    public function updateUser(Request $request)
    {
        $validationResult = $this->updateValidation($request);

        if (empty($validationResult)) {
            $providedPassword = $this->sanitize($request->password);

            $user = Session::get('user');

            $name = $this->sanitize($request->name) ?? $user['name'];

            if ($providedPassword) {
                $this->database->getReference('users/' . $user['username'] . '/password')->set(encrypt($providedPassword));
            }

            $this->database->getReference('users/' . $user['username'] . '/name')->set($name);

            $userLists = json_encode($this->database->getReference('userTasks/' . $user['username'])->getValue());

            $userWithNewName = [
                "username" => $user['username'],
                "email" => $user['email'],
                "name" => $name,
                "lists" => $userLists,
            ];

            Session::put('user', $userWithNewName);

            return redirect()->route('home');
        } else {
            // render same page with $validationResult (that is a array of errors)
        }
    }



    // ----------------------
    // -------- LIST --------
    // ----------------------

    public function addListDisplay()
    {
        if (Session::get('logged')) {
            return Inertia::render('New', Session::get('user'));
        }

        return Inertia::render('Landing');
    }

    public function addList(Request $request)
    {
        $validationResult = $this->listValidation($request);

        if (empty($validationResult)) {

            $user = Session::get('user');

            $listName = $this->sanitize($request->list);
            $listToAdd = [
                'color' => $this->sanitize($request->color),
                'priority' => $this->sanitize($request->priority),
                'date' => $this->sanitize($request->date),
            ];

            $this->database->getReference('userTasks/' . $user['username'] . '/' . $listName)->set($listToAdd);


            return redirect()->route('home');
        } else {
            // render same page with $validationResult (that is a array of errors)
        }
    }

    public function deleteList(Request $request)
    {
        //$validationResult = $this->validation($request);

        //if (empty($validationResult)) {

        $listName = $this->sanitize($request->listName);

        $user = Session::get('user');

        $this->database->getReference('userTasks/' . $user['username'] . '/' . $listName)->remove();

        return redirect()->route('home');
        //} else {
        // render same page with $validationResult (that is a array of errors)
        //}
    }


    // ----------------------
    // -------- TASK --------
    // ----------------------

    public function addTaskToList(Request $request)
    {

        $validationResult = $this->taskValidation($request);

        if (empty($validationResult)) {
            $listName = $this->sanitize($request->listName);

            $dataToSave = [
                "taskDisplay" => $this->sanitize($request->taskDisplay),
                "status" => false
            ];

            $username = Session::get('user')['username'];

            $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks')->push($dataToSave);

            return redirect()->route('home');
        } else {
            // render same page with $validationResult (that is a array of errors)
        }
    }

    public function updateTask(Request $request)
    {
        $validationResult = $this->taskValidation($request);

        if (empty($validationResult)) {
            $listName = $this->sanitize($request->listName);
            $taskId = $this->sanitize($request->taskId);

            $username = Session::get('user')['username'];
            $completedTasks = $this->database->getReference('users/' . $username . '/completedTasks')->getValue();

            /*
        if the task is already completed, and the new task is not completed:
            subtract 1 from the users completed task count
        if the task is not already completed, and the new task is completed:
            add 1 to the users completed task count
        otherwise:
            do nothing
        */

            if ($this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks' . '/' . $taskId . '/status')->getValue() == true && $request->status == false) {
                $this->database->getReference('users/' . $username . '/completedTasks')->set($completedTasks - 1);
            } else if ($this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks' . '/' . $taskId . '/status')->getValue() == false && $request->status == true) {
                $this->database->getReference('users/' . $username . '/completedTasks')->set($completedTasks + 1);
            }


            $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks' . '/' . $taskId . '/taskDisplay')->set($request->taskDisplay);
            $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks' . '/' . $taskId . '/status')->set($request->status);

            return redirect()->route('home');
        } else {
            // render same page with $validationResult (that is a array of errors)
        }
    }

    public function deleteTask(Request $request)
    {
        //$validationResult = $this->validation($request);

        //if (empty($validationResult)) {
        $listName = $this->sanitize($request->listName);
        $taskId = $this->sanitize($request->taskId);

        $username = Session::get('user')['username'];

        $postref = $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks' . '/' . $taskId)->remove();

        return redirect()->route('home');
        //} else {
        // render same page with $validationResult (that is a array of errors)
        //}
    }
}
