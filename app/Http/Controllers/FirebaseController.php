<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Kreait\Firebase\Contract\Database;

class FirebaseController extends Controller
{
    private $database;
    private $userId = "testUserId";

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index(){
        $fetchedData = $this->database->getReference('userTasks/'.$this->userId)->getValue();
        return view('firebase.tasks.index',compact('fetchedData'));
    } 

    public function addDisplay(){
        return view('firebase.tasks.add');
    }

    public function addFunc(Request $request){
        $listName = $request->list;
        $dataToSave = [
            "task"=> $request->task,
            "priority"=>"1",
        ];
        $postRef = $this->database->getReference('userTasks/'.$this->userId."/".$listName)->push($dataToSave);
        if($postRef){
            return redirect('firebaseTest')->with('status','success');
        }
        else{
            return redirect('firebaseTest')->with('status','failed');
        }
    }
}