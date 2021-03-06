@extends('layouts.master')
@section('title', 'Profile')
@section('content')
	<div class="box " style="width:40%">
        <div class="box-body box-profile">
            <div class="form-group">

                <img class="profile-user-img img-responsive img-circle" src="{{ URL::asset('img/jl.JPG') }}" alt="profile picture">
            @foreach ($profiles as $profile)
                
                <div class="form-group">
                    <label>Contact Number: <span class="text-red">*</span></label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <span>+63</span>
                      </div>
                      <input type="text" name="contactNumber"  class="form-control" value="{{$profile->contact_number}}" placeholder="Contact Number" data-inputmask='"mask": "999-999-9999"' disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label>Address:</label>
                    <input type="text" class="form-control" value="{{$profile->address}}" disabled>
                </div>
                <div class="form-group">
                    <label>Email :</label>
                    <input type="text" class="form-control" value="{{$profile->email}}" disabled>
                </div>
            </div>

            <div class="col-md-6">
                <a href="{{route('profile.edit',[$profile->id])}}" class="btn btn-outline-secondary btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
            </div>
            <div class="col-md-6">
            @endforeach
            <a href="{{route('accountSettings')}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil-square-o"></i> Change Password</a>
            </div>
        </div> 
    </div>
@endsection


