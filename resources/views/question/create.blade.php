@extends('layouts.app', ['title' => __('Create Exams Questions')])

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')

    @include('users.partials.header', [
        'title' => __('Create Exams Questions'),
        'description' => __('Create all question that belongs to this exam. Also you need to add options as much you want for every single question and you need mark the correct options for a particular question.'),
        'class' => 'col-lg-10'
    ])


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __( $exam->title ) }}</h3>
                        </div>
                    </div>
                    <div class="card-body add-question-card">

                        <div class="list-question block-this-element">
                            <div class="row">
                                <div class="col-md-12 question-group">

                                        {{--ajax return dom append here--}}

                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="edit-questions" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                <div class="modal-content">

                                    <form id="question-form-edit" method="post" >
                                        @csrf
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="modal-title-default">Create Question and it's option</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="question-tinymce">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <input type="hidden" id="edit-question-id" name="questionId">
                                                        <div class="form-group question-tinymce-formgroup">
                                                            <label for="question"> <b> Question : </b></label>
                                                            <textarea class="form-control tinymce-edit-question" value="{{ old('question') }}" id="edit-question-tinymce" name="question"></textarea>

                                                            <div class="alert alert-danger alert-dismissible fade show"  id="alert-tinymce-question-edit" role="alert">
                                                                <span class="alert-inner--text"> Question field is required. </span>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12" style="margin-top: 14px;">
                                                        <div class="form-group question-tinymce-formgroup">
                                                            <label for="question"> <b> Marks : </b></label>
                                                            <input type="number" step="0.25" class="form-control" value="{{ $exam->defaultMarks  }}" id="marks-edit" name="marks">

                                                            <div class="alert alert-danger alert-dismissible fade show"  id="marks-question-edit" role="alert">
                                                                <span class="alert-inner--text"> Marks field is required. </span>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                            <div class="wpre-manage-option">
                                                <span class="wpre-hidden-select-option" id="edit-hidden-select"></span>
                                                <label for="add-wpre-option" style="margin-bottom: 4px;"><b>Add Option(s) : </b></label>
                                                <select class="form-control wpre-select" id="edit-select" multiple="multiple"></select>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button id="question-submit-edit" type="button" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="add-question">
                            <p class="text-right mt-5">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#questions-bank">Add Question From Question Bank
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-questions">Create Questions
                                </button>
                            </p>

                            {{--add question modal start--}}
                            <div class="modal fade" id="add-questions" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">

                                        <form id="question-form">
                                            @csrf
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="modal-title-default">Create Question and it's option</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="question-tinymce">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group question-tinymce-formgroup">
                                                                <label for="question"> <b> Question : </b></label>
                                                                <textarea class="form-control tinymce-editor-question" value="{{ old('question') }}" id="question" name="question"></textarea>

                                                                <div class="alert alert-danger alert-dismissible fade show"  id="alert-tinymce-question" role="alert">
                                                                    <span class="alert-inner--text"> Question field is required. </span>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12" style="margin-top: 14px;">
                                                            <div class="form-group question-tinymce-formgroup">
                                                                <label for="question"> <b> Marks : </b></label>
                                                                <input type="number" step="0.25" class="form-control" value="{{ $exam->defaultMarks  }}" id="marks" name="marks">

                                                                <div class="alert alert-danger alert-dismissible fade show"  id="marks-question" role="alert">
                                                                    <span class="alert-inner--text"> Marks field is required. </span>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="wpre-manage-option">
                                                    <span class="wpre-hidden-select-option" id="add-hidden-select"></span>
                                                    <label for="add-wpre-option" style="margin-bottom: 4px;"><b>Add Option(s) : </b></label>
                                                    <select class="form-control wpre-select" id="add-select" multiple="multiple"></select>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button id="question-submit" type="button" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{--Add question modal end--}}


                            {{--Question bank modal start--}}

                            <div class="modal fade" id="questions-bank" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Question Bank</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 questions-bank">

                                                    @include('question.questions-bank')

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--Question bank modal end--}}


                        </div>


                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection


