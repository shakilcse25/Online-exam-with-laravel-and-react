@extends('layouts.app', ['title' => __('View Exams')])

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <style>
        #examDur{
            padding: 7px;
            display: flex;
            align-items: center;
        }
        #examDur span{
            margin-right: 16px;
        }
        .html-duration-picker-wrapper{
            width: 100% !important;
            padding: 10px !important;
        }
        .controlsDivStyle{
            left: unset !important;
            right: 26px !important;
            top: 8px !important;
        }
        .html-duration-picker-wrapper input{
            box-shadow: 0 1px 3px rgb(50 50 93 / 15%), 0 1px 0 rgb(0 0 0 / 2%);
            border: none;
        }
        #per-dur-container{
            display: none;
        }
    </style>
@endpush

@section('content')

    @include('users.partials.header', [
        'title' => __('View Exams'),
        'description' => __('This is the view exams page. you can manage and control your created exam information.'),
        'class' => 'col-lg-10'
    ])


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="my-alert mb-4 mt-4">
                @if (session('status') === 'success')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--text"> Exam updated successfully! </span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('status') === 'error')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--text"> Something error, Try again later! </span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('View Exams') }}</h3>
                        </div>
                    </div>
                    <div class="card-body add-product-card">

                        <form class="product-form" action="{{ route('exam.update', ['exam' => $item->id]) }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title"> <b> Exam Title : </b></label>
                                        <input type="text" value="{{ $item->title }}" name="title" class="form-control form-control-alternative" id="title" placeholder="Title">
                                        @error('title')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <span class="alert-inner--text"> {{ $message }} </span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @enderror
                                    </div>



                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="img"><b> Exam Image : </b></label>
                                        <div class="custom-file" style="position: relative;">
                                            <label class="custom-file-label" for="img"></label>
                                            <input type="file" name="img" class="custom-file-input" id="img" lang="en" autocomplete="off">
                                        </div>
                                        @error('img')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <span class="alert-inner--text"> {{ $message }} </span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="startTime"> <b>Full Exam Duration : </b></label>
                                        <div class="input-group input-group-alternative mb-4" id="examDur">
                                            <span><input name="isFullDuration" type="radio" id="yes" value="1" checked ><label for="yes">Yes</label></span>
                                            <span><input name="isFullDuration" type="radio" id="no" value="0" ><label for="no">No</label></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="full-dur-container">
                                    <div class="form-group">
                                        <label for="endTime"> <b>Full Exam Duration( H:m:s ) : </b></label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <input name="fullDuration" id="fullDuration" value="{{ $item->fullDuration }}" class="html-duration-picker" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="per-dur-container">
                                    <div class="form-group">
                                        <label for="endTime"> <b>Per Question Duration ( H:m:s ) : </b></label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <input id="perDuration" value="{{ $item->perDuration }}" class="html-duration-picker" >
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marks"> <b>Default Marks( Per Question ) : </b></label>
                                        <input type="number" value="{{ $item->defaultMarks }}" step="0.25" name="defaultMarks" class="form-control form-control-alternative" id="defaultMarks" placeholder="Marks( Per Question )">
                                        @error('marks')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <span class="alert-inner--text">{{ $message }} </span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="negative"> <b> Negative Marks : </b> </label>

                                        <div class="input-group mb-3">
                                            <input type="number" step="1" id="negative" name="negative" value="{{ $item->negative }}" min="0" max="100" class="form-control form-control-alternative" aria-label="">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <span style="font-size: 0.8em;margin-top: 3px;" >( Ex : If you give 50, then 50% marks will be reduce for every wrong answer. By default, 0% is set that means no negative marks applied. ) </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description"> <b> Exam Description : </b></label>
                                        <textarea class="form-control tinymce-editor" id="description" name="description" placeholder="Description">{{ $item->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <p class="mt-3 text-right"> <input type="submit" class="btn btn-primary" value="Submit" /> </p>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection


@push('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="{{ asset('assets/js/html-duration-picker.min.js') }}"></script>
    <script src="{{ asset('assets/js/tinymce.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#datatable-buttons-exam').DataTable(
                {
                    "order": []
                }
            );
        } );


        $("#yes").click(function(){
            $('#per-dur-container').hide();
            $('#full-dur-container').show();
            $('#perDuration').removeAttr('name');
            $('#fullDuration').attr('name','fullDuration');
        });
        $("#no").click(function(){
            $('#full-dur-container').hide();
            $('#per-dur-container').show();
            $('#fullDuration').removeAttr('name');
            $('#perDuration').attr('name','perDuration');
        });

        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });

    </script>
@endpush
