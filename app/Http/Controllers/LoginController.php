<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Create;
use Mail;
use App\Mail\MyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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

    // public function sendEmail()
    // {
    //     $user = Auth::user();

    //     if ($user) {
    //         Mail::to($user->email)->send(new MyMail($user));
    //         return redirect()->intended(route('viewdashboard'))->with('message', 'Email sent Successfully!') ;

    //     }
    //     else{
    //         return redirect()->intended(route('viewdashboard'))->with('error', 'Email sent Unsuccessfully!') ;
    //     }

    // }

    public function annoucenmentview(){
        return view('announcement');
    }
    public function sendAnnouncement(Request $request)
    {
                $request->validate([
                    'recipient' => 'required|string', // 'all' or specific email
                    'subject' =>'required|string',
                    'message' => 'required|string',
                ]);
        
                $recipient = $request->recipient;
                $subject=$request->subject;
                $data = $request->message;
        
                if ($recipient === 'all') {
                    // Send to all users
                    $users = Login::pluck('email');
                    foreach ($users as $email) {
                        Mail::to($email)->send(new MyMail($subject,$data));
                    }
                    return back()->with('success', 'Announcement sent to all users!');
                } else {
                    // Send to a specific email
                    Mail::to($recipient)->send(new MyMail($subject,$data));
                    return back()->with('success', 'Announcement sent to ' . $recipient);
                }
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

    public function loginview(){
        return view('loginuser');
    }

    public function loginuser(Request $request){
        $request->validate([
            'email' => 'required',
            'password'=> 'required',
        ]);

        $credentials = $request->only('email','password');
        if(Auth::guard('web')->attempt($credentials)){
           $user= Auth::user();
            session(['user_name' => $user->name]);
            return redirect()->intended(route('viewplants'));
        }
        return redirect()->back()->with('error', 'EMAIL AND PASSWORD DO NOT MATCH');
    }


    


}
