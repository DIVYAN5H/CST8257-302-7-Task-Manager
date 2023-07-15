<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Kreait\Firebase\Contract\Database;

class FirebaseController extends Controller
{
    // public function __construct()
    // {
    //     $factory = (new Factory())->withServiceAccount(__DIR__.'firebase_credentianls.json');
    //     $this->database = app('firebase.database');
    //     $this->tableName = 'Tasks';
    // }
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index(){
        return view('firebase.tasks.index');
    } 

    public function addDisplay(){
        return view('firebase.tasks.add');
    }

    public function addFunc(Request $request){
        $postData = [
            "task"=> $request->task,
        ];
        $postRef = $this->database->getReference('Tasks')->push($postData);
        if($postRef){
            return redirect('firebaseTest')->with('status','success');
        }
        else{
            return redirect('firebaseTest')->with('status','failed');
        }
    }
}