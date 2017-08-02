<?php

namespace App\Http\Middleware;

use Closure;

use App\User;
use Auth;
use App\Notifications;
use Illuminate\Contracts\View\Factory as ViewFactory;



class ShareSearchInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $view;

     public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }


    public function handle($request, Closure $next)
    {   

        $search = User::all()->where('pro', '1');
        $above_notifications = Notifications::all()->where('completed', 0);
           $this->view->share(
            'search_data_pro', $search ?: []
        );
             $this->view->share(
            'above_notifications', $above_notifications ?: []
        );
        
        return $next($request);
    }
}
