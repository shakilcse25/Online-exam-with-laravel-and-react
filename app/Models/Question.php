<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * Get all the options for the question.
     */
    public function options()
    {
        return $this->hasOne(QuestionOption::class, 'question_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'id', 'exam_id');
    }
}
