<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Kreait\Firebase\Contract\Database;
use App\Models\User;
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

        $userWithNewList = [
            "username" => $user['username'],
            "email" => $user['email'],
            "name" => $user['name'],
            "lists" => $userLists,
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

    private function validation(Request $request)
    {
        $error = [];
        $user = $request->user ?? Session::get('user');

        if ($user == null) {
            array_push($error, "Please Enter Username");
        }

        if (count($error) !== 0) {
            return $error;
        }

        return $request;
    }

    // ----------------------
    // -------- USER --------
    // ----------------------
    public function registerFunc(Request $request)
    {
        $dataToSave = [
            "username" => $request->username,
            "email" => $request->email,
            "name" => $request->name,
            "password" => encrypt($request->password),
        ];

        //this should run only after validation
        $this->database->getReference('users/' . $dataToSave['username'])->set($dataToSave);

        $user = [
            "username" => $dataToSave['username'],
            "email" => $dataToSave['email'],
            "name" => $dataToSave['name'],
            "lists" => [],
        ];

        Session::put('user', $user);
        Session::put('logged', true);
        $this->loginDisplay();

        return redirect()->route('home');
    }

    public function loginDisplay()
    {
        if (Session::get('logged')) {
            return Inertia::render('Home', Session::get('user'));
        }

        return Inertia::render('Landing');
    }

    public function loginFunc(Request $request)
    {

        //this should run only after validation
        $providedPassword = $request->password;

        $userFromDB = $this->database->getReference('users/' . $request->username)->getValue();

        if (decrypt($userFromDB['password']) == $providedPassword) {
            $user = [
                "username" => $userFromDB['username'],
                "email" => $userFromDB['email'],
                "name" => $userFromDB['name'],
                "lists" => [],
            ];

            Session::put('user', $user);
            Session::put('logged', true);
            $this->updateSessionList();

            return redirect()->route('home');
        } else {
            return redirect()->route('landing');
        }
    }

    public function updateUser(Request $request)
    {
        $user = Session::get('user');

        $name = $request->name ?? $user['name'];

        if ($request->password) {
            $this->database->getReference('user/' . $user['username'] . '/password')->set(encrypt($request->password));
        }

        $this->database->getReference('user/' . $user['username'] . '/name')->set($name);

        $userLists = json_encode($this->database->getReference('userTasks/' . $user['username'])->getValue());

        $userWithNewName = [
            "username" => $user['username'],
            "email" => $user['email'],
            "name" => $request->name,
            "lists" => $userLists,
        ];

        Session::put('user', $userWithNewName);

        return redirect()->route('home');
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
        $user = Session::get('user');

        $listName = $request->list;
        $color = $request->color;
        $priority = $request->priority;
        $date = $request->date;

        // should run after validation
        $this->database->getReference('userTasks/' . $user['username'] . "/" . $listName . "/color")->set($color);
        $this->database->getReference('userTasks/' . $user['username'] . "/" . $listName . "/priority")->set($priority);
        $this->database->getReference('userTasks/' . $user['username'] . "/" . $listName . "/date")->set($date);

        $this->updateSessionList();

        return redirect()->route('home');
    }

    public function deleteList(Request $request)
    {
        $listName = $request->listName;

        $user = Session::get('user');

        $this->database->getReference('userTasks/' . $user['username'] . '/' . $listName)->remove();

        $this->updateSessionList();

        return redirect()->route('home');
    }


    // ----------------------
    // -------- TASK --------
    // ----------------------

    public function addTaskToList(Request $request)
    {

        $listName = $request->listName;

        $dataToSave = [
            "taskDisplay" => $request->taskDisplay,
            "status" => $request->status ?? false
        ];

        $username = Session::get('user')['username'];

        $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks')->push($dataToSave);

        $this->updateSessionList();

        return redirect()->route('home');
    }

    public function updateTask(Request $request)
    {

        $listName = $request->listName;
        $taskId = $request->taskId;

        $username = Session::get('user')['username'];

        $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks' . '/' . $taskId . '/taskDisplay')->set($request->taskDisplay);
        $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks' . '/' . $taskId . '/status')->set($request->status);

        $this->updateSessionList();

        return redirect()->route('home');
    }

    public function deleteTask(Request $request)
    {
        $listName = $request->listName;
        $taskId = $request->taskId;

        $username = Session::get('user')['username'];

        $postref = $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks' . '/' . $taskId)->remove();

        $this->updateSessionList();

        return redirect()->route('home');
    }
}
