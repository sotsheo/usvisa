<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class Login_controller extends Controller
{
    
    function index(){
       return view("admin.home.login");

    }
    function register(){
       return view("admin.home.register");
    }
    function registers(Request $request){
        if($request->isMethod('post')){
            $user=new User();
            if(!$request->name){
                $check['name']='Không được để trống tên';
            }
            if(!$request->password){
                $check['password']='Không được để trống mật khẩu';
            }
            if(!$request->email){
                $check['email']='Không được để trống email';
            }
            if($request->password!=$request->passwordv2){
                $check['passwordv2']='Nhập lại mật khẩu sai';
            }
            if(isset($check) && count($check)>0){
                return view("admin.home.register",['check'=>$check]);
            }
            else{
                $user->name=trim($request->name);
                $user->email=trim($request->email);
                $user->authorities=0;
                $user->password=bcrypt(trim($request->password));
                $user->save();
            }
            
        }
        return view("admin.home.login"); 
    }
    function login(Request $request){
        if($request->isMethod('post')){
            $name=$request->name;
            $password=$request->password;
            // $user=new User();
            // $user->name=$name;
            // $user->authorities=1;
            // $user->password=bcrypt($password);
            // $user->save();
            if(!$name && !$password){
                return view("admin.home.login");
            }
            else{
                if(Auth::attempt(['name'=>$name,"password"=>$password])){
                // get user
                    // return ( Auth::user());
                    return redirect('admin/news/');      
                }
                else{
                    echo ("error");
                }
            }   
            echo (1);    
        }
        return view("admin.home.login");
    }
    function logout(Request $request){
        Auth::logout();
        return redirect('admin');
        return 1;
    }
}
