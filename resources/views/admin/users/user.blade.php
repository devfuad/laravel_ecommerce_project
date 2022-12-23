@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#0B2A97">User</a></li>
        </ol>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="card">
                    <div class="card-header d-flex">
                        <h1>Welcome, {{ Auth::user()->name }} </h1>
                        <h1><span class="">Total User - {{ $total_user }}</span></h1>
                        {{-- {{User::class->name}} --}}
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>created at</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if ($user->image == null)
                                            <img width="55" src="{{ Avatar::create($user->name)->toBase64() }}" />
                                        @else
                                            <img src="{{asset('uploads/user') }}/{{$user->image}}"
                                        width="55" alt="" />
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    {{-- <td><a class="btn btn-danger" href="{{url('/users/delete')}}/{{$user->id}}">Delete</a></td> --}}
                                    <td><a class="btn btn-danger" href="{{ route('delete', $user->id) }}">Delete</a></td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

?>
?>
