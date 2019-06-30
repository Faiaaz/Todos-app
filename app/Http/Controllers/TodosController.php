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

    public function show(Todo $todo){

        //$todo = Todo::find($todoId);

        return view('todos.show')->with('todo',$todo);
    }

    public function create(){
        return view('todos.create'); // Here we just created the view
    }

    public function store(){   // here we are inserting the data into the database

        $this->validate(\request(),[
            'name'=> 'required',
            'description' => 'required'
        ]);
        $data = \request()->all();  // get the data inserted in the form
        $todo = new Todo();         // we created our model variable

        $todo->name = $data['name']; //$todo->name here name is property and in $data['name'], name is key
        $todo->description = $data['description'];
        $todo->completed = false; // by default it is going to be false

        $todo->save(); // this is going to make a database query to save to db

        session()->flash('success','Todo created successfully!');
        return redirect('/todos');
    }

    public function edit(Todo $todo){

        return view('todos.edit')->with('todo',$todo);
    }

    public function update(Todo $todo){
        $this->validate(\request(),[
            'name'=> 'required',
            'description' => 'required'
        ]);

        $data = \request()->all();

        $todo->name = $data['name'];
        $todo->description = $data['description'];

        $todo->save();
        session()->flash('success','Todo updated successfully!');

        return redirect('/todos');
    }

    public function destroy(Todo $todo){

        $todo->delete();
        session()->flash('success','Todo deleted successfully!');

        return redirect('/todos');

    }

    public function completeTodo(Todo $todo){
        $todo->completed = true;

        $todo->save();
        session()->flash('success','Todo completed successfully!');

        return redirect('/todos');

    }
}
