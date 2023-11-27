<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatType extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'cat_types';
    protected $guarded = [];

    public function cats(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Cat::class,'fk_cat_type','id');
    }
}
