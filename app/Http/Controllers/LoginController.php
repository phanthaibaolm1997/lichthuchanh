<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
	//Login for Admin
    public function getLoginAdmin(Request $request){
    	return view('admin.contents.login');
    }
    public function postLoginAdmin(Request $request){
    	$data = $request->only('email', 'password');
		if (Auth::guard('canbo')->attempt($data)) {
			$request->session()->put('session_quyen', Auth::guard('canbo')->user()->q_ma);
			if( Auth::guard('canbo')->user()->q_ma == 1){
				$request->session()->put('session_admin_email', $request->input('email'));
				$request->session()->put('session_admin_id', Auth::guard('canbo')->user()->cb_id);
				return redirect()->route('admin');
			}else{
				$request->session()->put('session_canbo_email', $request->input('email'));
				$request->session()->put('session_canbo_id', Auth::guard('canbo')->user()->cb_id);
				return redirect()->route('home');
			}
		}
    	return redirect()->back()->with('errors', "Đăng nhập thất bại vui lòng thử lại");
    }
    
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('home');
    }
}
