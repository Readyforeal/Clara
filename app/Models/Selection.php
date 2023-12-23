<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function selectionList() {
        return $this->belongsTo(SelectionList::class);
    }

    //Pivot
    public function items() {
        return $this->belongsToMany(Item::class)->withPivot('selected');
    }

    //Pivot
    public function locations() {
        return $this->belongsToMany(Location::class);
    }

    //Polymorphic approvals
    public function approvals() {
        return $this->morphMany(Approval::class, 'approvable');
    }
}
