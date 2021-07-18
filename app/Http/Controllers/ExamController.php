<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( auth()->user()->user_role->role->name == 'admin' ){
            $exam = Exam::orderBy('id', 'DESC')->get();
        }else{
            $exam = Exam::where('created_by','=', auth()->user()->id)->orderBy('id', 'DESC')->get();
        }

        return view('exam.index')->with( compact('exam') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'defaultMarks' => 'required',
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.required' => 'Title field can not be blank value.',
                'defaultMarks.required' => 'Default Marks field can not be blank value.',
                'img.image' => 'You can upload only jpeg,png,jpg,gif,svg file.',
                'img.mimes' => 'You can upload only jpeg,png,jpg,gif,svg file.',
                'img.max' => 'File size is must be less than 2mb.'
            ]
        );

        $imageName = '';
        if( isset( $request->img ) ) {
            $imageName = time().substr( sha1( $request->img->getClientOriginalName() ), 0, 5 ).'.'.$request->img->extension();
            $request->img->move(public_path('uploads/exam/'), $imageName);
        }

        $exam = new Exam();
        $exam->title       = $request->title;
        $exam->img         = ! empty( $imageName ) ? $imageName : null;
        $exam->startTime   = ( isset($request->startTime) && $request->startTime != null) ? date('Y-m-d H:i:s', strtotime( $request->startTime ) ) : null;
        $exam->endTime     = ( isset($request->endTime) && $request->endTime != null) ? date('Y-m-d H:i:s', strtotime( $request->endTime ) ) : null;

        $exam->isFullDuration = $request->isFullDuration;

        $exam->fullDuration     = ( isset($request->fullDuration) ) ? $request->fullDuration : null;
        $exam->perDuration     = ( isset($request->perDuration) ) ? $request->perDuration : null;

        $exam->defaultMarks       = $request->defaultMarks;
        $exam->description = $request->description;
        $exam->maxExaminee = $request->maxExaminee;
        $exam->negative = $request->negative;
        $exam->created_by  = auth()->user()->id;

        if( $exam->save() ) {
            $status = 'success';
        }else{
            $status = 'error';
        }

        return redirect()->route('exam.create')->with('status', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required',
                'defaultMarks' => 'required',
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.required' => 'Title field can not be blank value.',
                'defaultMarks.required' => 'Default Marks field can not be blank value.',
                'img.image' => 'You can upload only jpeg,png,jpg,gif,svg file.',
                'img.mimes' => 'You can upload only jpeg,png,jpg,gif,svg file.',
                'img.max' => 'File size is must be less than 2mb.'
            ]
        );

        $imageName = '';
        if( isset( $request->img ) ) {
            $imageName = time().substr( sha1( $request->img->getClientOriginalName() ), 0, 5 ).'.'.$request->img->extension();
            $request->img->move(public_path('uploads/exam/'), $imageName);
        }

        $exam = Exam::find($id);
        $exam->title       = $request->title;
        if( ! empty( $imageName ) ){
            $exam->img =  $imageName;
        }
        $exam->startTime   = ( isset($request->startTime) && $request->startTime != null) ? date('Y-m-d H:i:s', strtotime( $request->startTime ) ) : null;
        $exam->endTime     = ( isset($request->endTime) && $request->endTime != null) ? date('Y-m-d H:i:s', strtotime( $request->endTime ) ) : null;

        $exam->isFullDuration = $request->isFullDuration;

        $exam->fullDuration     = ( isset($request->fullDuration) ) ? $request->fullDuration : null;
        $exam->perDuration     = ( isset($request->perDuration) ) ? $request->perDuration : null;

        $exam->defaultMarks = $request->defaultMarks;
        $exam->description = $request->description;
        $exam->maxExaminee = $request->maxExaminee;
        $exam->negative = $request->negative;
        $exam->created_by  = auth()->user()->id;

        if( $exam->save() ) {
            $status = 'success';
        }else{
            $status = 'error';
        }

        return redirect()->route('exam.index')->with('status', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
