<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResultController extends Controller
{
    public function storeAllResultInit( Request $request ){

        $userid = auth()->user()->id;
        $existResult = Result::where('exam_id', '=', $request->myexam_id)->where('user_id', '=', $userid)->get();
        if( count($existResult) <= 0 ) {
            $result = new Result();
            $result->exam_id = $request->myexam_id;
            $result->user_id = $userid;

            $answerSheet = [];
            foreach ( $request->questions as $ques ) {
                $answerSheet[] = [
                    'ques_id' => $ques['id'],
                    'isRight' => 0,
                    'isAnswer' => 0,
                    'answer' => ''
                ];
            }
            $result->answer_sheet = json_encode( $answerSheet );

            if( $result->save() ){
                return response()->json([
                    'status'   => 'all questions are stored initially.',
                ], Response::HTTP_OK );
            }else{
                return response()->json([
                    'status'   => 'error initialize question.',
                ], Response::HTTP_NOT_IMPLEMENTED );
            }
        }else{
            return response()->json([
                'status'   => 'already all question initially stored.',
            ], Response::HTTP_NOT_IMPLEMENTED );
        }
    }

    public function storeUpdateResult( Request $request ){

        $userid = auth()->user()->id;
        $result = Result::where( 'exam_id' , '=', $request->examId )->where( 'user_id' , '=', $userid )->first();

        if( $result ) {
            if( $request->nextId == -1 ){
                $result->doneExam = 1;
            }
            $answerSheet = [];
            if( isset( $result->answer_sheet ) ) {
                $answerSheet = json_decode($result->answer_sheet);
                foreach ( $answerSheet as $key => $ans ) {
                    if( $ans->ques_id == $request->quesId ) {
                        $answerSheet[$key]->isRight = $request->isRight;
                        $answerSheet[$key]->isAnswer = $request->isAnswer;
                        $answerSheet[$key]->answer = $request->answer;
                    }
                }
            }
            $result->answer_sheet = json_encode( $answerSheet );
            if( $result->save() ){
                return response()->json([
                    'status'   => 'success',
                ], Response::HTTP_OK );
            }else{
                return response()->json([
                    'status'   => 'error',
                ], Response::HTTP_NOT_IMPLEMENTED );
            }
        }else{
            return response()->json([
                'status'   => 'question not found!',
            ], Response::HTTP_NOT_IMPLEMENTED );
        }
    }

    public function questionValidity( $examId, $quesId ) {
        $userid = auth()->user()->id;
        $result = Result::where( 'exam_id' , '=', $examId )->where( 'user_id' , '=', $userid )->first();
        if( $result ) {
            if( $result->doneExam == 1 ){
                return response()->json([
                    'quesId'   => 'end',
                ], Response::HTTP_OK );
            }
            $answer_sheet = json_decode( $result->answer_sheet );
            foreach ( $answer_sheet as $key => $ans ) {

                if( $ans->ques_id == $quesId && $ans->isAnswer == 1 ) {
                    continue;
                }

                if( $ans->ques_id == $quesId && $ans->isAnswer == 0 ) {
                    return response()->json([
                        'quesId'   => 'can',
                    ], Response::HTTP_OK );
                }


                if( $ans->isAnswer == 0 ) {
                    return response()->json([
                        'quesId'   => $ans->ques_id,
                    ], Response::HTTP_OK );
                }
            }

            return response()->json([
                'quesId'   => 'end',
            ], Response::HTTP_OK );
        }else{
            return response()->json([
                'quesId'   => 'store',
            ], Response::HTTP_OK );
        }
    }

    public function makeDoneExam( $examId ) {
        $userid = auth()->user()->id;
        $result = Result::where( 'exam_id' , '=', $examId )->where( 'user_id' , '=', $userid )->first();
        if( $result ) {
            $result->doneExam = 1;
            if( $result->save() ) {
                return response()->json([
                    'quesId'   => 'done exam',
                ], Response::HTTP_OK );
            }
        }
    }

    public function userExam() {
        $userid = auth()->user()->id;
        $result = Result::where( 'user_id' , '=', $userid )->with('exam:id,title')->get();

        return response()->json([
            'exam'   => $result,
        ], Response::HTTP_OK );
    }

    public function userResult( $examId ) {
        $userid = auth()->user()->id;
        $result = Result::where( 'exam_id' , '=', $examId )->where( 'user_id' , '=', $userid )->first();
        $exam = Exam::where('id', '=', $examId)->with('questions')->first();
        return response()->json([
            'result' => $result,
            'examQues'   => $exam,
        ], Response::HTTP_OK );
    }

}
