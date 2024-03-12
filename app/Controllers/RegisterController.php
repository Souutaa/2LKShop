<?php

namespace App\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

class RegisterController
{
    // Homepage action
    public function getAccountInDB()
    {
        $user = new User();
        return $user->getAccountInDB();
    }

    public function getGmailInDB()
    {
        $user = new User();
        return $user->getGmailInDB();
    }
  
    public function indexAction(RouteCollection $routes, Request $request)
    {
        startSession();
        $_SESSION['showNav'] = false;
        $name = 'register';
        if ($request->isMethod('POST')) {
            // echo "fjlakjflajsf";
            $user = new User();
            $this->createAccount($user);
        } else {
            # code...
            require_once APP_ROOT . '/views/layout.view.php';
        }
    }

    public function createAccount($user)
    {
        if (isset($_POST['userName']) && isset($_POST['fistName'])
            && isset($_POST['lastName']) && isset($_POST['Email']) && isset($_POST['Password'])) {
            $username = $_POST['userName'];
            $password = $_POST['Password'];
            $FirstNname = $_POST['fistName'];
            $LastNname = $_POST['lastName'];
            $Email = $_POST['Email'];
            # code...
            $user->createAccount($username, $password);
            $user->createUserDetail($username, $FirstNname, $LastNname, $Email);
            $user->createAccountGroup($username);
        }
    }

    public function createUserAction(RouteCollection $routes, Request $request) {
        print_r($_POST);
        $user = new User();
        $user->createUser($_POST);
    }
}
