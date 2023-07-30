<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos =  Todo::all();
        return view('todos.index', compact('todos'));
    }
    public function create()
    {
        return view('todos.create');
    }
    public function store(TodoRequest $request)
    {

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => 0
        ]);
        $request->session()->flash('alert-success', 'Todos Created Successfully');
        return to_route('todos.index');
    }
    public function show($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            request()->session()->flash('error', 'Unable to locate the Todo');
            return to_route('todos.index');
        }
        return view('todos.show', compact('todo'));
    }
    public function edit($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            request()->session()->flash('error', 'Unable to locate the Todo');
            return to_route('todos.index');
        }
        return view('todos.edit', compact('todo'));
    }
    public function update(TodoRequest $request)
    {
        $todo = Todo::find($request->todo_id);
        if (!$todo) {
            request()->session()->flash('error', 'Unable to locate the Todo');
            return to_route('todos.index');
        }
        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->is_completed
        ]);
        $request->session()->flash('alert-info', 'Todos Updated Successfully');
        return to_route('todos.index');
    }
    public function destroy(Request $request)
    {
        $todo = Todo::find($request->todo_id);
        if (!$todo) {
            request()->session()->flash('error', 'Unable to locate the Todo');
            return to_route('todos.index');
        }
        $todo->delete();
        $request->session()->flash('alert-warning', 'Todos Deleted Successfully');
        return to_route('todos.index');
    }
}