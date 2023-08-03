<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        try{
            return view('auth.login');
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B001 index page');
            abort('404');
        }

    }

    /**
     * Registration page render
     *
     * @return response()
     */

    public function registration()
    {
        try{
            return view('auth.registration');
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B002 registration page');
            abort('404');
        }
    }
    /**
     * Login Page validtion and redirect
     *
     * @return response()
     */
    public function postLogin(LoginUserRequest $request)
    {
        try{
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('product.list')
                    ->withSuccess('You have Successfully loggedin');
            }
            $request->session()->flash('message','Credential not valid');
            return redirect()->route('login');
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B003  postLogin page');
            abort('404');
        }
    }
    /**
     * REgistration page validation and data insert
     *
     * @return response()
     */
    public function postRegistration(CreateUserRequest $request)
    {
        /*try{*/
            $data = $request->all();
            $check = $this->create($data);
            return redirect()->route('login')->withSuccess('Great! You have Successfully Registered');
        /*} catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B004  postRegistration page');
            abort('404');
        }*/
    }
    /**
     * dashboard render
     *
     * @return response()
     */
    public function dashboard()
    {
        try{
            if(Auth::check()){
                return view('dashboard');
            }
            return redirect("login")->withSuccess('Opps! You do not have access');
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B005  dashboard page');
            abort('404');
        }
    }

    /**
     * create function for insert user data
     *
     * @return response()
     */
    public function create(array $data)
    {
        try{
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B006  create page');
            abort('404');
        }
    }
    /**
     * logout function
     *
     * @return response()
     */
    public function logout() {
        try{
            Session::flush();
            Auth::logout();
            return Redirect('login');
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B007  logout page');
            abort('404');
        }
    }
}
