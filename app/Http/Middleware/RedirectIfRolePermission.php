<?php namespace App\Http\Middleware;

use App\Module;
use App\ModulePermissionRole;
use App\Permissions;
use App\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
class RedirectIfRolePermission {

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
	public function handle($request, Closure $next)
	{

		/*if ($this->auth->check()){
			return new RedirectResponse(url('/home'));
		}
		return $next($request);*/

		$route = $request->route();
		$actions = $route->getAction();
		/*echo "<pre>";
		print_r($_SESSION);
		print_r($actions);
		echo "</pre>";
		exit;*/

		$User = new User();
		$Module = new Module();
		$Permissions = new Permissions();

		$is_ajax = 0;
		if ((isset($actions['is_ajax'])) && (!empty($actions['is_ajax']))) {
			$is_ajax = $actions['is_ajax'];
		}
		if (isset($_SESSION) && !empty($_SESSION)) {


			$login_user_id = $_SESSION['login_user']->id;
			$User->set_id($login_user_id);
			//$User->id=$login_user_id;
			$auth_user_role = $User->auth_user_role(); //fetch login user role
			if ((isset($auth_user_role[0]->r_type)) && (!empty($auth_user_role[0]->r_type))) {
				$rl_title = $auth_user_role[0]->r_type;
				$rl_id = $auth_user_role[0]->r_id;

				$Module->set_mod_short_code($actions['module']);
				$module_per_arr = $actions['module_per'];

				$select_by_module_short_code = $Module->select_by_mod_short_code(); // fetch module_id by module_short_code
				if (isset($select_by_module_short_code) && !empty($select_by_module_short_code)) {
					$Permissions->set_per_mod_id($select_by_module_short_code[0]->mod_id);
					$Permissions->set_per_rl_id($rl_id);
					$check_by_module_and_role = $Permissions->check_by_module_and_role();    // check permission for perticular module
				}
				$requested_user_id = $request->route('id');

				/*echo "<pre>";
				print_r($module_per_arr);
				print_r($check_by_module_and_role);
				echo "</pre>";
				exit;*/


				/*(isset($check_by_module_and_role[0]) && ($check_by_module_and_role[0]->per_permission!='None')*/

				if (
					((isset($requested_user_id)) && (!empty($requested_user_id)) && ($requested_user_id == $login_user_id)) ||
					(
						((isset($check_by_module_and_role[0]->per_permission)) && ($check_by_module_and_role[0]->per_permission != 'None')) &&
						((in_array($check_by_module_and_role[0]->per_permission, $module_per_arr)) || ((!in_array($check_by_module_and_role[0]->per_permission, $module_per_arr)) && $check_by_module_and_role[0]->per_permission == 'Write'))
					)
				) {

					return $next($request);
				} else {
					//return new RedirectResponse(url('/home'));
					if ((isset($is_ajax)) && (!empty($is_ajax))) {
						$response = array();
						$response['SUCCESS'] = 'FALSE';
						$response['MESSAGE'] = 'Access denied.';
						$response_json = json_encode($response, true);
						echo $response_json;
					} else {
						Session::put('SUCCESS', 'FALSE');
						Session::put('MESSAGE', 'Access denied.');
						return redirect()->back();
					}
				}
			} else {

				//return new RedirectResponse(url('/home'));
				if ((isset($is_ajax)) && (!empty($is_ajax))) {
					$response = array();
					$response['SUCCESS'] = 'FALSE';
					$response['MESSAGE'] = 'Access denied.';
					$response_json = json_encode($response, true);
					echo $response_json;
				} else {
					Session::put('SUCCESS', 'FALSE');
					Session::put('MESSAGE', 'Access denied.');
					return redirect()->back();
				}
			}
		} else {
			if ((isset($is_ajax)) && (!empty($is_ajax))) {
				$response = array();
				$response['SUCCESS'] = 'FALSE';
				$response['MESSAGE'] = 'Access denied.';
				$response_json = json_encode($response, true);
				echo $response_json;
			} else {
				Session::put('SUCCESS', 'FALSE');
				Session::put('MESSAGE', 'Access denied.');
				return redirect()->back();
			}
		}


	}
}