@push('js')
    <script type="text/javascript" src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/notiflix/notiflix-aio.js') }}"></script>
    <script src="{{ asset('assets/js/tinymce.min.js') }}"></script>

    <script>
        var right_ans = [];

        // Tinymce init add content
        tinymce.init({
            selector: 'textarea.tinymce-editor-question',
            height: 230,
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
            content_css: 'https://www.tiny.cloud/css/codepen.min.css'
        });

        // Tinimce edit content
        tinymce.init({
            selector: '#edit-question-tinymce',
            height: 230,
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
            content_css: 'https://www.tiny.cloud/css/codepen.min.css'
        });

        // select2 customization
        $(".wpre-select").select2({
            tags: true,
            minimumResultsForSearch: -1,
            templateSelection: function(selection) {
                if(selection.selected) {
                    var checked = ( right_ans.indexOf(selection.id) != -1 ) ? "checked" : "";
                    return $.parseHTML('<label for="'+ selection.id +'" class="option-text">' + selection.text + '</label><input class="option-checkbox" data-check="'+ selection.id +'" type="checkbox" value="'+ selection.id +'" id="'+ selection.id +'" name="answer[]'+ selection.id +'" ' + checked + '  >');
                }
                else {
                    return $.parseHTML('<label for="'+ selection.id +'" class="option-text">' + selection.text + '</label><input class="option-checkbox" data-check="'+ selection.id +'" type="checkbox" value="'+ selection.id +'" id="'+ selection.id +'" name="answer[]'+ selection.id +'">');
                }
            }
        });

        // On change select2
        $(document).on('change','.wpre-select',function () {
            var updated_option = '';
            $(this).next().find('ul li').each(function(index, element){
                var new_option = $(element).attr('title');
                if(new_option !== '' && typeof new_option !== 'undefined' && new_option !== null ){
                    updated_option += '<input type="hidden" value="' + new_option + '" name="options[]'+ new_option +'" >';
                }
            });
            $(this).parent().children('.wpre-hidden-select-option').html($(updated_option));
        });

        //Ajax form Submit for add question
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#question-submit").click(function(e){
            e.preventDefault();

            var formData = $('#question-form').serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            formData.question = tinyMCE.get('question').getContent();


            if( formData.question.length == '' ){
                $('#alert-tinymce-question').show();
                $('#marks-question').hide();
            }else if( $('#marks').val() == '' ){
                $('#alert-tinymce-question').hide();
                $('#marks-question').show();
            }
            else{
                Notiflix.Loading.Dots('Processing...');
                $('#alert-tinymce-question').hide();
                $('#marks-question').hide();
                $.ajax({
                    type:'POST',
                    url:"{{ route('question.store',[ 'exam_id' => $exam->id ]) }}",
                    data:formData,
                    success:function(res){
                        fetchQuestion();
                        Notiflix.Loading.Remove(600);
                        if( res.status === 'success-all' ) {
                            $('#add-questions').modal('hide');
                            $(".wpre-select").val([]).change();
                            tinyMCE.get('question').setContent('');
                            Notiflix.Notify.Success('Question and options added successfully!');
                        }else if( res.status === 'success-question' ) {
                            $('#add-questions').modal('hide');
                            $(".wpre-select").val([]).change();
                            tinyMCE.get('question').setContent('');
                            Notiflix.Report.Warning('Warning','<p>Question added successfully but options not added!</p>', 'okay');
                        }else{
                            Notiflix.Report.Failure('Error','<p>Something wrong, please Try again letter!</p>', 'okay');
                        }
                    },
                    error: function (err) {
                        Notiflix.Loading.Remove(600);
                        Notiflix.Report.Failure('Error','<p>Something wrong, please Try again letter!</p>', 'okay');
                    }
                });
            }
        });

        // Edit Question and options
        $("#question-submit-edit").click(function(e){
            e.preventDefault();

            var formData = $('#question-form-edit').serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            formData.question = tinyMCE.get('edit-question-tinymce').getContent();


            if( formData.question.length == '' ){
                $('#alert-tinymce-question-edit').show();
                $('#marks-question-edit').hide();
            }else if( $('#marks-edit').val() == '' ){
                $('#alert-tinymce-question-edit').hide();
                $('#marks-question-edit').show();
            }
            else{
                Notiflix.Loading.Dots('Processing...');
                $('#alert-tinymce-question-edit').hide();
                $('#marks-question-edit').hide();

                let url = "{{ route('question.update') }}";

                $.ajax({
                    type:'POST',
                    url:url,
                    data:formData,
                    success:function(res){
                        fetchQuestion();
                        Notiflix.Loading.Remove(600);
                        if( res.status === 'success-all' ) {
                            $('#edit-questions').modal('hide');
                            $(".wpre-select").val([]).change();
                            tinyMCE.get('question').setContent('');
                            Notiflix.Notify.Success('Question and options updated successfully!');
                        }else if( res.status === 'success-question' ) {
                            $('#add-questions').modal('hide');
                            $(".wpre-select").val([]).change();
                            tinyMCE.get('edit-question-tinymce').setContent('');
                            Notiflix.Report.Warning('Warning','<p>Question updated successfully but options not updated!</p>', 'okay');
                        }else{
                            Notiflix.Report.Failure('Error','<p>Something wrong, please Try again letter!</p>', 'okay');
                        }
                    },
                    error: function (err) {
                        Notiflix.Loading.Remove(600);
                        Notiflix.Report.Failure('Error','<p>Something wrong, please Try again letter!</p>', 'okay');
                    }
                });
            }
        });



        // Question Accrodin
        $('a.page-scroll').on('click', function(e){
            var anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $(anchor.attr('href')).offset().top - 50
            }, 1500);
            e.preventDefault();
        });

        // Ajax fetch Question and Options
        function fetchQuestion() {
            Notiflix.Block.Standard('.block-this-element', 'Loading...');
            $('.question-group').empty();
            $.ajax({
                type:'GET',
                url:"{{ route('question.index',[ 'exam_id' => $exam->id ]) }}",
                success:function(res){
                    $('.question-group').append( $(res.html) );
                    Notiflix.Block.Remove('.block-this-element');
                }
            });
        }
        fetchQuestion();


        function editQuestion( ques, options , right_options ) {
            $('#edit-question-id').val(ques.id);
            $('#edit-select').empty();
            $('#edit-hidden-select').empty();
            right_ans = right_options;
            tinyMCE.get('edit-question-tinymce').setContent(ques.question);
            options.forEach( function (opt) {
                $('#edit-select').append($('<option selected="selected" >'+ opt +'</option>'));
                $('#edit-hidden-select').append($('<input type="hidden" value="'+ opt +'" name="options[]'+ opt +'">'));
            });
            $('#edit-questions').modal('show');
        }

        function pressQuestionBank( ques, all_options, right_options ) {
            $('#questions-bank').modal('hide');
            $('#add-select').empty();
            $('#add-hidden-select').empty();
            right_ans = right_options;
            tinyMCE.get('question').setContent(ques.question);
            all_options.forEach( function (opt) {
                $('#add-select').append($('<option selected="selected" >'+ opt +'</option>'));
                $('#add-hidden-select').append($('<input type="hidden" value="'+ opt +'" name="options[]'+ opt +'">'));

            });
            $('#add-questions').modal('show');
        }

        function deleteQuestion( ques ) {
            Notiflix.Confirm.Show( 'Delete Confirmation', 'Do you sure to delete?', 'Yes', 'No', function(){

                var url = "{{ route('question.destroy',[ 'id' => $exam->id ]) }}";
                url = url.slice(0, -1) + ques.id;

                $.ajax({
                    type:'GET',
                    url: url,
                    success:function(res){
                        if( res.status === 'success' ) {
                            fetchQuestion();
                            Notiflix.Notify.Success('Question deleted successfully!');
                        }else{
                            Notiflix.Report.Failure('Error','<p> Something wrong, please Try again letter ! </p>', 'okay');
                        }
                    }
                });

            }, function(){ } );
        }

    </script>
@endpush
