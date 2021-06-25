@extends('layouts.app', ['title' => __('View Exams')])

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
@endpush

@section('content')

    @include('users.partials.header', [
        'title' => __('View Exams'),
        'description' => __('This is the view exams page. you can manage and control your created exam information.'),
        'class' => 'col-lg-10'
    ])


    <div class="container-fluid mt--7">
        <div class="row">
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
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @foreach( $exam as $item )
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td> {!! ($item->startTime === null) ? '' : date('h:i a - d M Y', strtotime($item->startTime)) !!} </td>
                                        <td> {!! ($item->endTime === null) ? '' : date('h:i a - d M Y', strtotime($item->endTime)) !!} </td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('question.create', [ 'exam_id' => $item->id ]) }}" >Manage questions</a>
                                            <a class="btn btn-info" href="" >Edit</a>
                                            <a class="btn btn-danger" href="" >Delete</a>
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
    <script>
        $(document).ready( function () {
            $('#datatable-buttons-exam').DataTable(
                {
                    "order": []
                }
            );
        } );
    </script>
@endpush
