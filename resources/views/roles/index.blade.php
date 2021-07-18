@extends('layouts.app', ['title' => __('Manage Role')])

@section('content')

    @include('users.partials.header', [
        'title' => __('Manage Role'),
        'description' => __('Manage Role.'),
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


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                            Add Role
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add a role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if (session('status') === 'success')
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <span class="alert-inner--text"> Manage Role </span>
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

                                        <form class="product-form" action="{{ route('roles.store') }}" method="post"  >
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title"> <b> Role Name : </b></label>
                                                        <input type="text" value="{{ old('name') }}" name="name" class="form-control form-control-alternative" id="name" placeholder="Role Name">
                                                        @error('name')
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
                                            <p class="mt-3 text-right"> <input type="submit" class="btn btn-primary" value="Submit" /> </p>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="list-group" style="margin-top: 20px;">
                            @foreach( $roles as $role )
                                <li class="list-group-item" style="display:flex; justify-content: space-between; flex-wrap: wrap;align-items: center;"> <strong>{{ $role->name }}</strong>
                                <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{ $role->id }}">
                                        Edit Role
                                    </button>
                                </li>


                                <!-- Modal -->
                                <div class="modal fade" id="edit{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Edit role</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if (session('status') === 'success')
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <span class="alert-inner--text"> Manage Role </span>
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

                                                <form class="role-form" action="{{ route('roles.update', [ 'role' => $role->id ]) }}" method="post"  >
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="title"> <b> Role Name : </b></label>
                                                                <input type="text" value="{{ $role->name }}" name="name" class="form-control form-control-alternative" id="name-edit" placeholder="Role Name">
                                                                @error('name')
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
                                                    <p class="mt-3 text-right"> <input type="submit" class="btn btn-primary" value="Submit" /> </p>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

