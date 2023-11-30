<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginFacebook;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class LoginFacebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //facebook redirect
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    //facebook callback
    public function redirectToFacebookCallback(){
        $user = Socialite::driver('facebook')->user();
        $this->registrationOrLogin($user);
        return redirect('/');
    }

    protected function registrationOrLogin($data){
        $user = LoginFacebook::where('email',$data->email)->first();
        if(!$user){
            $user = new LoginFacebook;
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();
        }

        Auth::login($user);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoginFacebook  $loginFacebook
     * @return \Illuminate\Http\Response
     */
    public function show(LoginFacebook $loginFacebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoginFacebook  $loginFacebook
     * @return \Illuminate\Http\Response
     */
    public function edit(LoginFacebook $loginFacebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoginFacebook  $loginFacebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoginFacebook $loginFacebook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoginFacebook  $loginFacebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginFacebook $loginFacebook)
    {
        //
    }
}
