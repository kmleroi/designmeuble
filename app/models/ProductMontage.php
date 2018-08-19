<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

//the name of the tables must be in plurial forme and the name of the class not
class ProductMontage extends Model
{

    public $timestamps = true;
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    

    public function transform($data)
    {
        $montages = [];
        foreach ($data as $item){
            array_push($montages, [
                'id' => $item->id,
                'name' => $item->name
            ]);
        }

        return $montages;
    }
}