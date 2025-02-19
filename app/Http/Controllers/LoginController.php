<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Login $login)
    {
        //
    }


    public function createview(){
        return view('createuser');
    }

    public function createstore(Request $request){

        // Check if email exists before inserting
    if (Login::where('email', $request->email)->exists()) {
        return back()->with('error', 'Email already exists. Please use another email.');
    }
        $request->validate([
            'email' => 'required|email|unique:logins,email,',
            'username' => 'required',
            'password' => 'required',
        ]);
        $logins = new Login;
        $logins->username = $request->username;
        $logins->email = $request->email;
        $logins->password = Hash::make($request->password);
        $save = $logins->save();

        if($save){
            return back()->with('success', 'Successfully created.');
        }else
        {
            return back()->with('error','Something Went Wrong.');
        }
    }



}
