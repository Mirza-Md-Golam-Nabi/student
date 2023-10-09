<?php

namespace App\Models;

use App\Models\ExamInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsFormat extends Model
{
    use HasFactory;

    protected $fillable = ['exam_info_id', 'number', 'text'];

    public function examInfo(): BelongsTo
    {
        return $this->belongsTo(ExamInfo::class);
    }
}
