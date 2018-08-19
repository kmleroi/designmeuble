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


class RubricController extends BaseController
{
    public $table_name = 'rubrics';
    public $categories;
    public $subcategories;

   /* public function __construct()
    {
        
        if(!Role::middleware('Admin')){
            Redirect::to('/login');
        }
    }*/

    /**
     * Function for showing all rubrics
     */
    public function show()
    {
        $rubrics = Rubric::all();
        return view('admin/products/rubrics', compact('rubrics'));
    }

    /**
     * function for showing one rubric and his content
     * @param $id
     */
    public function showCat($id)
    {
        $rubric = Rubric::where('id', $id)->first();
        $categories = Category::where('rubric_id',$id)->get();
        $products = Product::where('rubric_id',$id)->get();
        return view('admin/products/editRubric', compact('categories','rubric','products'));
    }

    /**
     * function for editing the form for this rubric
     * @param $id
     */
    public function edit($id)
    {
        $rubric = Rubric::where('id', $id)->first();
        return view('admin/products/formCategory', compact('rubric'));
    }

    /**
     * function for add a new rubric
     * @return null
     * @throws \Exception
     */
    public function store()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token,false)){

                if(!empty($_POST)) {
                    $validate = new Validate();
                    $validation = $validate->check($_POST, array(
                        'name' => [
                            'required' => true,
                            'length_min' => 3,
                            'length_max' => 30,
                            'unique' => true
                        ]
                    ),'rubrics','name');
                    if($validation->passed()) {
                        $pos = Rubric::select('position')->orderBy('position','desc')->first();
                        $pos = $pos->position +1;
                        //process form data
                        $lastId = Rubric::create([
                            'name' => $request->name,
                            'slug' => slug($request->name),
                            'view' => slug($request->view),
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

    /**
     * function for update this rubric
     * @param $id
     * @return null
     * @throws \Exception
     */
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
                            'length_max' => 30,
                            'unique' => true
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
                            'view' =>$request->view,
                            'title' =>$request->title,
                            'metaDescription' =>$request->metaDescription,
                            'metaKeywords' =>$request->metaKeywords
                        ]);
                        echo json_encode(['success' => 'Rubrique modifiée avec succes ']);
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

            }
            throw new \Exception('Token mismatch');
        }
        
        return null;
    }

    /**
     * function for activate or desactive this rubric
     * @param $id
     * @return null
     */
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
                        Rubric::where('id', $id)->update([
                            'view' =>$request->view
                        ]);
                        $categories = Category::where('category_id', $id)->get();
                        if(count($categories)){
                            foreach ($categories as $category){
                                $category->update([
                                    'view' =>$request->view
                                ]);
                            }
                        }
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

    /**
     * function for delete this rubric
     * @param $id
     * @return null
     * @throws \Exception
     */
    public function delete($id)
    {
        if(Request::has('post')){
            $request = Request::get('post');
            
            if(CSRFToken::verifyCSRFToken($request->token,false)){
                Rubric::destroy($id);
                
                $categories = Category::where('rubric_id', $id)->get();
                if(count($categories)){
                    foreach ($categories as $category){
                        $category->delete();
                    }
                }
                $subcategories = SubCategory::where('rubric_id', $id)->get();
                if(count($subcategories)){
                    foreach ($subcategories as $subcategory){
                        $subcategory->delete();
                    }
                }
                $products = Product::where('rubric_id', $id)->get();
                if(count($products)){
                    foreach ($products as $product){
                        $product->delete();
                    }
                }
                echo 'success';
                exit;
            }
            //reponse ajax en cas d'erreur
            header('HTTP/1.1 422 Unprocessable Entity', true, 422);
            throw new \Exception('Token mismatch');
        }
        return null;
    }

}