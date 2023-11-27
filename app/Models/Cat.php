<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cat extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'cats';
    protected $guarded = [];

    public function scopeGuest($query)
    {
        return $query->where('fk_user', Auth::id());
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(User::class,'fk_user','id');
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(CatType::class,'fk_cat_type','id');
    }
}
