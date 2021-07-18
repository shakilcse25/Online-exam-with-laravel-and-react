<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExamController extends Controller
{
    public function index() {
        $exam = Exam::where('status','=',1)->get(['title','id']);
        return response()->json([
            'data' => $exam,
        ], Response::HTTP_OK );
    }

    public function findExam( $id ) {
        $exam = Exam::find($id);
        $first_question = ($exam) ? $exam->questions->first() : '';
        return response()->json([
            'data' => $exam,
            'firstQues' => $first_question
        ], Response::HTTP_OK );
    }

    public function findExamDetails( $id ) {
        $exam = Exam::where('id', '=', $id)->with('questions')->first();
        return response()->json([
            'exam' => $exam
        ], Response::HTTP_OK );
    }
}
