<?php

namespace App\Http\Middleware;

use App\Models\Traffic;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckFirstVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('_previous') == false) {
            $ip_address = request()->ip();
            $date = date('Y-m-d');
            $item = Traffic::where('ip_address', '=', $ip_address)->where('date', '=', $date)->first();


            if ($item == null) {
                $traffic = new Traffic();
                $traffic->ip_address = $ip_address;
                $traffic->date = $date;
                $traffic->visitors = 1;
                $traffic->save();
            } else {
                $item->visitors++;
                $item->save();
            }
        }

        return $next($request);
    }
}
