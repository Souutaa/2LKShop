<?php
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

function view($name, $model='') {
    require_once APP_ROOT . '/views/layout.view.php';
}

function redirect($url) {
    header("Location: $url");
    die();
}

function getPath(RouteCollection $routes, $name) {
    return $routes->get($name)->getPath();
}

function connect($source = DB)
{
    try {
        $dbConnection = new PDO($source, DB_USER, DB_PASS);
        $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    } catch (PDOException $e) {
        return null;
    }
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function isLoggedIn() {
    if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false)
        return false;
    return true;
}

function permissionCheck() {
    
}

function startSession() {
    session_start();
    $_SESSION['showNav'] = true;
}

function getOrderStatusClass($status) {
    switch ($status){
        case "1": case"3":
            echo "color--btn";
            break;
        case "2": case "4":
            echo "color-success";
            break;
        case "5":
            echo "color--red";
            break;
        default:
            echo "color--btn";
    }
}

function getOrderStatusClassAdmin($status) {
    switch ($status){
        case "1": case"3":
            echo "badge-warning-lighten";
            break;
        case "2": case "4":
            echo "badge-success-lighten";
            break;
        case "5":
            echo "badge-danger-lighten";
            break;
        default:
            echo "badge-info-lighten";
    }
}

function getSessionUser() {
    $user = new User();
    $user = unserialize($_SESSION['user']);
    return $user;
}