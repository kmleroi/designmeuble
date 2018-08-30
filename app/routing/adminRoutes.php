<?php

$router->map('GET', '/admin', 'App\Controllers\Admin\DashboardController@show', 'admin_dashboard');
$router->map('GET', '/admin/', 'App\Controllers\Admin\DashboardController@show', 'admin_dashboard_2');

/************************ rubrics managment **********************...**********/

//Show all rubrics
$router->map('GET', '/admin/rubriques',
    'App\Controllers\Admin\RubricController@show', 'liste_rubrics');
//show a rubric
$router->map('GET', '/admin/rubriques/[i:id]/',
    'App\Controllers\Admin\RubricController@showCat', 'rubriq');
// add a new rubrics
$router->map('POST', '/admin/rubriques',
    'App\Controllers\Admin\RubricController@store', 'create_rubrics');
// update a rubrics
$router->map('GET', '/admin/rubriques/[i:id]/edit',
    'App\Controllers\Admin\RubricController@edit', 'edit_rubric');
$router->map('POST', '/admin/rubriques/[i:id]/update',
    'App\Controllers\Admin\RubricController@update', 'update_rubric');
// delete a category
$router->map('POST', '/admin/rubriques/[i:id]/delete',
    'App\Controllers\Admin\RubricController@delete', 'delete_rubric');
// activation category
$router->map('POST', '/admin/rubriques/[i:id]/activation',
    'App\Controllers\Admin\RubricController@activation', 'activation_rubriques');
/************************ Categories managment ********************************/

//Show all categories
$router->map('GET', '/admin/categories',
    'App\Controllers\Admin\ProductCategoryController@show', 'liste_product_category');
// add a new category
$router->map('POST', '/admin/categories',
    'App\Controllers\Admin\ProductCategoryController@store', 'create_product_category');
//show a category
$router->map('GET', '/admin/categories/[i:id]/',
    'App\Controllers\Admin\ProductCategoryController@showCat', 'product_category');
// update a category
$router->map('GET', '/admin/categories/[i:id]/edit',
    'App\Controllers\Admin\ProductCategoryController@edit', 'edit_product_category');
$router->map('POST', '/admin/categories/[i:id]/update',
    'App\Controllers\Admin\ProductCategoryController@update', 'update_product_category');
// delete a category
$router->map('POST', '/admin/categories/[i:id]/delete',
    'App\Controllers\Admin\ProductCategoryController@delete', 'delete_product_category');
// activation category
$router->map('POST', '/admin/categories/[i:id]/activation',
    'App\Controllers\Admin\ProductCategoryController@activation', 'activation_product_category');
/******************************************************************************************************************/

/* Sous categories */
// add a new Subcategory
$router->map('POST', '/admin/subcategories/add',
    'App\Controllers\Admin\SubCategoryController@store', 'create_subcategory');
// update a Subcategory
$router->map('GET', '/admin/subcategories/[i:id]/edit',
    'App\Controllers\Admin\SubCategoryController@edit', 'edit_subcategory');
$router->map('POST', '/admin/subcategories/[i:id]/update',
    'App\Controllers\Admin\SubCategoryController@update', 'update_subcategory');
//show a Subcategory
$router->map('GET', '/admin/subcategories/[i:id]',
    'App\Controllers\Admin\SubCategoryController@showCat', 'Subcategory');
// delete a category
$router->map('POST', '/admin/subcategories/[i:id]/delete',
    'App\Controllers\Admin\SubCategoryController@delete', 'delete_subcategory');
// activation category
$router->map('POST', '/admin/subcategories/[i:id]/activation',
    'App\Controllers\Admin\SubCategoryController@activation', 'activation_subcategory');
// get categories
$router->map('POST', '/admin/subcategories/[i:id]/getCategories',
    'App\Controllers\Admin\SubCategoryController@getCategories', 'get_category');
/******************************************************************************************************************/
/* Products Admin */
/* add a new Product
$router->map('GET', '/admin/products/[i:id]/add',
    'App\Controllers\Admin\ProductController@add', 'create_product_form');*/
$router->map('POST', '/admin/products/add',
    'App\Controllers\Admin\ProductController@store', 'create_product');
// update a Product
$router->map('GET', '/admin/products/[i:id]/edit',
    'App\Controllers\Admin\ProductController@edit', 'edit_product');
$router->map('POST', '/admin/products/[i:id]/update',
    'App\Controllers\Admin\ProductController@update', 'update_product');
//show a Product
$router->map('GET', '/admin/products/[i:id]',
    'App\Controllers\Admin\ProductController@showCat', 'product');
// delete a Product
$router->map('POST', '/admin/products/[i:id]/delete',
    'App\Controllers\Admin\ProductController@delete', 'delete_product');
// activation Product
$router->map('POST', '/admin/products/[i:id]/activation',
    'App\Controllers\Admin\ProductController@activation', 'activation_product');
// get categories
$router->map('POST', '/admin/products/[i:id]/getCollections',
    'App\Controllers\Admin\ProductController@getCollections', 'get_collections');
// upload image
$router->map('POST', '/admin/products/uploadFile',
    'App\Controllers\Admin\ProductController@uploadImage', 'upload_image');

/******************************************************************************************************************/
