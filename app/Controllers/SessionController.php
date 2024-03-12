<?php 

namespace App\Controllers;

use App\Models\User;
use ErrorException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

class SessionController
{
    // Homepage action
	public function loginAction(RouteCollection $routes, Request $request)
	{
		startSession();
		$_SESSION['showNav'] = false;
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$username = $_POST['username'];
			$pwd = $_POST['password'];
			$_SESSION['username'] = $username;
			$user = new User();
			try {
				$user->read($username, $pwd);
				if($user->getDeletedAt() != null) {
					$package = ['status' => 'fail', 'message' => 'Tài khoản đã bị khóa'];
					echo json_encode($package);
					die();
				}
				$_SESSION['user'] = serialize($user);
				$_SESSION['isLoggedIn'] = true;
			} catch (ErrorException $err) {
				$errMsg = $err->getMessage();
				$status = 'fail';
			}
			$package = ['status' => $status ?? '', 'message' => $errMsg ?? ''];
			echo json_encode($package);
		} else if (isLoggedIn()){
			redirect(getPath($routes, 'homepage'));
		} else {
			$name = 'login';
			require_once APP_ROOT . '/views/layout.view.php';
		}
	}

	public function logoutAction(RouteCollection $routes, Request $request) {
		session_start();
		session_destroy();
		redirect($routes->get('homepage')->getPath());
	}
}