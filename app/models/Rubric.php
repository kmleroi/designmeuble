<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

//the name of the class must be in plurial forme and the name of the class not
class Rubric extends Model
{
    //use SoftDeletes;
    
    public $timestamps = true;
    protected $fillable = ['name', 'slug','position','title','metaDescription','metaKeywords','view'];
    //protected $dates = ['deleted_at'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    
    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }
    
    public function transform($data)
    {
        $rubrics = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            $update = new Carbon($item->updated_at);
            array_push($rubrics, [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'position' => $item->position,
                'title' => $item->title,
                'metaDescription' => $item->metaDescription,
                'metaKeywords' => $item->metaKeywords,
                'view' => $item->view,
                'added' => $added->toFormattedDateString(),
                'updated' => $update->toFormattedDateString()
            ]);
        }

        return $rubrics;
    }
}