<?php

namespace App\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Products;
use App\Models\Warranties;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RouteCollection;

class ProductController
{
    // Show the product attributes based on the id.
    public function showAction(string $id, RouteCollection $routes, Request $request)
    {
        startSession();
        $name = 'product';
        $product = new Product();
        try {
            $product->read($id);
        } catch (ResourceNotFoundException $err) {
            redirect(getPath($routes, 'homepage'));
        }
        require_once APP_ROOT . '/views/layout.view.php';
    }

    public function createProduct(RouteCollection $routes, Request $request)
    {
        startSession();
        $product = new Product();
        $product->create($_POST, $_FILES);
    }

    public function indexAction(RouteCollection $routes, Request $request) {
        startSession();
        $productList = new Products();
        $productList->getAll();
        $name = 'admin/product/index';
        require_once APP_ROOT . '/views/layout.view.php';
    }

    public function editAction(string $id, RouteCollection $routes, Request $request) {
        startSession();
        $product = new Product();
        $product->read($id);
        $brands = new Brands();
        $brands->readAll();
        $categories = new Categories();
        $categories->readAll();
        $warrantyList = new Warranties();
        $warrantyList->getAll();
        require_once APP_ROOT . '/views/admin/product/edit.view.php';
    }

    public function updateAction(RouteCollection $routes, Request $request) {
        startSession();
        $product = new Product();
        $product->update($_POST, $_FILES);
    }

    public function deleteAction(string $id, RouteCollection $routes, Request $request) {
        $product = new Product();
        $product->delete($id);
    }

    public function getProductDetail(string $id, RouteCollection $routes, Request $request) {
        startSession();
        $product = new Product();
        $product->read($id);
        require_once APP_ROOT . '/views/admin/product/detail.view.php';
    }

    public function addQtyAction(string $id, RouteCollection $routes, Request $request) {
        startSession();
        $productId = $id;
        require_once APP_ROOT . '/views/admin/product/add_quantity.view.php';
    }

    
    public function saveQtyAction(RouteCollection $routes, Request $request) {
        startSession();
        print_r($_POST);
        $product = new Product();
        $product->addQty($_POST);
        // require_once APP_ROOT . '/views/admin/product/add_quantity.view.php';
    }
}   