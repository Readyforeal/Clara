<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function team() {
        return $this->belongsTo(Team::class);
    }

    //Pivot
    public function selections() {
        return $this->belongsToMany(Selection::class);
    }

    //Pivot
    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}
