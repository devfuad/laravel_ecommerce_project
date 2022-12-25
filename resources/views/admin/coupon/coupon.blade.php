@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#" style="color:#0B2A97">Add Coupon</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Coupon List
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Sl</th>
                            <th>Coupon</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Validity</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($coupons as $key => $coupon)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$coupon->coupon_code}}</td>
                                <td>{{$coupon->type == 1?'percentage':'solid'}}</td>
                                <td>{{$coupon->amount}} {{$coupon->type == 1?'%':'Tk'}}</td>
                                <td><div class="badge badge-primary">{{Carbon\Carbon::now()->diffInDays($coupon->validity, false);}} days left</div></td>
                                <td><a href="{{route('coupon.delete', $coupon->id)}}" class="btn btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Coupon</h3>
                </div>
                <div class="card-body">
                    @if (session('coupon_success'))
                            <div class="alert alert-success">{{ session('coupon_success') }}</div>
                        @endif
                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="" class="form-label">Coupon Code</label>
                            <input type="text" name="coupon_code" class="form-control">
                        </div>
                        <div class="mb-3">
                            <select name="type" id="" class="form-control">
                                <option value="">-- Select Coupon Type --</option>
                                <option value="1">Percentage</option>
                                <option value="2">Solid</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Discount Amount</label>
                            <input type="number" name="amount" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Validity</label>
                            <input type="date" name="validity" class="form-control">
                        </div>
                        <button class="btn btn-primary">Add Coupon</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
