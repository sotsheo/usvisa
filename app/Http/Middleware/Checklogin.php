<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Checklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function check_quyen($authorities){
      $check=0;
      if($authorities!=1){
        $url_segment = \Request::segment(2);
        switch ($url_segment) {
          case 'widget':
              $check=1;
            break;
          case 'website':
              $check=1;
            break;
          case 'form':
              $check=1;
            break;
          default:
            # code...
            break;
        }
      }
     return $check;
     
    }
    public function handle($request, Closure $next)
    {
         // kiểm tra url có login và đã đăng nhập rồi thì cho và trang user

        if($request->is('admin') && Auth::check()){  
          
          return redirect('admin/news/');
        }

       //  // nếu chưa đang nhập và cố tình về trang user thì bắt quay lại đang nhập
       else if(!Auth::check() && !$request->is('admin') && $request->is('register')){
           return redirect()->route("index");
        }
        // kiem tra da dang nhap chua
        else{
            if(Auth::check()){
                if($this->check_quyen(\Auth::user()->authorities)!=0){
                  return redirect('admin/news/');
                }
            }
            return $next($request);

        }
    }
}

