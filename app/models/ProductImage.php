<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


//the name of the class must be in plurial forme and the name of the class not
class ProductImage extends Model
{
    public $timestamps = true;

    protected $fillable = ['name', 'position', 'product_id'];
    //protected $dates = ['deleted_at'];
    
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    
    public function transform($data)
    {
        $productImages = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            $update = new Carbon($item->updated_at);
            array_push($productImages, [
                'id' => $item->id,
                'name' => $item->name,
                'position' => $item->position,
                'product_id' => $item->prodcut_id,
                'added' => $added->toFormattedDateString(),
                'updated' => $update->toFormattedDateString()
            ]);
        }

        return $productImages;
    }
}