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
    private $userId = "testUserId";

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
    {
        if (!Session::get('user')) {
            return redirect('loginTest');
        }

        $userData = [
            "user" => Session::get('user'),
            "userTasks" => Session::get('userTasks'),
        ];

        return view('firebase.tasks.index')->with('userData', $userData);
    }

    /*public function addDisplay()
    {
        return view('firebase.tasks.add');
    }*/

    public function addDisplay()
    {
        return Inertia::render('New');
    }

    public function addFunc(Request $request)
    {
        $user = Session::get('user');
        $listName = $request->list;
        $dataToSave = [
            "task" => $request->task,
            "priority" => $request->priority,
        ];
        $postRef = $this->database->getReference('userTasks/' . $user['username'] . "/" . $listName)->push($dataToSave);
        if ($postRef) {
            $userTasks = $this->database->getReference('userTasks/' . $user['username'])->getValue();
            Session::put('userTasks', $userTasks);
            return redirect('firebaseTest')->with('status', 'success');
        } else {
            return redirect('firebaseTest')->with('status', 'failed');
        }
    }

    public function registerDisplay()
    {
        if (Session::get('user')) {
            return redirect('firebaseTest');
        }

        return view('firebase.tasks.register');
    }

    public function addform()
    {


        return view('firebase.tasks.add');
    }

    public function registerFunc(Request $request)
    {

        $dataToSave = [
            "username" => $request->username,
            "email" => $request->email,
            "name" => $request->name,
            "password" => encrypt($request->password),
        ];

        $postRef = $this->database->getReference('users/' . $request->username)->set($dataToSave);

        if ($postRef) {
            return redirect('firebaseTest')->with('status', 'success');
        } else {
            return redirect('firebaseTest')->with('status', 'failed');
        }
    }

    public function loginDisplay()
    {
        if (Session::get('user')) {
            $userData = Session::get('user');
            $userTasks = Session::get('userTasks');
            return Inertia::render('Home', [
                'user' => $userData['username'],
                'name' => $userData['name'],
                'tasks' => $userTasks,
            ]);
        }
        return Inertia::render('Landing');
    }


    public function loginFunc(Request $request)
    {
        $providedPassword = $request->password;
        $loggedIn = false;
        $loggedIn = true;

        if ($request->user != null) {
            $userDB = $this->database->getReference('users/' . $request->user)->getValue();
        } else {
            $userDB = null;
        }

        if ($userDB == null) {
            return redirect()->route('landing');
        } else {

            $loggedIn = decrypt($userDB['password']) == $providedPassword ? true : false;

            if ($loggedIn) {


                $userTasks = json_encode($this->database->getReference('userTasks/' . $userDB['username'])->getValue());
                
                $user = [
                    "username" => $userDB['username'],
                    "email" => $userDB['email'],
                    "name" => $userDB['name'],
                    "tasks" => $userTasks::all(),
                ];

                Session::put('user', $user);
                Session::put('tasks', $userTasks);

                return Inertia::render('Home', [
                    'user' => $userDB['username'],
                    'name' => $userDB['name'],
                    'tasks' => $userTasks,
                ]);
            } else {
                return redirect()->route('landing');
            }
        }
    }
}
