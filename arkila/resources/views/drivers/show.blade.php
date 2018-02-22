@extends('layouts.app')

@section('content')
<div class="col-md-6 col-lg-6">
    <div class="panel-heading">My Drivers</div>
    <div class="panel-body">
       
    <ul class="list-group">
        <li class="list-group-item">Member ID: {{ $driver->member_id }}</li>
        <li class="list-group-item">Last Name: {{ $driver->last_name }}</li>
        <li class="list-group-item">First Name: {{ $driver->first_name }}</li>
        <li class="list-group-item">Middle Name: {{ $driver->middle_name }}</li>
        <li class="list-group-item">Operator: {{ $driver->operator->first_name . ' ' . $driver->operator->last_name }}</li>
        <li class="list-group-item">License Number: {{ $driver->license_number }}</li>
        <li class="list-group-item">Expiry Date: {{ $driver->expiry_date }}</li>
        <li class="list-group-item">Contact Number: {{ $driver->contact_number }}</li>
        <li class="list-group-item">Birth Date: {{ $driver->birth_date }}</li>
        <li class="list-group-item">Age: {{ $driver->age }}</li>
        <li class="list-group-item">Gender: {{ $driver->gender }}</li>
        <li class="list-group-item">Civil Status: {{ $driver->civil_status }}</li>
        <li class="list-group-item">SSS #: {{ $driver->sss }}</li>

    </ul>
    </div>
</div>
<a href="/home/drivers/{{ $driver->driver_id }}/edit/">Edit</a>
<br>
<a href="/home/drivers">View All Drivers</a>

@endsection