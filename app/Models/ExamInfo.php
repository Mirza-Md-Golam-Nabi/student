<?php

namespace App\Models;

use App\Models\ClassName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'root_id', 'name', 'subject_id', 'class_id', 'total_marks', 'topic', 'exam_date', 'status', 'updated_by',
    ];

    public function className(): BelongsTo
    {
        return $this->belongsTo(ClassName::class, 'class_id', 'id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function smsFormat(): HasOne
    {
        return $this->hasOne(SmsFormat::class);
    }
}
