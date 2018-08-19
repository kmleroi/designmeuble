<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

//the name of the class must be in plurial forme and the name of the class not
class ProductDetail extends Model
{
    //use SoftDeletes;
    
    public $timestamps = true;
    protected $fillable = ['description', 'assemblage','style','finition','largeur','longeur','hauteur','entretien','poids'];
    //protected $dates = ['deleted_at'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function transform($data)
    {
        $productdetails = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            $update = new Carbon($item->updated_at);
            array_push($productdetails, [
                'id' => $item->id,
                'description' => $item->description,
                'assemblage' => $item->assemblage,
                'style' => $item->style,
                'finition' => $item->finition,
                'largeur' => $item->largeur,
                'longeur' => $item->longeur,
                'hauteur' => $item->hauteur,
                'entretien' => $item->entretien,
                'poids' => $item->poids,
                'added' => $added->toFormattedDateString(),
                'updated' => $update->toFormattedDateString()
            ]);
        }

        return $productdetails;
    }
}