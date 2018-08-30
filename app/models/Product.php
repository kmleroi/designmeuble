<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Product extends Model
{
    //use SoftDeletes;
    
    public $timestamps = true;
    protected $fillable = [
        'name','reference', 'price','resume','rubric_id','product_detail_id', 'category_id', 'sub_category_id','PrixHtva','prixTvac',
        'prixPromoHtva','prixPromoTvac','image_path', 'view', 'quantity'
    ];
    protected $dates = ['deleted_at'];
    
    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
    public function productMaterial()
    {
        return $this->belongsTo(productMaterial::class);
    }
    public function productStyle()
    {
        return $this->belongsTo(ProductStyle::class);
    }
    public function productMontage()
    {
        return $this->belongsTo(ProductMontage::class);
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function transform($data)
    {
        $products = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            $update = new Carbon($item->updated_at);

            array_push($products, [
                'id' => $item->id,
                'name' => $item->name,
                'reference' => $item->reference,
                'price' => $item->price,
                'resume' => $item->resume,
                'view' => $item->view,
                'quantity' => $item->quantity,
                'product_detail_id' => $item->product_detail_id,
                'rubric_id' => $item->rubric_id,
                'category_id' => $item->category_id,
                'category_name' => Category::where('id', $item->category_id)->first()->name,
                'sub_category_id' => $item->sub_category_id,
                'sub_category_name' => SubCategory::where('id', $item->sub_category_id)->first()->name,
                'image_path' => $item->image_path,
                'prixHtva'=>$item->prixHtva,
                'prixTvac'=>$item->prixTvac,
                'prixPromoHtva'=>$item->prixPromoHtva,
                'prixPromoTvac'=>$item->prixPromoTvac,
                'added' => $added->toFormattedDateString(),
                'updated' => $update->toFormattedDateString()
            ]);
        }
        
        return $products;
    }
}