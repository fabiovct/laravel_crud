<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class Product extends Model
{
    //
    protected $table = 'products';
    protected $primaryKey  = 'id';


    public $timestamps = false;

    protected $fillable = [
        'name',
        'brand',
        'description',
        'price',
        'stock_quantity',
    ];

    protected $casts = [];

}