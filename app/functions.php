<?php
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

function view($name, $model = '')
{
    require_once APP_ROOT . '/views/layout.view.php';
}

function redirect($url)
{
    header("Location: $url");
    die();
}

function getPath(RouteCollection $routes, $name)
{
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

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function isLoggedIn()
{
    if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false)
        return false;
    return true;
}

function permissionCheck()
{

}

function startSession()
{
    session_start();
    $_SESSION['showNav'] = true;
}

function getOrderStatusClass($status)
{
    switch ($status) {
        case "1":
        case "3":
            echo "color--btn";
            break;
        case "2":
        case "4":
            echo "color-success";
            break;
        case "5":
            echo "color--red";
            break;
        default:
            echo "color--btn";
    }
}

function getOrderStatusClassAdmin($status)
{
    switch ($status) {
        case "1":
        case "3":
            echo "badge-warning-lighten";
            break;
        case "2":
        case "4":
            echo "badge-success-lighten";
            break;
        case "5":
            echo "badge-danger-lighten";
            break;
        default:
            echo "badge-info-lighten";
    }
}

function checkImg($user)
{
    $image = '/xampp/htdocs/2LKShop/public/images/user_avatar/user_avatar_' . $user->getUsername();
    $anhJpeg = '/2LKShop/public/images/user_avatar/user_avatar_' . $user->getUsername() . '.jpeg';
    $anhJpg = '/2LKShop/public/images/user_avatar/user_avatar_' . $user->getUsername() . '.jpg';
    $anhPng = '/2LKShop/public/images/user_avatar/user_avatar_' . $user->getUsername() . '.png';
    $anhWebp = '/2LKShop/public/images/user_avatar/user_avatar_' . $user->getUsername() . '.webp';
    if (file_exists($image . '.jpeg')) {
        echo "<img src= $anhJpeg alt='User photo' class='nav-user__user-photo' />";
    } elseif ((file_exists($image . '.png'))) {
        echo "<img src= $anhPng alt='User photo' class='nav-user__user-photo' />";
    } elseif ((file_exists($image . '.jpg'))) {
        echo "<img src= $anhJpg alt='User photo' class='nav-user__user-photo' />";
    } elseif ((file_exists($image . '.jpg'))) {
        echo "<img src= $anhWebp alt='User photo' class='nav-user__user-photo' />";
    } else {
        echo "<img src='/2LKShop/public/images/user_avatar/avatar_default.jpg' />";
    }
}

function getSessionUser()
{
    $user = new User();
    $user = unserialize($_SESSION['user']);
    return $user;
}