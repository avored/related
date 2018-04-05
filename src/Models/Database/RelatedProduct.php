<?php
namespace AvoRed\Related\Models\Database;

use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    protected $fillable = ['product_id','related_id'];

}
