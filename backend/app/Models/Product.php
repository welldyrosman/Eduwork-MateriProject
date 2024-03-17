<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $fillable = [
    //     'nama_rpduct',
    //     'email',
    //     'password',
    // ];
    public function producttags(){
        return $this->hasMany(ProductTag::class)->with('tag');
    }
}
