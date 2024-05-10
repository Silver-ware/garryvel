<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\NewUserRequest;


class UserController extends Controller
{
    
    //Create
    public function new(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'age' => 'required|integer',
            'nickname' => 'required|string|max:255',
        ]);
    
        $student = User::create($validatedData);
        return response()->json($student, Response::HTTP_CREATED);
    }

    //Read
    public function index(Request $request){
        $user_query = User::query();
        
        if ($request->has('search')) {
            $search = $request->search;
            $user_query->where(function ($subQuery) use ($search) {
                $subQuery->where('firstName', 'like', "%{$search}%")
                         ->orWhere('lastName', 'like', "%{$search}%")
                         ->orWhere('nickname', 'like', "%{$search}%");
            });
        }

        if ($request->has('sort')) {
            $sortDirection = strtolower($request->get('direction', 'asc')) === 'desc' ? 'desc' : 'asc';
            $user_query->orderBy($request->sort, $sortDirection);
        }

        $user_queries = $request->get('fields');
        if ($user_queries) {
            $user_queriesArray = explode(',', $user_queries);
            $user_query->select($user_queriesArray);
        }

        $limit = $request->get('limit');
        $users = $user_query->limit($limit)->get();
    
        return response()->json($users);

        //return response()->json(['users' => User::all()]);
    }

    //Update
    public function update(UpdateUserRequest $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return response()->json($user);
    }

    //Delete
    public function remove($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Student deleted successfully'], 204);
    }

}
