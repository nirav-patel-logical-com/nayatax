<?php namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class RedirectIfRole {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next){

		/*if ($this->auth->check()){
			return new RedirectResponse(url('/home'));
		}
		return $next($request);*/

		$route = $request->route();
		$actions = $route->getAction();


		$User=new User();
		$user_id = $_SESSION['login_user']->id;
		$User->set_id($user_id);
		$auth_user_role=$User->auth_user_role();

		if( (isset($auth_user_role[0]->r_type))&&(!empty($auth_user_role[0]->r_type)) ){
			$rl_title=$auth_user_role[0]->r_type;

			if( ($rl_title=='Admin')&& (in_array("Admin", $actions['role'])) ){
				//echo "hi";die;
				return $next($request);
			}else if( ($rl_title=='Agent')&& (in_array("Agent", $actions['role'])) ){
				return $next($request);
			}else{
				Session::put('SUCCESS', 'FALSE');
				Session::put('MESSAGE', 'Access denied.');
				return new RedirectResponse(url('/home'));
			}

		}else{
			Session::put('SUCCESS', 'FALSE');
			Session::put('MESSAGE', 'Access denied.');
			return new RedirectResponse(url('/home'));
		}

		/*if( (isset($this->auth->user()->user_role()->first()->ur_role))&&($this->auth->user()->user_role()->first()->ur_role=='Admin')&& (in_array("Admin", $actions['role'])) ){
			return $next($request);
		}else if( (isset($this->auth->user()->user_role()->first()->ur_role))&&($this->auth->user()->user_role()->first()->ur_role=='Moderator')&& (in_array("Moderator", $actions['role'])) ){
			return $next($request);
		}else if( (isset($this->auth->user()->user_role()->first()->ur_role))&&($this->auth->user()->user_role()->first()->ur_role=='Member')&& (in_array("Member", $actions['role'])) ){
			$check_mobile_varified++;
		}else{
			return new RedirectResponse(url('/home'));
		}*/


	}



}
