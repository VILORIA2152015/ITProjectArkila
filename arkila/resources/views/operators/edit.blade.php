@extends('layouts.master')
@section('title', 'Edit Operator Information') 
@section('links') 
@parent
<link rel="stylesheet" href="{{ URL::asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"> 
@stop 
@section('content')

<div class="box box-warning">
    <div class="box-header with-border text-center">
        <a href="{{route('operators.showProfile',[$operator->member_id])}}" class="pull-left btn btn-default"><i class="fa  fa-chevron-left"></i></a>
        <h3 class="box-title">
            Edit Operator Information
        </h3>
    </div>

    <form method="POST" id="regForm" action="{{route('operators.update',[$operator->member_id])}}">
        {{csrf_field()}}
        {{method_field("PATCH")}}

        <div class="box-body">

            <div class="tab">
                <h4>Personal Information</h4>
                <div class="tab">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="operatorLastName">Last Name:</label>
                            <input value= "{{old('lastName') ?? $operator->last_name }}" id="driverLastName" name="lastName" type="text" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label for="contactNumberO">Contact Number:</label>
                            <input  value = "{{old('contactNumber') ?? $operator->edit_contact_number }}" id="contactNumberO" name="contactNumber" type="text" class="form-control" placeholder="Contact Number">
                        </div>

                        <div class="form-group">
                            <label for="genderO">Gender:</label>
                            <div class="radio">
                                <label for="genderMaleO"> Male</label>
                                <label class="radio-inline">
                                        <input type="radio" name="gender" id="genderMaleO" value="Male" class="flat-blue" @if(old('gender') || $operator->gender == 'Male') {{ 'checked' }} @endif>
                                    </label>
                                <label for="genderFemaleO">Female</label>
                                <label class="radio-inline">
                                        <input type="radio" name="gender" id="genderFemaleO" value="Female" class="flat-blue" @if(old('gender') || $operator->gender == 'Female') {{ 'checked' }} @endif>

                                    </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sssO">SSS No:</label>
                            <input id="sssO" name="sss" value="{{  old('sss') ?? $operator->SSS }}" type="text" class="form-control" placeholder="SSS No.">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="operatorFirstName">First Name:</label>
                            <input id="operatorFirstName" value="{{old('firstName')  ?? $operator->first_name}}" name="firstName" type="text" class="form-control" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="addressO">Address:</label>
                            <input id="addressO" value="{{old('address') ?? $operator->address }}" name="address" type="text" class="form-control" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="birthdateO">Birthdate:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input value="{{ old('birthDate') ?? $operator->birth_date }}" id="birthdateO" name="birthDate" type="text" class="form-control pull-right datepicker">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="citizenshipO">Citizenship:</label>
                            <input value="{{ old('citizenship') ?? $operator->citizenship }}" id="citizenshipO" name="citizenship" type="text" class="form-control" placeholder="Citizenship">
                        </div>
                        <div class="form-group">
                            <label for="licenseNoO">License No:</label>
                            <input id="licenseNoO" value="{{  old('licenseNo') ?? $operator->license_number }}"  name="licenseNo" type="text" class="form-control" placeholder="License No.">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="operatorMiddleName">Middle Name:</label>
                            <input id="operatorMiddleName" value="{{  old('middleName')  ?? $operator->middle_name }}"  name="middleName" type="text" class="form-control" placeholder="Middle Name">
                        </div>
                        <div class="form-group">
                            <label for="provincialAddressO">Provincial Address:</label>
                            <input value="{{old('provincialAddress') ?? $operator->provincial_address }}"  id="provincialAddress" name="provincialAddress" type="text" class="form-control" placeholder="Provincial Address">
                        </div>
                        <div class="form-group">
                            <label for="birthplaceO">Birthplace:</label>
                            <input value="{{old('birthPlace') ?? $operator->birth_place }}" id="birthplaceO" name="birthPlace" type="text" class="form-control" placeholder="Birthplace">
                        </div>
                        <div class="form-group">
                            <label for="civilStatusO">Civil Status:</label>
                            <select id="civilStatusO" name="civilStatus" class="form-control">
                                    <option @if(old('civilStatus') || $operator->civil_status == 'Single') {{ 'selected' }}  @endif >Single</option>
                                    <option @if(old('civilStatus') || $operator->civil_status == 'Married') {{ 'selected' }}  @endif>Married</option>
                                    <option @if(old('civilStatus') || $operator->civil_status == 'Divorced') {{ 'selected' }}  @endif>Divorced</option>
                                    <option @if(old('civilStatus') || $operator->civil_status == 'Widowed') {{ 'selected' }} @endif>Widowed</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="licenseExpiryDateO">License Expiry Date:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input value="{{  old('licenseExpiryDate')  ?? $operator->expiry_date }}" id="licenseExpiryDateO" name="licenseExpiryDate" type="text" class="form-control pull-right datepicker">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab">
                <h4>Family Information</h4>
                <div class="tab">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="spouseNameO">Name of Spouse:</label>
                            <input value="{{ old('nameOfSpouse') ?? $operator->spouse }}"  id="spouseNameO" name="nameOfSpouse" type="text" class="form-control" placeholder="Name of Spouse">
                        </div>
                        <div class="form-group">
                            <label for="fathersNameO">Fathers Name:</label>
                            <input value="{{ old('fathersName') ?? $operator->father_name }}"  id="fathersNameO" name="fathersName" type="text" class="form-control" placeholder="Fathers Name">
                        </div>
                        <div class="form-group">
                            <label for="mothersNameO">Mothers Name:</label>
                            <input value=" {{ old('mothersName') ?? $operator->mother_name }}" id="mothersNameO" name="mothersName" type="text" class="form-control" placeholder="Mothers Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="spouseBirthDateO">Birthdate of Spouse:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input value="{{  old('spouseBirthDate') ?? $operator->spouse_birthdate }}" id="spouseBirthDateO" name="spouseBirthDate" type="text" class="form-control pull-right datepicker">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="occupationFatherO">Occupation:</label>
                            <input value="{{  old('fatherOccupation') ?? $operator->father_occupation }}" id="occupationFatherO" name="fatherOccupation" type="text" class="form-control" placeholder="Occupation">
                        </div>
                        <div class="form-group">
                            <label for="occupationMotherO">Occupation:</label>
                            <input value="{{ old('motherOccupation') ?? $operator->mother_occupation }}" id="occupationMotherO" name="motherOccupation" type="text" class="form-control" placeholder="Occupation">
                        </div>

                    </div>

                </div>
                <div class="tab">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contactPersonO">Contact Person</label>
                            <input value="{{ old('contactPerson') ?? $operator->person_in_case_of_emergency }}" id="contactPersonO" name="contactPerson" type="text" class="form-control" placeholder="Contact Person In Case of Emergency">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="addressO">Address</label>
                            <input  value="{{ old('contactPersonAddress') ?? $operator->emergency_address }}" id="addressO" name="contactPersonAddress" type="text" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contactNumberO">Contact Number</label>
                            <input value="{{ old('contactPersonContactNumber') ?? $operator->edit_emergency_contactno }}" id="contactNumberO" name="contactPersonContactNumber" type="text" class="form-control" placeholder="Contact Number">
                        </div>
                    </div>
                </div>
                <div class="tab">
                    <div class="col-md-12">
                        <Label for="dependentsO">Dependents:</Label>
                        <table class="table table-hover custab">
                            <thead>
                                <th>Name</th>
                                <th>Birthdate</th>
                                <th>
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-primary" onclick="addItem()"><i class="fa fa-plus-circle"></i> Add Children</button>
                                    </div>
                                </th>
                            </thead>
                            <tbody id="childrens">
                            @if(old('children'))

                                @for($i = 0; $i < count(old('children')); $i++)
                                    <tr>
                                        <td>
                                            <input value="{{old('children.'.$i)}}" name="children[]" type="text" placeholder="Name of Child" class="form-control">
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input value="{{old('childrenBDay.'.$i)}}" name="childrenBDay[]" type="text" class="form-control pull-right datepicker">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="pull-right">
                                                <button style="display: none;" type="button" onclick="event.srcElement.parentElement.parentElement.parentElement.remove();rmv()" class='btn btn-danger'>Delete</button>
                                            </div>
                                        </td>

                                    </tr>
                                @endfor
                            @elseif ($operator->children->first())
                                @foreach($operator->children as $child)
                                    <tr>
                                        <td>
                                            <input value="{{$child->children_name}}" name="children[]" type="text" placeholder="Name of Child" class="form-control">
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input value="{{$child->birthdate}}" name="childrenBDay[]" type="text" class="form-control pull-right datepicker">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="pull-right">
                                                <button style="display: none;" type="button" onclick="event.srcElement.parentElement.parentElement.parentElement.remove();rmv()" class='btn btn-danger'>Delete</button>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <input name="children[]" type="text" placeholder="Name of Child" class="form-control">
                                    </td>
                                    <td>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="childrenBDay[]" type="text" class="form-control pull-right datepicker">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="pull-right">
                                            <button style="display: none;" type="button" onclick="event.srcElement.parentElement.parentElement.parentElement.remove();rmv()" class='btn btn-danger'>Delete</button>
                                        </div>
                                    </td>

                                </tr>
                            @endif
                                


                            </tbody>
                        </table>
                          
                        <button class="btn btn-default pull-right" style="margin: 1% 1%">Cancel</button>
                        <button class="btn btn-primary pull-right"  style="margin: 1% 0%">Save Changes</button> 

                    </div>
                </div>
            </div>
        </div>     
    </form>
