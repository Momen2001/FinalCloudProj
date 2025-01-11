<?php

namespace App\Http\Controllers;

use App\Jobs\RegesterEmailJob;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function patientRegister()
    {
       $data['countries'] =Country::query()->get();
       $data['intros'] =Country::query()->pluck('phone_code')->toArray();
       $data['cities'] =City::query()->get();
        return view('patient.register',$data);
    }

    public function login_page()
    {
        return view('auth.login');
    }

    public function register_page()
    {
        return view('site.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ]);
//        dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            if (Auth::user()->verified == 0) {
                return response()->json(['status' => 422, 'msg' => 'You should verify your account first, please check your email']);
            }

            if (Auth::user()->getType() == 'Admin') {
                return response()->json(['status' => true, "redirect_url" => route('admin_home')]);
            } elseif (Auth::user()->getType() == 'Lab') {
                return response()->json(['status' => true, "redirect_url" => route('lab_home')]);
            }elseif (Auth::user()->getType() == 'Patient') {
                return response()->json(['status' => true, "redirect_url" => route('patient_home')]);
            }

        } else {
            return response()->json(['status' => false, 'msg' => 'The provided credentials do not match our records.', 'redirect_url' => url('/')]);
        }
    }

    public function register(Request $request)
    {
      }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

}
