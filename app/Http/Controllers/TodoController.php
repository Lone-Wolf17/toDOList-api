<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function getAllTodos() {
        // logic to get all todos Items goes here
//        dump("XXX A");

        $todos = Todo::latest()->get()->toJson(JSON_PRETTY_PRINT);

        return response($todos, 200);
    }

    public function createTodo(Request $request) {
        // logic to create a todo record goes here


        $todo = new Todo;
        $todo->title = $request->title;
//        $todo->dateTime = $request->dateTime;

        if ($request->description) {
            $todo->description = $request->description;
        } else {
            $todo->description = "No Description available";
        }



        $todo->save();

        return response()->json([
            "message" => "Todo Item record created"
        ], 201);
    }

    public function  getTodo($id) {
        // logic to get a todo item
        if (Todo::where('id', $id)->exists()) {
            $todo = Todo::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($todo, 200);
        } else {
            return response()->json([
                "message" => "Todo Item not found"
            ], 404);
        }
    }

    public function updateTodo($id) {
        // logic to update a todo item goes here

        $todo = Todo::find($id);
        $todo->is_completed = !$todo->is_completed;
        $todo->save();

        return response()->json('Todo updated!!');

//        if (Todo::where('id', $request->id)->exists()) {
//
//            $todo = Todo::find($request->id);
//            $todo->title = is_null($request->title) ? $todo->task : $request->title;
//            $todo->description = is_null($request->description) ? $todo->description : $request->description;
//            $todo->dateTime = is_null($request->dateTime) ? $todo->dateTime : $request->dateTime;
//            $todo->is_completed = is_null($request->is_completed) ? $todo->is_completed : $request->is_completed;
//            $todo->update();
//
//            return response()->json([
//                "message" => "records updated successfully"
//            ], 200);
//        } else {
//            return response()->json([
//                "message" => "Todo Record not found"
//            ], 404);
//        }
    }

    public function deleteTodo ($id) {
        // logic to delete a todo item goes here
        if (Todo::where('id', $id)->exists()) {
            $todo = Todo::find($id);
            $todo->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Todo Record not found"
            ], 404);
        }
    }
}
