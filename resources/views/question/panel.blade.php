@if( count($question) > 0 )
<div class="panel-group notiflix-block-element" id="accordion" role="tablist" aria-multiselectable="true">
@foreach( $question as $ques )
@php
    $show          = ( $loop->last ) ? 'show' : '';
    $collapse_id   = 'questionCollapse'.$ques->id;
    $aria_expanded = ( $loop->last ) ? true : false;
    $heading       = 'questionHeading'.$ques->id;
    $collapsed     = ( $loop->last ) ? '' : 'collapsed';
@endphp
    <div class="panel panel-default single-question">
        <div class="panel-heading" role="tab" id="{{ $heading }}">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" style="display: flex;flex-wrap: wrap;" data-parent="#accordion" href="#{{ $collapse_id }}" aria-expanded="{{ $aria_expanded }}" aria-controls="{{ $collapse_id }}" class="{{ $collapsed }}">
                    <b style="margin-right: 10px;">{{ $loop->iteration }}. </b>{!!html_entity_decode($ques->question)!!}
                </a>
            </h4>
        </div>
        <div id="{{ $collapse_id }}" class="panel-collapse in collapse {{ $show }}" role="tabpanel" aria-labelledby="{{ $heading }}">
            <div class="panel-body">
                <div class="all-options">
                    <h2 style="display: flex;justify-content: space-between;">Options <button class="btn btn-info" >Edit</button> </h2>
                    <ol type="A" class="check-list">

                        @php
                            $all_options   = ( $ques->options ) ? json_decode($ques->options->options_name)->options : [];
                            $right_options = ( $ques->options && $ques->options->right_option != null ) ? json_decode($ques->options->right_option)->answer : [];
                        @endphp

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