<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();


$routes->add('user', new Route(constant('URL_SUBFOLDER') . '/user/uploadimg', array('controller' => 'UserController', 'method' => 'updateUserAvatar'), array()));

$routes->add('product', new Route(constant('URL_SUBFOLDER') . '/product/{id}', array('controller' => 'ProductController', 'method' => 'showAction'), array('id' => '([^&]*)')));
$routes->add('deleteProduct', new Route(constant('URL_SUBFOLDER') . '/delete/product/{id}', array('controller' => 'ProductController', 'method' => 'deleteAction'), array('id' => '([^&]*)')));

$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'PageController', 'method' => 'indexAction'), array()));
$routes->add('getCategory', new Route(constant('URL_SUBFOLDER') . '/getCategory', array('controller' => 'PageController', 'method' => 'changeCategory'), array()));
$routes->add('search', new Route(constant('URL_SUBFOLDER') . '/search/{searchStr}', array('controller' => 'PageController', 'method' => 'searchAction'), array('searchStr' => '([^&]*)')));
$routes->add('viewProducts', new Route(constant('URL_SUBFOLDER') . '/view/product', array('controller' => 'PageController', 'method' => 'viewProduct'), array('searchStr' => '([^&]*)')));
$routes->add('viewCategory', new Route(constant('URL_SUBFOLDER') . '/view/category/{category}', array('controller' => 'PageController', 'method' => 'viewCategory'), array('category' => '([^&]*)')));
$routes->add('updateViewCategory', new Route(constant('URL_SUBFOLDER') . '/filter/category', array('controller' => 'PageController', 'method' => 'filterCategory'), array()));

$routes->add('viewCart', new Route(constant('URL_SUBFOLDER') . '/cart', array('controller' => 'CartController', 'method' => 'indexAction'), array()));
$routes->add('getCartItems', new Route(constant('URL_SUBFOLDER') . '/getCart', array('controller' => 'CartController', 'method' => 'getCartItemsAction'), array()));
$routes->add('paymentInfo', new Route(constant('URL_SUBFOLDER') . '/paymentInfo', array('controller' => 'CartController', 'method' => 'paymentInfoAction'), array()));

$routes->add('viewOrders', new Route(constant('URL_SUBFOLDER') . '/orders', array('controller' => 'OrderController', 'method' => 'viewOrdersAction'), array()));
$routes->add('viewOrderDetail', new Route(constant('URL_SUBFOLDER') . '/order/{orderId}', array('controller' => 'OrderController', 'method' => 'viewOrderDetailAction'), array('orderId' => '([^&]*)')));
$routes->add('createOrder', new Route(constant('URL_SUBFOLDER') . '/createOrder', array('controller' => 'OrderController', 'method' => 'createOrderAction'), array()));
$routes->add('cancelOrder', new Route(constant('URL_SUBFOLDER') . '/cancelOrder/{id}', array('controller' => 'OrderController', 'method' => 'cancelOrderAction'), array('id' => '([^&]*)')));
$routes->add('viewPersonalInfo', new Route(constant('URL_SUBFOLDER') . '/information', array('controller' => 'OrderController', 'method' => 'viewPersonalInformationAction'), array()));

$routes->add('login', new Route(constant('URL_SUBFOLDER') . '/login', array('controller' => 'SessionController', 'method' => 'loginAction'), array()));
$routes->add('logout', new Route(constant('URL_SUBFOLDER') . '/logout', array('controller' => 'SessionController', 'method' => 'logoutAction'), array()));
$routes->add('register', new Route(constant('URL_SUBFOLDER') . '/register', array('controller' => 'RegisterController', 'method' => 'indexAction')));

$routes->add('admin', new Route(constant('URL_SUBFOLDER') . '/admin', array('controller' => 'AdminController', 'method' => 'indexHomeAction'), array()));

