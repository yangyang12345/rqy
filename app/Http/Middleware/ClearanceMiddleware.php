<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user()->hasPermissionTo('Administer roles & permissions'))
        {
            return $next($request);  // 管理员具备所有权限
        }

        /*
         * 具体权限细化，目前暂时不需要，以下是demo
         */

//        if ($request->is('posts/create')) // 文章发布权限
//        {
//            if (!Auth::user()->hasPermissionTo('Create Post'))
//            {
//                abort('401');
//            }
//            else {
//                return $next($request);
//            }
//        }


        return $next($request);
    }
}