<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = QuestionBank::all();
        $html = view("banks.panel")->with(["question" => $question])->render();
        return response()->json(["html" => $html]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required'
        ]);
        $userid = auth()->user()->id;

        $question_bank = new QuestionBank();
        $question_bank->question = $request->question;
        $question_bank->tag = $request->tag;
        $question_bank->options_name = json_encode( $request->all('options') );
        $question_bank->created_by = $userid;
        $question_bank->right_option = ( isset( $_POST['answer'] ) ) ? json_encode( $request->all('answer') ) : null;
        $res = $question_bank->save();
        if( $res ){
            return response()->json([
                'status' => 'success',
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
     * @param  \App\Models\QuestionBank  $questionBank
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionBank $questionBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionBank  $questionBank
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionBank $questionBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionBank  $questionBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required'
        ]);
        $userid = auth()->user()->id;

        $questionBank = QuestionBank::find($id);
        $questionBank->question = $request->question;
        $questionBank->tag = $request->tag;
        $questionBank->options_name = json_encode( $request->all('options') );
        $questionBank->created_by = $userid;
        $questionBank->right_option = ( isset( $_POST['answer'] ) ) ? json_encode( $request->all('answer') ) : null;
        $res = $questionBank->save();
        if( $res ){
            return response()->json([
                'status' => 'success',
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
     * @param  \App\Models\QuestionBank  $questionBank
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionBank = QuestionBank::find($id);
        if( $questionBank->delete() ) {
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