$routes->add('adminProduct', new Route(constant('URL_SUBFOLDER') . constant('ADMINPRODUCT'), array('controller' => 'AdminController', 'method' => 'indexProductAction'), array()));
$routes->add('createProduct', new Route(constant('URL_SUBFOLDER') . constant('ADMINPRODUCT') . '/create', array('controller' => 'ProductController', 'method' => 'createProduct'), array()));
$routes->add('getProductDetail', new Route(constant('URL_SUBFOLDER') . constant('ADMINPRODUCT') . '/detail/{id}', array('controller' => 'ProductController', 'method' => 'getProductDetail'), array('id' => '([^&]*)')));
$routes->add('editProduct', new Route(constant('URL_SUBFOLDER') . constant('ADMINPRODUCT') . '/edit/{id}', array('controller' => 'ProductController', 'method' => 'editAction'), array('id' => '([^&]*)')));
$routes->add('updateProduct', new Route(constant('URL_SUBFOLDER') . constant('ADMINPRODUCT') . '/saveChange', array('controller' => 'ProductController', 'method' => 'updateAction'), array()));
$routes->add('addQty', new Route(constant('URL_SUBFOLDER') . constant('ADMINPRODUCT') . '/addQty/{id}', array('controller' => 'ProductController', 'method' => 'addQtyAction'), array('id' => '([^&]*)')));
$routes->add('saveQty', new Route(constant('URL_SUBFOLDER') . constant('ADMINPRODUCT') . '/saveQty', array('controller' => 'ProductController', 'method' => 'saveQtyAction'), array()));

$routes->add('adminOrders', new Route(constant('URL_SUBFOLDER') . '/admin/orders', array('controller' => 'AdminController', 'method' => 'indexOrderAction'), array()));
$routes->add('getOrderDetail', new Route(constant('URL_SUBFOLDER') . '/admin/order/detail/{id}', array('controller' => 'OrderController', 'method' => 'getOrderDetail'), array('id' => '([^&]*)')));
$routes->add('updateOrderStatus', new Route(constant('URL_SUBFOLDER') . '/admin/order/updateStatus', array('controller' => 'OrderController', 'method' => 'updateOrderStatusAction'), array()));

$routes->add('adminUsers', new Route(constant('URL_SUBFOLDER') . '/admin/users', array('controller' => 'AdminController', 'method' => 'indexUserAction'), array()));
$routes->add('createUser', new Route(constant('URL_SUBFOLDER') . '/admin/createUser', array('controller' => 'RegisterController', 'method' => 'createUserAction'), array()));
$routes->add('getEditUserForm', new Route(constant('URL_SUBFOLDER') . '/admin/getEditUserForm', array('controller' => 'UserController', 'method' => 'getEditUserFormAction'), array()));
$routes->add('updateUserInfo', new Route(constant('URL_SUBFOLDER') . '/admin/updateUserInfo', array('controller' => 'UserController', 'method' => 'updateUserInfoAction'), array()));
$routes->add('deactiveUser', new Route(constant('URL_SUBFOLDER') . '/admin/deactiveUser', array('controller' => 'UserController', 'method' => 'deactiveUserAction'), array()));

$routes->add('adminBrands', new Route(constant('URL_SUBFOLDER') . constant('ADMINBRAND'), array('controller' => 'AdminController', 'method' => 'indexBrandAction'), array()));
$routes->add('createBrands', new Route(constant('URL_SUBFOLDER') . constant('ADMINBRAND') . '/create', array('controller' => 'BrandController', 'method' => 'createBrand'), array()));
$routes->add('editBrands', new Route(constant('URL_SUBFOLDER') . constant('ADMINBRAND') . '/edit/{id}', array('controller' => 'BrandController', 'method' => 'editAction'), array('id' => '([^&]*)')));
$routes->add('updateBrand', new Route(constant('URL_SUBFOLDER') . constant('ADMINBRAND') . '/saveChange', array('controller' => 'BrandController', 'method' => 'updateAction'), array()));
$routes->add('deleteBrand', new Route(constant('URL_SUBFOLDER') . constant('ADMINBRAND') . '/delete/{id}', array('controller' => 'BrandController', 'method' => 'deleteAction'), array('id' => '([^&]*)')));

$routes->add('adminCategory', new Route(constant('URL_SUBFOLDER') . constant('ADMINCATEGORY'), array('controller' => 'AdminController', 'method' => 'indexCategoryAction'), array()));
$routes->add('createCategory', new Route(constant('URL_SUBFOLDER') . constant('ADMINCATEGORY') . '/create', array('controller' => 'CategoryController', 'method' => 'createCategory'), array()));
$routes->add('editCategory', new Route(constant('URL_SUBFOLDER') . constant('ADMINCATEGORY') . '/edit/{id}', array('controller' => 'CategoryController', 'method' => 'editAction'), array('id' => '([^&]*)')));
$routes->add('updateCategory', new Route(constant('URL_SUBFOLDER') . constant('ADMINCATEGORY') . '/saveChange', array('controller' => 'CategoryController', 'method' => 'updateAction'), array()));
$routes->add('deleteCategory', new Route(constant('URL_SUBFOLDER') . constant('ADMINCATEGORY') . '/delete/{id}', array('controller' => 'CategoryController', 'method' => 'deleteAction'), array('id' => '([^&]*)')));

