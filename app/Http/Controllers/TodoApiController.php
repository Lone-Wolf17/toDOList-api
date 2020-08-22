<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoApiController extends Controller
{
    public function getAllTodos() {
        // logic to get all todos Items goes here
        $todos = Todo::get()->toJson(JSON_PRETTY_PRINT);

        return response($todos, 200);
    }

    public function createTodo(Request $request) {
        // logic to create a todo record goes here
        $todo = new Todo;
        $todo->task = $request->task;
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

    public function updateTodo(Request $request, $id) {
        // logic to update a todo item goes here
        if (Todo::where('id', $id)->exists()) {

            $todo = Todo::find($id);
            $todo->task = is_null($request->task) ? $todo->task : $request->task;
            $todo->description = is_null($request->description) ? $todo->description : $request->description;
            $todo->dateTime = is_null($request->dateTime) ? $todo->dateTime : $request->dateTime;
            $todo->is_completed = is_null($request->is_completed) ? $todo->is_completed : $request->is_completed;
            $todo->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Todo Record not found"
            ], 404);
        }
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
