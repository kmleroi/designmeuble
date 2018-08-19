<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

//the name of the class must be in plurial forme and the name of the class not
class Category extends Model
{
    //use SoftDeletes;
    
    public $timestamps = true;
    protected $fillable = ['name', 'slug','rubric_id','description','imageCat','position','title','metaDescription','metaKeywords','view'];
    //protected $dates = ['deleted_at'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }
    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }
    public function transform($data)
    {
        $categories = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            $update = new Carbon($item->updated_at);
            array_push($categories, [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'rubric_id' => $item->rubric_id,
                'imageCat' => $item->imageCat,
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

        return $categories;
    }
}