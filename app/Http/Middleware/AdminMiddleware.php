<?php

namespace App\Http\Middleware;
use App\Models\User;
use Closure;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    // {
    //     if ($request->session()->get('role_id')) {
    //         //$request->session()->get('role_name')
    //         return $next($request);
    //     } else {
    //         return redirect(route("login"));
    //     }
       
    // }

    {
        if (!$request->session()->exists('user_id')) {
            return redirect(route("login"));
        } else {
            $update_values = User::where('email', session()->get('email'))->first();
            return $next($request);
        }
        
        // if (!$request->session()->exists('user_id')) {
        //     return redirect(route("login"));
        // } else {
        //         $update_values = User::where([
        //                 'email' => session()->get('email')
        //                 ])->first();
        //         if($update_values->ip_address == $request->ip()) {
        //             return $next($request);
        //         } else {
        //             return redirect('/login')->with('error','Please logout from another browser');
        //         }

        // }
       
    }
}
