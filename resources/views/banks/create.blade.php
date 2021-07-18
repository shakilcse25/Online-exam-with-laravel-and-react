@extends('layouts.app', ['title' => __('Create Questions')])

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')

    @include('users.partials.header', [
        'title' => __('Create Questions'),
        'description' => __('You can create questions to the questions. Others users can also create an exam using these questions from question bank.'),
        'class' => 'col-lg-10'
    ])


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __( 'Question Bank' ) }}</h3>
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
                                        @method('PUT')
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
                                                    <div class="col-sm-12">
                                                        <div class="wpre-manage-option">
                                                            <span class="wpre-hidden-select-option" id="edit-hidden-select"></span>
                                                            <label for="add-wpre-option" style="margin-bottom: 4px;"><b>Add Option(s) : </b></label>
                                                            <select class="form-control wpre-select" id="edit-select" multiple="multiple"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12" style="margin-top: 20px;">
                                                        <div class="form-group question-tinymce-formgroup">
                                                            <label for="question"> <b> Tags/Type : </b></label>
                                                            <input type="text" class="form-control" id="tags-question-edit" name="tag">

                                                            <div class="alert alert-danger alert-dismissible fade show"  id="alert-tags-question-edit" role="alert">
                                                                <span class="alert-inner--text"> Tags field is required for better search. </span>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-questions">Create Questions
                                </button>
                            </p>

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


                                                        <div class="wpre-manage-option col-sm-12">
                                                            <span class="wpre-hidden-select-option"></span>
                                                            <label for="add-wpre-option" style="margin-bottom: 4px;"><b>Add Option(s) : </b></label>
                                                            <select class="form-control wpre-select" multiple="multiple"></select>
                                                        </div>


                                                        <div class="col-md-12" style="margin-top: 20px;">
                                                            <div class="form-group question-tinymce-formgroup">
                                                                <label for="question"> <b> Tags/Type : </b></label>
                                                                <input type="text" class="form-control" id="tags" name="tag">

                                                                <div class="alert alert-danger alert-dismissible fade show"  id="alert-tags-question" role="alert">
                                                                    <span class="alert-inner--text"> Tags field is required for better search. </span>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
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

        tinymce.init({
            selector: 'textarea#edit-question-tinymce',
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

        //Ajax form Submit

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
                $('#alert-tags-question').hide();
            }else if( $('#tags').val() == '' ){
                $('#alert-tinymce-question').hide();
                $('#alert-tags-question').show();
            }
            else{
                Notiflix.Loading.Dots('Processing...');
                $('#alert-tinymce-question').hide();
                $('#alert-tags-question').hide();
                $.ajax({
                    type:'POST',
                    url:"{{ route('questions-bank.store') }}",
                    data:formData,
                    success:function(res){
                        fetchQuestion();
                        Notiflix.Loading.Remove(600);
                        if( res.status === 'success' ) {
                            $('#add-questions').modal('hide');
                            $(".wpre-select").val([]).change();
                            $('#tags').val('');
                            tinyMCE.get('question').setContent('');
                            Notiflix.Notify.Success('Question added successfully!');
                        }else{
                            Notiflix.Report.Failure('Error','<p>Something wrong, please Try again letter!</p>', 'okay');
                        }
                    },
                    error: function (err) {
                        console.log(err);
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
                $('#alert-tags-question-edit').hide();
            }else if( $('#tags-question-edit').val() == '' ){
                $('#alert-tinymce-question-edit').hide();
                $('#alert-tags-question-edit').show();
            }
            else{
                Notiflix.Loading.Dots('Processing...');
                $('#alert-tinymce-question-edit').hide();
                $('#alert-tags-question-edit').hide();

                let url = "{{ route('questions-bank.update', [ 'questions_bank' => 1 ]) }}";
                let myid = $('#edit-question-id').val();
                url = url.slice(0, -1) + myid;

                $.ajax({
                    type:'POST',
                    url:url,
                    data:formData,
                    success:function(res){
                        fetchQuestion();
                        Notiflix.Loading.Remove(600);
                        if( res.status === 'success' ) {
                            $('#edit-questions').modal('hide');
                            $(".wpre-select").val([]).change();
                            tinyMCE.get('edit-question-tinymce').setContent('');
                            $('#tags-question-edit').val('');
                            Notiflix.Notify.Success('Question and options updated successfully!');
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
                url:"{{ route('questions-bank.index') }}",
                success:function(res){
                    $('.question-group').append( $(res.html) );
                    Notiflix.Block.Remove('.block-this-element');
                }
            });
        }
        fetchQuestion();

        function editQuestion( ques, options , right_options ) {
            console.log(right_options)
            $('#edit-question-id').val(ques.id);
            $('#edit-select').empty();
            $('#edit-hidden-select').empty();
            $('#tags-question-edit').val(ques.tag);
            right_ans = right_options;
            tinyMCE.get('edit-question-tinymce').setContent(ques.question);
            options.forEach( function (opt) {
                $('#edit-select').append($('<option selected="selected" >'+ opt +'</option>'));
                $('#edit-hidden-select').append($('<input type="hidden" value="'+ opt +'" name="options[]'+ opt +'">'));
            });
            $('#edit-questions').modal('show');
        }


        function deleteQuestion( ques ) {
            Notiflix.Confirm.Show( 'Delete Confirmation', 'Do you sure to delete?', 'Yes', 'No', function(){

                var url = "{{ route('questions-bank.destroy',[ 'questions_bank' => 1 ]) }}";
                url = url.slice(0, -1) + ques.id;

                $.ajax({
                    type:'DELETE',
                    url: url,
                    success:function(res){
                        if( res.status == 'success' ) {
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
