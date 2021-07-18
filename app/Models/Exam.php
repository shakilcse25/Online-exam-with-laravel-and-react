<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Exam extends Model
{
    use HasFactory;

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'img' => 'Exam image ',
        ];
    }

    /**
     * Get the user that owns the exam.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the user that owns the exam.
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id', 'id')->with('options');
    }

}
