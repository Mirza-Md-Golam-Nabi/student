<?php

namespace App\Models;

use App\Models\ClassName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cls extends Model
{
    use HasFactory;

    protected $fillable = ['root_id', 'class_name_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function className()
    {
        return $this->belongsTo(ClassName::class);
    }
}
