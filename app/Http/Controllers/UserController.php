<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserProfile;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $user = User::withTrashed()->paginate(5);
        return view('users.sailboats.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.sailboats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::withTrashed()->find($id);
        $userProfile=UserProfile::where('user_id', $id)->first();
         return view('users.sailboats.show', compact('user','userProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $profile=UserProfile::where('user_id', $id)->first();
        return view('users.sailboats.edit', compact('user','profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }

    public function searchUsers(Request $request) 
    {
        $users = User::get();
        
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'Users' => UserResource::collection($users)->response()->getData(true)
            ]);
        }

        return false;
    }

    public function userSearchOptions(Request $request) 
    {
        $options = [
            'city' => UserProfile::select('city')->distinct()->pluck('city')->toArray(),
            'state' => UserProfile::select('state')->distinct()->pluck('state')->toArray(),
        ];

     if ($request->wantsJson()) {
        return response()->json([
            'success' => true,
            'options' => $options
        ]);
      }
     
    }
}
