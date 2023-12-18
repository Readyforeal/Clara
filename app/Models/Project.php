<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function teams() {
        return $this->belongsTo(Team::class);
    }

    public function locations() {
        return $this->hasMany(Location::class);
    }

    public function selectionLists() {
        return $this->hasMany(SelectionList::class);
    }

    //Pivot
    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}
