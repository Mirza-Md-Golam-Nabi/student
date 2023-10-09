<?php

namespace App\Models;

use App\Models\ClassName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cls extends Model
{
    use HasFactory;

    protected $fillable = ['root_id', 'class_name_id', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];

    public function className(): BelongsTo
    {
        return $this->belongsTo(ClassName::class);
    }
}