$routes->add('adminRoles', new Route(constant('URL_SUBFOLDER') . '/admin/roles', array('controller' => 'AdminController', 'method' => 'indexRoleAction'), array()));
$routes->add('adminPermissions', new Route(constant('URL_SUBFOLDER') . '/admin/permissions', array('controller' => 'AdminController', 'method' => 'indexPermissionAction'), array()));
$routes->add('getRolePermission', new Route(constant('URL_SUBFOLDER') . '/admin/getRolePermission', array('controller' => 'RoleController', 'method' => 'getRolePermissionAction'), array()));
$routes->add('getRoleInformation', new Route(constant('URL_SUBFOLDER') . '/admin/getRoleInformation', array('controller' => 'RoleController', 'method' => 'getRoleInformationAction'), array()));
$routes->add('removeUserGroupRole', new Route(constant('URL_SUBFOLDER') . '/admin/removeUserGroupRole', array('controller' => 'RoleController', 'method' => 'removeUserGroupRoleAction'), array()));
$routes->add('toggleDisableRole', new Route(constant('URL_SUBFOLDER') . '/admin/toggleDisableRole', array('controller' => 'RoleController', 'method' => 'toggleDisableRoleAction'), array()));
$routes->add('createRole', new Route(constant('URL_SUBFOLDER') . '/admin/createRole', array('controller' => 'RoleController', 'method' => 'createRoleAction'), array()));
$routes->add('getEditRoleForm', new Route(constant('URL_SUBFOLDER') . '/admin/getEditRoleForm', array('controller' => 'RoleController', 'method' => 'getEditRoleFormAction'), array()));
$routes->add('editRole', new Route(constant('URL_SUBFOLDER') . '/admin/editRole', array('controller' => 'RoleController', 'method' => 'editRoleAction'), array()));
$routes->add('deleteRole', new Route(constant('URL_SUBFOLDER') . '/admin/deleteRole', array('controller' => 'RoleController', 'method' => 'deleteRoleAction'), array()));

$routes->add('getEditPermissionGroupForm', new Route(constant('URL_SUBFOLDER') . '/admin/getEditPermissionGroupForm', array('controller' => 'PermissionGroupController', 'method' => 'getEditPermissionGroupFormAction'), array()));
$routes->add('createPermission', new Route(constant('URL_SUBFOLDER') . '/admin/createPermission', array('controller' => 'PermissionController', 'method' => 'postPermissionFormAction'), array()));
$routes->add('getPermissionDetail', new Route(constant('URL_SUBFOLDER') . '/admin/getPermissionDetail', array('controller' => 'PermissionController', 'method' => 'getPermissionDetailAction'), array()));
$routes->add('updatePermissionState', new Route(constant('URL_SUBFOLDER') . '/admin/updatePermissionState', array('controller' => 'PermissionController', 'method' => 'updatePermissionStateAction'), array()));
$routes->add('addUserGroupPermission', new Route(constant('URL_SUBFOLDER') . '/admin/addUserGroupPermission', array('controller' => 'PermissionController', 'method' => 'addUserGroupPermissionAction'), array()));
$routes->add('removeUserGroupPermission', new Route(constant('URL_SUBFOLDER') . '/admin/removeUserGroupPermission', array('controller' => 'PermissionController', 'method' => 'removeUserGroupPermissionAction'), array()));
$routes->add('getPermissionForm', new Route(constant('URL_SUBFOLDER') . '/admin/getPermissionForm', array('controller' => 'PermissionController', 'method' => 'getPermissionFormAction'), array()));

$routes->add('adminPermissionGroups', new Route(constant('URL_SUBFOLDER') . '/admin/permissionGroups', array('controller' => 'AdminController', 'method' => 'indexPermissionGroupAction'), array()));
$routes->add('createPermissionGroup', new Route(constant('URL_SUBFOLDER') . '/admin/createPermissionGroup', array('controller' => 'PermissionGroupController', 'method' => 'createPermissionGroupAction'), array()));
$routes->add('updatePermissionGroupState', new Route(constant('URL_SUBFOLDER') . '/admin/updatePermissionGroupState', array('controller' => 'PermissionGroupController', 'method' => 'updatePermissionGroupStateAction'), array()));
$routes->add('updatePermissionGroup', new Route(constant('URL_SUBFOLDER') . '/admin/updatePermissionGroup', array('controller' => 'PermissionGroupController', 'method' => 'updatePermissionGroupAction'), array()));