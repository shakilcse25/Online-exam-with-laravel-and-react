<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionBank;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $exam_id )
    {
        $question = Question::where( 'exam_id', '=', $exam_id )->get();
        $html = view("question.panel")->with(["question" => $question])->render();
        return response()->json(["html" => $html]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $exam = Exam::find( $request->route('exam_id') );
        if( ! $exam ) {
            return redirect()->route('exam.index');
        }

        if( (auth()->user()->isAdmin != 1) && auth()->user()->id != $exam->created_by  ) {
            return redirect()->route('home');
        }

        $question = QuestionBank::all();

        return view('question.create')->with(compact('exam','question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $exam_id)
    {
        $request->validate([
            'question' => 'required'
        ]);

        $question = new Question();
        $question->question = $request->question;
        $question->exam_id = $exam_id;
        $question->marks = $request->marks;
        $res = $question->save();
        if( isset( $_POST['options'] ) && count($_POST['options']) > 0 ) {
            $options = new QuestionOption();
            $options->question_id = $question->id;
            $options->options_name = json_encode( $request->all('options') );
            $options->right_option = ( isset( $_POST['answer'] ) ) ? json_encode( $request->all('answer') ) : null;
            if( $options->save() ){
                return response()->json([
                    'status' => 'success-all',
                ], Response::HTTP_OK );
            }else{
                return response()->json([
                    'status' => 'success-question',
                ], Response::HTTP_OK );
            }
        }else if( $res ){
            return response()->json([
                'status' => 'success-question',
            ], Response::HTTP_OK );
        }else{
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_NOT_IMPLEMENTED );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'question' => 'required'
        ]);

        $question = Question::find($request->questionId);
        $question->question = $request->question;
        $question->marks = $request->marks;
        $res = $question->save();
        if( isset( $_POST['options'] ) && count($_POST['options']) > 0 ) {
            $options = QuestionOption::where('question_id', '=', $question->id)->first();
            $options->question_id  = $question->id;
            $options->options_name = json_encode( $request->all('options') );
            $options->right_option = ( isset( $_POST['answer'] ) ) ? json_encode( $request->all('answer') ) : null;
            if( $options->save() ){
                return response()->json([
                    'status' => 'success-all',
                ], Response::HTTP_OK );
            }else{
                return response()->json([
                    'status' => 'success-question',
                ], Response::HTTP_OK );
            }
        }else if( $res ){
            return response()->json([
                'status' => 'success-question',
            ], Response::HTTP_OK );
        }else{
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_NOT_IMPLEMENTED );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $question = Question::find($id);
        if( $question->delete() ) {
            return response()->json([
                'status' => 'success',
            ], Response::HTTP_OK );
        }else{
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_NOT_IMPLEMENTED );
        }
    }
}
