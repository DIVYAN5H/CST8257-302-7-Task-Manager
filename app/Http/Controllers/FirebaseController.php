<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Kreait\Firebase\Contract\Database;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class FirebaseController extends Controller
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
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

    public function addListDisplay()
    {
        if (Session::get('user')) {
            $userData = Session::get('user');
            $userLists = Session::get('lists');
            return Inertia::render('New', [
                'user' => $userData['username'],
                'name' => $userData['name'],
                'email' => $userData['email'],
                'lists' => $userLists,
            ]);
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

        $postRefColor = $this->database->getReference('userTasks/' . $user['username'] . "/" . $listName . "/color")->set($color);
        $postRefPriority = $this->database->getReference('userTasks/' . $user['username'] . "/" . $listName . "/priority")->set($priority);
        $postRefDate = $this->database->getReference('userTasks/' . $user['username'] . "/" . $listName . "/date")->set($date);

        if ($postRefColor && $postRefPriority && $postRefDate) {
            $userListsJson = json_encode($this->database->getReference('userTasks/' . $user['username'])->getValue());
            Session::put('listsJson', $userListsJson);

            return redirect()->route('home')->with('lists', $userListsJson);
        } else {
            return redirect('new')->with('status', 'failed');
        }
    }

    public function deleteList(Request $request){
        $listName = $request->listName;

        $username = Session::get('user')['username'];

        $this->database->getReference('userTasks/' . $username . '/' . $listName)->remove();

        return redirect()->route('home');
    }

    public function registerFunc(Request $request)
    {

        $postRef = null;
        $dataToSave = [
            "username" => $request->user,
            "email" => $request->email,
            "name" => $request->name,
            "password" => encrypt($request->password),
        ];

        if ($dataToSave['username'] != null && $dataToSave['email'] != null && $dataToSave['name'] != null && $dataToSave['password'] != null) {
            $postRef = $this->database->getReference('users/' . $dataToSave['username'])->set($dataToSave);
        }
        if ($postRef != null) {
            Session::put('user', $dataToSave);
            return redirect()->route('home');
        } else {
            return redirect()->route('landing');
        }
    }

    public function loginDisplay()
    {

        if (Session::get('user')) {
            $userData = Session::get('user');
            $userLists = json_encode($this->database->getReference('userTasks/' . $userData['username'])->getValue());
            return Inertia::render('Home', [
                'user' => $userData['username'],
                'name' => $userData['name'],
                'email' => $userData['email'],
                'lists' => $userLists,
            ]);
        }

        return redirect()->route('landing');
    }


    public function loginFunc(Request $request)
    {

        $providedPassword = $request->password;
        $loggedIn = false;
        $loggedIn = true;

        $userDB = $this->database->getReference('users/' . $request->user)->getValue();

        if ($userDB == null) {
            return redirect()->route('landing');
        } else {


            $loggedIn = decrypt($userDB['password']) == $providedPassword ? true : false;

            if ($loggedIn) {


                $userLists = json_encode($this->database->getReference('userTasks/' . $userDB['username'])->getValue());

                $user = [
                    "username" => $userDB['username'],
                    "email" => $userDB['email'],
                    "name" => $userDB['name'],
                    "lists" => $userLists,
                ];

                Session::put('user', $user);
                Session::put('lists', $userLists);
                Session::put('logged', true);

                return Inertia::render('Home', [
                    'user' => $userDB['username'],
                    'name' => $userDB['name'],
                    'lists' => $userLists,
                ]);
            } else {
                return redirect()->route('landing');
            }
        }
    }

    public function updateUser(Request $request)
    {
        $username = Session::get('user')['username'];

        $dataToSave = [
            "name" => $request->name,
            "password" => encrypt($request->password)
        ];

        $this->database->getReference('users' . $username)->set($dataToSave);

        return redirect()->route('home');
    }

    public function updateTask(Request $request)
    {

        $listName = $request->listName;
        $taskId = $request->taskId;

        $dataToSave = [
            "taskDisplay" => $request->taskDisplay,
            "status" => $request->status
        ];

        $username = Session::get('user')['username'];

        $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks' . '/' . $taskId)->set($dataToSave);

        return redirect()->route('home');
    }

    public function deleteTask(Request $request)
    {
        $listName = $request->listName;
        $taskId = $request->taskId;

        $username = Session::get('user')['username'];

        $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks' . '/' . $taskId)->remove();

        return redirect()->route('home');
    }

    public function addTaskToList(Request $request)
    {

        $listName = $request->listName;

        $dataToSave = [
            "taskDisplay" => $request->taskDisplay,
            "status" => $request->status ?? false
        ];

        $username = Session::get('user')['username'];

        $this->database->getReference('userTasks/' . $username . '/' . $listName . '/tasks')->push($dataToSave);

        $userLists = json_encode($this->database->getReference('userTasks/' . $username)->getValue());
        Session::put('lists', $userLists);
        return redirect()->route('home');
    }
}
