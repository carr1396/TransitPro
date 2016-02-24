<?php

namespace TransitPro\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;
class Admin
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->user() && !$this->auth->user()->isAdmin()) {
            if ($request->ajax()) {
                return response('Forbidden.', 403);
            } else {
                // flash()->error('You are not authorized to visit this page');
                return redirect()->back()->withErrors([
                  'error' =>'Action Forbidden You Might Be Trying To Access A Restricted Page'
                ]);;
            }
        }
        return $next($request);
    }
}
