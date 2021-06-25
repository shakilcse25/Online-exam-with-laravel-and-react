@extends('layouts.app', ['title' => __('Add Exam')])

@section('content')

    @include('users.partials.header', [
        'title' => __('Add Exam'),
        'description' => __('This is add exam page. You need add exam with exam details. After adding exam, then you can set exam question in this exam.'),
        'class' => 'col-lg-7'
    ])


<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Add Exam') }}</h3>
                    </div>
                </div>
                <div class="card-body add-product-card">

                    @if (session('status') === 'success')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--text"> Exam added successfully! Please go to set question page to manage questions. </span>
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

                    <form class="product-form" action="{{ route('exam.store') }}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="title"> <b> Exam Title : </b></label>
                                <input type="text" value="{{ old('title') }}" name="title" class="form-control form-control-alternative" id="title" placeholder="Title">
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
                                    <label for="startTime"> <b>Exam Start Time : </b></label>
                                    <div class="input-group input-group-alternative mb-4">
                                        <input class="form-control" value="{{ old('startTime') }}" placeholder="Start Time" name="startTime" data-field="datetime" type="text" readonly >
                                        <div id="end"></div>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="endTime"> <b>Exam End Time : </b></label>
                                    <div class="input-group input-group-alternative mb-4">
                                        <input class="form-control" value="{{ old('endTime') }}" placeholder="End Time" data-field="datetime" name="endTime" type="text" readonly >
                                        <div id="start"></div>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="marks"> <b> Marks( Per Question ) : </b></label>
                                    <input type="number" value="{{ old('marks') }}" step="0.25" name="marks" class="form-control form-control-alternative" id="marks" placeholder="Marks( Per Question )">
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
                                    <label for="maxExaminee"> <b> Max Examinee : </b></label>
                                    <input type="number" value="{{ old('maxExaminee') }}" name="maxExaminee" class="form-control form-control-alternative" id="maxExaminee" placeholder="Max Examinee :">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description"> <b> Exam Description : </b></label>
                                    <textarea class="form-control tinymce-editor" value="{{ old('description') }}" id="description" name="description" placeholder="Description"></textarea>
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
    <script src="{{ asset('assets/js/DateTimePicker.js') }}"></script>
    <script src="{{ asset('assets/js/tinymce.min.js') }}"></script>
    <script>
        $("#start").DateTimePicker();
        $("#end").DateTimePicker();

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
