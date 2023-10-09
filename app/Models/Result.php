<?php

namespace App\Models;

use App\Models\ExamInfo;
use App\Models\StudentInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'root_id', 'exam_info_id', 'student_id', 'get_marks', 'updated_by',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(StudentInfo::class);
    }

    public function examInfo(): BelongsTo
    {
        return $this->belongsTo(ExamInfo::class);
    }
}
