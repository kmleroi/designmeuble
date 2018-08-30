<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

//the name of the class must be in plurial forme and the name of the class not
class Slider extends Model
{
    //use SoftDeletes;
    
    public $timestamps = true;
    protected $fillable = ['image', 'title','subTitle','description','link'];
    //protected $dates = ['deleted_at'];

    public function transform($data)
    {
        $sliders = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            $update = new Carbon($item->updated_at);
            array_push($categories, [
                'id' => $item->id,
                'image' => $item->image,
                'title' => $item->title,
                'subTitle' => $item->subTitle,
                'description' => $item->description,
                'link' => $item->link,
                'added' => $added->toFormattedDateString(),
                'updated' => $update->toFormattedDateString()
            ]);
        }

        return $sliders;
    }
}