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
        if (Session::get('user')) {
            $userData = Session::get('user');
            $userTasks = Session::get('tasks');
            return Inertia::render('New', [
                'user' => $userData['username'],
                'name' => $userData['name'],
                'tasks' => $userTasks,
            ]);
        }
        return Inertia::render('Landing');
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
            $userTaskJson = json_encode($this->database->getReference('userTasks/' . $user['username'])->getValue());
            Session::put('userTasks', $userTasks);

            return redirect()->route('home')->with('tasks', $userTaskJson);
        } else {
            return redirect('new')->with('status', 'failed');
        }
    }

    public function registerDisplay()
    {


        return view('firebase.tasks.register');
    }

    public function addform()
    {


        return view('firebase.tasks.add');
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
            $userTasks = json_encode($this->database->getReference('userTasks/' . $userData['username'])->getValue());

            return Inertia::render('Home', [
                'user' => $userData['username'],
                'name' => $userData['name'],
                'email' =>$userData['email'],
                'tasks' => $userTasks,
            ]);
        }

        return redirect()->route('landing');
        //return Inertia::render('Landing');
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
                    "tasks" => $userTasks,
                ];

                Session::put('user', $user);
                Session::put('tasks', $userTasks);
                Session::put('logged', true);

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

        
   //public function isLoggedIn(){
   //    if(Session::get('user')){
   //        $username = current(Session::get('user'));
   //        $userDB = $this->database->getReference('users/' . $username )->getValue();
   //        $userTasks = json_encode($this->database->getReference('userTasks/' . $userDB['username'])->getValue());

   //        return redirect()->route('home')->with([
   //            'user' => $userDB['username'],
   //            'name' => $userDB['name'],
   //            'tasks' => $userTasks,
   //        ]);
   //    }
   //    else{

   //        return Inertia::render('/landing');
   //    }

   //}

    public function updateTask(Request $request)
    {
        $listname = $request->listname;
        $id = $request->taskId;

        $dataToSave = [
            "task" => $request->task,
            "priority" => $request->priority,
        ];

        $username = Session::get('user')['username'];

        $postRef = $this->database->getReference('userTasks/' . $username . $listname . $id)->set($dataToSave);

        return redirect()->route('landing');
    }

    public function deleteTask(Request $request)
    {
        $listname = $request->listname;
        $id = $request->taskId;

        $username = Session::get('user')['username'];

        $postRef = $this->database->getReference('userTasks/' . $username . $listname . $id)->remove();

        return redirect()->route('landing');
    }
}
