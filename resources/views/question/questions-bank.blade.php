@if( count($question) > 0 )
    <div class="panel-group notiflix-block-element" id="accordion" role="tablist" aria-multiselectable="true">
        @foreach( $question as $ques )
            @php
                //$show          = ( $loop->last ) ? 'show' : '';
                $collapse_id   = 'questionCollapse'.$ques->id;
                //$aria_expanded = ( $loop->last ) ? true : false;
                $heading       = 'questionHeading'.$ques->id;
                //$collapsed     = ( $loop->last ) ? '' : 'collapsed';
            @endphp

            @php
                $all_options   = ( $ques->options_name ) ? json_decode($ques->options_name)->options : [];
                $right_options = ( $ques->right_option != null ) ? json_decode($ques->right_option)->answer : [];
            @endphp

            <div class="panel panel-default single-question">
                <div class="panel-heading" role="tab" id="{{ $heading }}">
                    <h4 class="panel-title myPanel" style="position: relative;">
                        <a role="button" data-toggle="collapse" style="display: flex;width: 90%;flex-wrap: wrap;" data-parent="#accordion" href="#{{ $collapse_id }}" aria-expanded="false" aria-controls="{{ $collapse_id }}" class="collapsed">
                            <b style="margin-right: 10px;">{{ $loop->iteration }}. </b>{!!html_entity_decode($ques->question)!!}
                        </a>
                        <button style="position: absolute;right: 50px;top: 16px;" onclick=" pressQuestionBank( {{ json_encode( $ques ) }} , {{json_encode( $all_options ) }}, {{ json_encode( $right_options ) }}) " type="button" class="btn btn-danger btn-sm">Select</button>
                    </h4>
                </div>
                <div id="{{ $collapse_id }}" class="panel-collapse in collapse " role="tabpanel" aria-labelledby="{{ $heading }}">
                    <div class="panel-body">
                        <div class="all-options">

                            <h2 style="display: flex;justify-content: space-between;">Options </h2>
                            <ol type="A" class="check-list">
                                @foreach( $all_options as $key => $item)
                                    <li class="{{ in_array( $item, $right_options, true ) ? 'right' : '' }}"> {{ $item }} </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endif

