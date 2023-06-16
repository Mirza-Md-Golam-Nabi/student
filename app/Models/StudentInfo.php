<?php

namespace App\Models;

use App\Models\ClassName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['root_id', 'name', 'phone', 'class_id', 'father_name', 'mother_name', 'school_name', 'guardian_phone', 'status'];

    public function className(): BelongsTo
    {
        return $this->belongsTo(ClassName::class, 'class_id', 'id');
    }

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }
}
