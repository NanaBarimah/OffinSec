@extends('layouts.main-layout', ['page_title' => ucwords($guard->firstname.' '.$guard->lastname)])
@section('styles')

<link href="{{asset('plugins/jquery-toastr/jquery.toast.min.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
                <div class="row">
                    <div class="col-sm-12">
                        <!-- meta -->
                        <div class="profile-user-box card-box bg-custom">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span class="float-left mr-3"><img src="{{asset('assets/images/guards/'.$guard->photo)}}" alt="" class="thumb-lg rounded-circle"></span>
                                    <div class="media-body text-white">
                                        <h4 class="mt-1 mb-1 font-18">{{$guard->firstname.' '.$guard->lastname}}</h4>
                                        <p class="font-13 text-light"> {{$guard->phone_number}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-danger waves-effect">
                                            Delete Guard
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ meta -->
                    </div>
                </div>
                <div class="row">
                <div class="col-xl-4">
                    <!-- Personal-Information -->
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">Guard Details</h4>
                        <div class="panel-body">
                            <hr />

                            <div class="text-left">
                                <p class="text-muted font-13"><strong>Guard Name :</strong> <span class="m-l-15">{{$guard->name.' '.$guard->lastname}}</span></p>

                                <p class="text-muted font-13"><strong>Mobile Number:</strong><span class="m-l-15">{{$guard->phone_number}}</span></p>

                                <p class="text-muted font-13"><strong>Emergency :</strong> <span class="m-l-15">{{$guard->emergency_contact}}</span></p>

                                <p class="text-muted font-13"><strong>Gender :</strong> <span class="m-l-15">{{$guard->gender}}</span></p>

                                <p class="text-muted font-13"><strong>Date of birth :</strong> <span class="m-l-15">{{Carbon\Carbon::parse($guard->dob)->format('jS F Y')}}</span></p>

                                <p class="text-muted font-13"><strong>Residential Address :</strong> <span class="m-l-15">{{$guard->address}}</span></p>

                            </div>
                        </div>
                    </div>
                    <!-- Personal-Information -->
                </div>


                <div class="col-xl-8">

            <div class="card-box">
                <h4 class="header-title mt-0 mb-3">Edit Guard</h4>
                <hr/>
                <form method="post" action = "#" id="edit_guard_form">
                <div id="personal_information">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="firstname" class="col-form-label"><b>First</b> Name</label>
                                                    <input type="text" class="form-control required" id="firstname" name="firstname" value="{{$guard->firstname}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="lastname" class="col-form-label"><b>Last</b> Name</label>
                                                    <input type="text" class="form-control required" id="lastname" name="lastname" value="{{$guard->lastname}}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="dob" class="col-form-label"><b>Date of</b> Birth</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control required" id="dob" autocomplete="false" name="dob"  value="{{$guard->dob}}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="phone_number" class="col-form-label"><b>Phone</b></label>
                                                    <input type="tel" placeholder="" data-mask="(999) 999-999999" class="form-control required" name="phone_number" value="{{$guard->phone_number}}">
                                                    <span class="font-10 text-muted">(233) 244-500500</span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="gender" class="col-form-label"><b>&nbsp;</b></label>
                                                    <select class="selectpicker show-tick required" data-style="btn-custom" title="Gender"
                                                        id="gender" name="gender">
                                                        <option <?php if($guard->gender == 'Male'){echo 'selected';} ?>>Male</option>
                                                        <option <?php if($guard->gender == 'Female'){echo 'selected';} ?>>Female</option>
                                                        <option <?php if($guard->gender == 'Transgender'){echo 'selected';} ?>>Transgender</option>
                                                        <option <?php if($guard->gender == 'Rather not say'){echo 'selected';} ?>>Rather not say</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row mb-4">
                                                <div class="form-group col-md-4">
                                                    <label for="phone_number" class="col-form-label"><b>Occupation</b></label>
                                                    <input type="text" class="form-control required" id="occupation" name="occupation" value="{{$guard->occupation}}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="marital" class="col-form-label"><b>&nbsp;</b></label>
                                                    <select class="selectpicker show-tick required" data-style="btn-custom" title="Marital Status"
                                                        id="marital" name="marital_status">
                                                        <option <?php if($guard->marital_status == 'Single'){echo 'selected';} ?>>Single</option>
                                                        <option <?php if($guard->marital_status == 'Married'){echo 'selected';} ?>>Married</option>
                                                        <option <?php if($guard->marital_status == 'Divorced'){echo 'selected';} ?>>Divorced</option>
                                                        <option <?php if($guard->marital_status == 'Widowed'){echo 'selected';} ?>>Widowed</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="residential" class="col-form-label"><b>Residential</b>
                                                        Address</label>
                                                    <input type="text" class="form-control required" id="residential" name="address" value="{{$guard->address}}">
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="bank_name" class="col-form-label"><b>Bank</b> Name</label>
                                                    <input type="text" class="form-control required" id="bank_name" name="bank_name" value="{{$guard->bank_name}}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="account_number" class="col-form-label"><b>Account</b> Number</label>
                                                    <input type="text" class="form-control required" id="account_number" name="account_number" value="{{$guard->account_number}}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Emergency Contact</label>
                                                    <input type="tel" name="emergency_contact"  placeholder="" data-mask="(999) 999-999999" class="form-control"/>
                                                    <span class="font-10 text-muted">(233) 244-500500</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-custom ml-1 waves-effect waves-light edit-guard" disabled="true">Save</button>
                                        </div>
                </form>
            </div>
        </div>
@endsection
@section('scripts')
<script src="{{asset('plugins/jquery-toastr/jquery.toast.min.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script>
    $('#edit_guard_form').find('input').on('keyup', function(){
        $('#edit_guard_form').find('[type="submit"]').prop('disabled', false);
    });

    $('#edit_guard_form').find('select').on('change', function(e){
        $('#edit_guard_form').find('[type="submit"]').prop('disabled', false);
    });
</script>
@endsection