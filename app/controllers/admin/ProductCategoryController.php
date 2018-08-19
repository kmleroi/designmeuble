<?php
namespace App\Controllers\Admin;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Role;
use App\Classes\Session;
//use app\Classes\ValidateRequest;
use App\Classes\Validate;
use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rubric;
use App\Models\SubCategory;


class ProductCategoryController extends BaseController
{
    public $table_name = 'categories';
    public $categories;
    public $rubrics;
    public $subcategories;
    public $subcategories_links;
    public $links;
    
   /* public function __construct()
    {
        if(!Role::middleware('Admin')){
            Redirect::to('/login');
        }
        $total = Category::all()->count();
        $subTotal = SubCategory::all()->count();
        $object = new Category;
    
        list($this->categories, $this->links) = paginate(10, $total, $this->table_name, $object);
        list($this->subcategories, $this->subcategories_links) = paginate(10, $subTotal, 'sub_categories', new SubCategory);
    }*/
    
    public function show()
    {
        /*return view('Admin/products/categories', [
            'categories' => $this->categories, 'links' => $this->links,
            'subcategories' => $this->subcategories, 'subcategories_links' => $this->subcategories_links,
        ]);*/

        $categories = Category::all();
        return view('admin/products/categories', compact('categories'));
    }
    public function showCat($id)
    {
        $categories = Category::where('id', $id)->first();
        $rubric = Rubric::where('id',$categories->rubric_id)->first();
        $subCat = SubCategory::where('category_id',$id)->get();
        $products = Product::where('category_id',$id)->get();
        return view('admin/products/editCategory', compact('categories','subCat','products','rubric'));
    }
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        $rubric = Rubric::where('id',$category->rubric_id)->first();
        $rubrics = Rubric::all();
        return view('admin/products/formCategory', compact('category','rubric','rubrics'));
    }

    public function store()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token,false)){

                if(!empty($_POST)) {

                    $categories = Category::where('rubric_id', $request->rubric_id)->where('name',$request->name)->get();
                    if(count($categories)){
                        $errors[] = 'Cette catégorie existe déja dans cette rubrique';
                        header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                        echo json_encode($errors);
                        exit;
                    }else{
                        $validate = new Validate();
                        $validation = $validate->check($_POST, array(
                            'name' => [
                                'required' => true,
                                'length_min' => 3,
                                'length_max' => 30
                            ]
                        ));
                        if($validation->passed()) {
                            $pos = Category::select('position')->where('rubric_id',$request->rubric_id)->orderBy('position','desc')->first();
                            $pos = $pos->position +1;
                            //process form data
                            $lastId = Category::create([
                                'name' => $request->name,
                                'slug' => slug($request->name),
                                'view' => slug($request->view),
                                'rubric_id' => $request->rubric_id,
                                'position'=> $pos
                            ])->id;
                            echo $lastId;
                            exit;
                            //$success = 'Category created';
                            //$categories = Category::all();
                            //return view('Admin/products/categories', compact('categories', 'success'));*/
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
                            //$data = $request;
                            //return view('Admin/products/addCategory', compact('data','errors'));

                        }
                    }
                }
                /*
                $total = Category::all()->count();
                $subTotal = SubCategory::all()->count();
                list($this->categories, $this->links) = paginate(10, $total, $this->table_name, new Category);
                list($this->subcategories, $this->subcategories_links) = paginate(10, $subTotal, 'sub_categories', new SubCategory);
                return view('Admin/products/categories', [
                    'categories' => $this->categories, 'links' => $this->links, 'success' => 'Category Created',
                    'subcategories' => $this->subcategories, 'subcategories_links' => $this->subcategories_links,
                ]);*/
            }
            throw new \Exception('Token mismatch');
        }

        return null;
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
                        //process form data
                        Category::where('id', $id)->update([
                            'name' => $request->name,
                            'slug' => slug($request->name),
                            'rubric_id' => $request->rubric_id,
                            'description' =>$request->description,
                            'view' =>$request->view,
                            'imageCat' =>$request->imageCat,
                            'title' =>$request->title,
                            'metaDescription' =>$request->metaDescription,
                            'metaKeywords' =>$request->metaKeywords
                        ]);
                        echo json_encode(['success' => 'Record Update Successfully']);
                        exit;
                        //si redirection et non trt par ajax
                        //$categories = Category::where('id', $id)->first();
                        //$success = 'Category updated';
                        //$subCat = SubCategory::where('category_id',$id)->get();
                        //return view('Admin/products/EditCategory', compact('categories','subCat','success'));
                    }
                    else {
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
                        Category::where('id', $id)->update([
                            'view' =>$request->view
                        ]);
                        $subcategories = SubCategory::where('category_id', $id)->get();
                        if(count($subcategories)){
                            foreach ($subcategories as $subcategory){
                                $subcategory->update([
                                    'view' =>$request->view
                                ]);
                            }
                        }
                        $products = Product::where('category_id', $id)->get();
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
            
            if(CSRFToken::verifyCSRFToken($request->token,false)){
                Category::destroy($id);
                
                $subcategories = SubCategory::where('category_id', $id)->get();
                if(count($subcategories)){
                    foreach ($subcategories as $subcategory){
                        $subcategory->delete();
                    }
                }
                $products = Product::where('category_id', $id)->get();
                if(count($products)){
                    foreach ($products as $product){
                        $product->delete();
                    }
                }
                echo 'success';
                exit;
                //si traitement par lien direct sans passer par ajax
               // Session::add('success', 'Categorie supprimée');
                //Redirect::to('/Admin/categories');
            }
            //reponse ajax en cas d'erreur
            header('HTTP/1.1 422 Unprocessable Entity', true, 422);

            throw new \Exception('Token mismatch');
        }
        
        return null;
    }

}