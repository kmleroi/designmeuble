<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

//the name of the tables must be in plurial forme and the name of the class not
class Brand extends Model
{
    //use SoftDeletes;
    
    public $timestamps = true;
    protected $fillable = ['name', 'imageBrand'];
    //protected $dates = ['deleted_at'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function collections(){
        return $this->hasMany(Collection::class);;
    }
    
    public function transform($data)
    {
        $brands = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            $update = new Carbon($item->updated_at);
            array_push($brands, [
                'id' => $item->id,
                'name' => $item->name,
                'imageBrand' => $item->imageBrand,
                'added' => $added->toFormattedDateString(),
                'updated' => $update->toFormattedDateString()
            ]);
        }

        return $brands;
    }
}