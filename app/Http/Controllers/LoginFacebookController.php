<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        $user = User::where('provider_id', $data->id)->first();
        if(!$user){
            $user = new User;
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->token = $data->token;
            $user->save();
        }

        Auth::login($user);
        // $user_temp['provider_id'] = $user->provider_id;
        // $user_temp['password'] = $user->password;

        // $check = Auth::guard('user')->attempt($user_temp);
        // if($check) {
        //     toastr()->success("Đã đăng nhập thành công!");
        // } else {
        //     toastr()->error("Vui lòng đăng nhập lại!");
        // }

        // return response()->json([
        //     'status'    => true,
        //     'message'   => 'Đã đăng nhập tài khoản thành công'
        // ]);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
