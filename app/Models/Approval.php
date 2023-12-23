<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function approvable() {
        return $this->morphTo();
    }

    public function approvalStage() {
        return $this->belongsTo(ApprovalStage::class);
    }
}
