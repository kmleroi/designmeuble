<?php
namespace App\Controllers\Admin;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Role;
use App\Classes\Session;
use App\classes\Validate;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rubric;
use App\Models\SubCategory;

class SubCategoryController extends BaseController
{
    /*public function __construct()
    {
        if(!Role::middleware('Admin')){
            Redirect::to('/login');
        }
    }*/
    public function showCat($id)
    {
        $subCat = SubCategory::where('id', $id)->first();
        $categorie = Category::where('id', $subCat->category_id)->first();
        $rubric = Rubric::where('id', $subCat->rubric_id)->first();
        $products = Product::where('sub_category_id', $subCat->id)->get();
        return view('admin/products/editSubCategory', compact('subCat','categorie','products','rubric'));
    }
    public function store()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)){
                $subcategories_check = SubCategory::where('category_id', $request->category_id)->where('name',$request->name)->get();
                if(count($subcategories_check)){
                    $errors[] = 'Cette sous-catégorie existe déja dans cette catégorie';
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
                else{
                    $validate = new Validate();
                    $validation = $validate->check($_POST, array(
                        'name' => [
                            'required' => true,
                            'length_min' => 3,
                            'length_max' => 30
                        ]
                    ),'sub_categories','name');
                    if($validation->passed()) {
                        $errors = [];
                        $duplicate_subcategory = SubCategory::where('name', $request->name)
                            ->where('category_id', $request->category_id)->exists();
                        if($duplicate_subcategory){
                            $errors[] = 'Cette sous-catégorie existe déjà';
                            header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                            echo json_encode($errors);
                            exit;
                        }
                        else{
                            $category = Category::where('id', $request->category_id)->exists();
                            if(!$category){
                                $errors[]='Catégorie invalide';
                                header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                                echo json_encode($errors);
                                exit;
                            }
                            else{
                                $pos = SubCategory::select('position')->where('category_id', $request->category_id)->orderBy('position','desc')->first();
                                $pos = $pos->position +1;
                                //process form data
                                $lastId = SubCategory::create([
                                    'name' => $request->name,
                                    'rubric_id' => $request->rubric_id,
                                    'category_id' => $request->category_id,
                                    'slug' => slug($request->name),
                                    'view' => slug($request->view),
                                    'position'=> $pos
                                ])->id;
                                echo $lastId;
                                exit;
                            }
                        }
                    }
                    else {
                        $errors = [];
                        foreach($validation->errors() as $error)
                        {
                            $errors [] = $error;
                        }
                        header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                        echo json_encode($errors);
                        exit;
                    }
                }
            }
            throw new \Exception('Token mismatch');
        }
        
        return null;
    }
    public function edit($id)
    {
        $subCat = SubCategory::where('id', $id)->first();
        $category = Category::where('id', $subCat->category_id)->first();
        $rubric = Rubric::where('id', $subCat->rubric_id)->first();
        $categories = Category::all();
        $rubrics = Rubric::all();
        return view('admin/products/formCategory', compact('subCat','category','categories','rubric','rubrics'));
    }
    public function update($id)
    {
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)){
                if(!empty($_POST)) {
                    $validate = new Validate();
                    $validation = $validate->check($_POST, array(
                        'name' => array(
                            'required' => true,
                            'length_min' => 3,
                            'length_max' => 30
                        ),
                        'metaDescription' => array(
                            'length_max' => 150
                        ),
                        'view' => array(
                            'numeric' => true
                        )
                    ));
                    if($validation->passed()) {
                        $errors = [];
                        $category = Category::where('id', $request->category_id)->exists();
                        if(!$category){
                            $errors[]='Categorie parente invalide.';
                            header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                            echo json_encode($errors);
                            exit;
                        }
                        else{
                            SubCategory::where('id', $id)->update(
                                [
                                    'name' => $request->name,
                                    'slug' => slug($request->name),
                                    'category_id' => $request->category_id,
                                    'rubric_id' => $request->rubric_id,
                                    'description' =>$request->description,
                                    'imageSousCat' =>$request->imageSubCat,
                                    'title' =>$request->title,
                                    'metaDescription' =>$request->metaDescription,
                                    'metaKeywords' =>$request->metaKeywords,
                                    'view' =>$request->view
                                ]
                            );
                        }
                        echo json_encode(['success' => 'Record Update Successfully']);
                        exit;
                    }
                    else {
                        $errors = [];
                        foreach($validation->errors() as $error)
                        {
                            $errors [] = $error;
                        }
                        header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                        echo json_encode($errors);
                        exit;
                        //$categories = Category::where('id', $id)->first();
                        //$subCat = SubCategory::where('category_id',$id)->get();
                        //return view('Admin/products/EditCategory', compact('categories','subCat','errors'));
                    }
                }

            }
            throw new \Exception('Token mismatch');
        }

        return null;
    }

    public function activation($id)
    {
        if(Request::has('post')){
            $request = Request::get('post');
            //if(CSRFToken::verifyCSRFToken($request->token, false)){
            if(!empty($_POST)) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'view' => ['numeric' => true]));
                if($validation->passed()) {
                    //process form data
                    SubCategory::where('id', $id)->update([
                        'view' =>$request->view
                    ]);
                    $products = Product::where('sub_category_id', $id)->get();
                    if(count($products)){
                        foreach ($products as $product){
                            $product->update([
                                'view' =>$request->view
                            ]);
                        }
                    }
                    echo json_encode(['success' => 'Record Update Successfully']);
                    exit;
                }
                else {
                    foreach($validation->errors() as $error)
                    {
                        $errors [] = $error;
                    }
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
            }

            //}
            //throw new \Exception('Token mismatch');
        }

        return null;
    }


    public function delete($id)
    {
        if(Request::has('post')){
            $request = Request::get('post');
            
            if(CSRFToken::verifyCSRFToken($request->token)){
                SubCategory::destroy($id);
                $products = Product::where('sub_category_id', $id)->get();
                if(count($products)){
                    foreach ($products as $product){
                        $product->delete();
                    }
                }
                echo 'success';
                exit;
                //Session::add('success', 'Subcategory Deleted');
                //Redirect::to('/Admin/product/categories');
            }
            throw new \Exception('Token mismatch');
        }
        
        return null;
    }

    public function getCategories($id)
    {
        $categories = Category::where('rubric_id', $id)->get();
        echo json_encode($categories);
        exit;
    }
}