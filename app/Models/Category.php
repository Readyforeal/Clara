<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function team() {
        return $this->belongsTo(Team::class);
    }

    //Pivot
    public function projects() {
        return $this->belongsToMany(Project::class);
    }

    //Pivot
    public function items() {
        return $this->belongsToMany(Item::class);
    }
}
