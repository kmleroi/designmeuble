<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

//the name of the tables must be in plurial forme and the name of the class not
class Collection extends Model
{
    //use SoftDeletes;
    
    public $timestamps = true;
    protected $fillable = ['name', 'brand_id','imageColl','view'];
    //protected $dates = ['deleted_at'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    
    public function transform($data)
    {
        $collections = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            $update = new Carbon($item->updated_at);
            array_push($collections, [
                'id' => $item->id,
                'name' => $item->name,
                'imageColl' => $item->imageColl,
                'view' => $item->view,
                'added' => $added->toFormattedDateString(),
                'updated' => $update->toFormattedDateString()
            ]);
        }

        return $collections;
    }
}