<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function show(){
        return Inertia::render('/test2');
    }

    public function isLogged(){

        if (Session::get('logged')){
            return redirect()->route('home');
        }
        else{

            return Inertia::render('Landing');
        }
    }

    public function logOut(){
        Session::flush();
        return redirect()->route('landing');
    }
}

