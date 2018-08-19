<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class SubCategory extends Model
{
    //use SoftDeletes;
    
    public $timestamps = true;
    protected $fillable = ['name', 'slug','rubric_id', 'category_id','description','imageSousCat','position','title','metaDescription','metaKeywords','view'];
    protected $dates = ['deleted_at'];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }
    
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    
    public function transform($data)
    {
        $subcategories = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            $update = new Carbon($item->updated_at);

            array_push($subcategories, [
                'id' => $item->id,
                'category_id' => $item->category_id,
                'rubric_id' => $item->rubric_id,
                'name' => $item->name,
                'slug' => $item->slug,
                'imageSousCat' => $item->imageSousCat,
                'description' => $item->description,
                'position' => $item->position,
                'title' => $item->title,
                'metaDescription' => $item->metaDescription,
                'metaKeywords' => $item->metaKeywords,
                'view' => $item->view,
                'added' => $added->toFormattedDateString(),
                'updated' => $update->toFormattedDateString()
            ]);
        }
        
        return $subcategories;
    }
}