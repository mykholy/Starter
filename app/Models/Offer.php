<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $table="offers";
    protected $fillable=['name_ar','name_en','price','photo','details_ar','details_en','created_at','updated_at'];
    protected  $hidden=['created_at'];
    public $timestamps=false;
}
