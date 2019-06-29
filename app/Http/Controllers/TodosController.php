<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodosController extends Controller
{
    public function index(){

        $libra = Todo::all();
        return view('todos.index')->with('todos',$libra);
    }

    public function show($todoId){

        $todo = Todo::find($todoId);

        return view('todos.show')->with('todo',$todo);
    }
}