</div>


@stop @section('scripts') @parent

<script>
    $(document).ready(function(){
        cloneDatePicker();

        if($('select[name="civilStatus"]').val() == "Single"){
            $('input[name="nameOfSpouse"]').prop('disabled',true);
            $('input[name="spouseBirthDate"]').prop('disabled', true);
        }else{
            $('input[name="nameOfSpouse"]').prop('disabled',false);
            $('input[name="spouseBirthDate"]').prop('disabled', false);
        }

        $('select[name="civilStatus"]').change(function(){
            if($('select[name="civilStatus"]').val()== "Single"){
                $('input[name="nameOfSpouse"]').prop('disabled',true);
                $('input[name="spouseBirthDate"]').prop('disabled', true);
            }else{
                $('input[name="nameOfSpouse"]').prop('disabled',false);
                $('input[name="spouseBirthDate"]').prop('disabled', false);
            }
        });
    });

    function cloneDatePicker() {

        //Date picker
        $('.datepicker').datepicker({
            autoclose: true
        })

    }



    function addItem() {
        var tablebody = document.getElementById('childrens');
        if (tablebody.rows.length == 1) {
            tablebody.rows[0].cells[tablebody.rows[0].cells.length - 1].children[0].children[0].style.display = "";
        }


        var tablebody = document.getElementById('childrens');
        var iClone = tablebody.children[0].cloneNode(true);
        for (var i = 0; i < iClone.cells.length; i++) {
            iClone.cells[i].children[0].value = "";
            iClone.cells[1].children[0].children[1].value = "";

        }
        tablebody.appendChild(iClone);
        cloneDatePicker();
    }


    function rmv() {
        var tabRow = document.getElementById("childrens");
        if (tabRow.rows.length == 1) {
            tabRow.rows[0].cells[tabRow.rows[0].cells.length - 1].children[0].children[0].style.display = "none";
        } else {
            tabRow.rows[0].cells[tabRow.rows[0].cells.length - 1].children[0].children[0].style.display = "";
        }
    }
</script>

@stop