<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Kreait\Firebase\Contract\Database;
use App\Models\User;
use Illuminate\Support\Facades\Session;

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
        $userData = [
            "user" => Session::get('user'),
            "userTasks" => Session::get('userTasks'),
        ];

        return view('firebase.tasks.index')->with('userData', $userData);
    }

    public function addDisplay()
    {
        return view('firebase.tasks.add');
    }

    public function addFunc(Request $request)
    {
        $user = Session::get('user');
        $listName = $request->list;
        $dataToSave = [
            "task" => $request->task,
            "priority" => "1",
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
        return view('firebase.tasks.register');
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
        return view('firebase.tasks.login');
    }
    public function loginFunc(Request $request)
    {
        $providedPassword = $request->password;
        $loggedIn = false;
        $loggedIn = true;

        $userDB = $this->database->getReference('users/' . $request->username)->getValue();

        if ($userDB == null) {
            return redirect('loginTest')->with('status', 'no such Username');
        } else {
            $loggedIn = decrypt($userDB['password']) == $providedPassword ? true : false;

            if ($loggedIn) {
                $user = [
                    "username" => $userDB['username'],
                    "email" => $userDB['email'],
                    "name" => $userDB['name'],
                ];

                $userTasks = $this->database->getReference('userTasks/' . $user['username'])->getValue();

                Session::put('user', $user);
                Session::put('userTasks', $userTasks);

                return redirect('firebaseTest');
            } else {
                return redirect('loginTest')->with('status', 'wrong password');
            }
        }
    }
}
