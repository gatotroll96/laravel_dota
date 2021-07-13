<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        if(Session::exists('logged')) {
            $data = Session::get('logged');
            if($data['group_acp'] === 1){                
                return $next($request);
            }else{
                return response()->view('admin.error.permisson');
            }
        }else{
            return redirect('admin/login');
        }
        
    }
}
