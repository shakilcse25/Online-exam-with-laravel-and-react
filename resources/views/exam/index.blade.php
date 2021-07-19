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

                        <div class="table-responsive py-4">
                            <table class="table table-flush" id="datatable-buttons-exam">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Full Duration</th>
                                        <th>Question Duration</th>
                                        <th>Negative</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Full Duration</th>
                                        <th>Question Duration</th>
                                        <th>Negative</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @foreach( $exam as $item )
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td> {{ $item->fullDuration }} </td>
                                        <td> {{ $item->perDuration }} </td>
                                        <td> {{ $item->negative }} </td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('question.create', [ 'exam_id' => $item->id ]) }}" >Manage questions</a>
                                            <a class="btn btn-info" href="{{ route('exam.edit', [ 'exam' => $item->id ]) }}"  >Edit</a>
                                            <a class="btn btn-danger" href="" onclick="window.alert('I will implement it soon.')" >Delete</a>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>

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
