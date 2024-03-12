<?php
namespace App\Controllers;

use App\Models\Brand;
use App\Models\Brands;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RouteCollection;

class BrandController{
    public function showAction(string $id, RouteCollection $routes, Request $request)
    {
        startSession();
        $name = 'brand';
        $brand = new Brand();
        try {
            $brand->read($id);
        } catch (ResourceNotFoundException $err) {
            redirect(getPath($routes, 'homepage'));
        }
        require_once APP_ROOT . '/views/layout.view.php';
    }
    public function createBrand(RouteCollection $routes ,Request $request){
        startSession();
        $brand = new Brand();
        print_r($_POST);
        $brand->create($_POST);
    }
    public function editAction(string $id, RouteCollection $routes, Request $request) {
        startSession();
        $brand = new Brand();
        $brand->read($id);
        require_once APP_ROOT . '/views/admin/brand/edit.view.php';
    }
    public function updateAction( RouteCollection $routes, Request $request) {
        startSession();
        $brand = new Brand();
        $brand->update($_POST);
    }
    public function deleteAction(string $id, RouteCollection $routes, Request $request) {
        startSession();
        $brand = new Brand();
        $brand->delete($id);
        print_r("check");
        echo "delete";
        require_once APP_ROOT . '/views/admin/brand/edit.view.php';
    }

}
?>