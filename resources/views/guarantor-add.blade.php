@extends('layouts.main-layout', ['page_title' => 'Add Guarantor'])
@section('styles')
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"/>
<style>
#guarantor-form-container{
    display: none;
}

.text-small{
    font-size: 12px;
}

</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">Add Guarantor</h4>
                <form id="guarantor_form" method="POST" action="#">
                    <div class="form-group col-md-4 mb-4">
                        <label for="gender" class="col-form-label">Select Guard</label>
                        <select class="selectpicker show-tick" data-style="btn-custom" title="Guards"
                            id="guard_id" name="guard_id" data-live-search="true" required>
                            @foreach($guards as $guard)
                            <option value="{{$guard->id}}">{{$guard->firstname." ".$guard->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="guarantor-form-container">
                        <div class="form-row m-b-25">
                            <div class="col-md-6 col-sm-12">
                                <label for="garuantor_firstname">First Name</label>
                                <input class="form-control required" type="text" id="garuantor_firstname" placeholder="Kwame" name="firstname"  required/>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="garuantor_lastname">Last Name</label>
                                <input class="form-control required" type="text" id="garuantor_lastname" placeholder="Attah" name="lastname" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="garuantor_dob" class="col-form-label"><b>Date of</b> Birth</label>
                                <div class="input-group">
                                    <input type="text" class="form-control required" id="dob" name="dob" autocomplete="false" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="garuantor_phone_number" class="col-form-label"><b>Phone</b></label>
                                <input type="tel" placeholder="" data-mask="(999) 999-999999" class="form-control required" name="phone" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="garuantor_gender" class="col-form-label"><b>&nbsp;</b></label>
                                <select class="selectpicker show-tick" data-style="btn-custom" title="Gender" id="gender" name="gender" required>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Transgender</option>
                                    <option>Rather not say</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col-md-4 col-sm-12">
                                <label for="garuantor_occupation">Occupation</label>
                                <input class="form-control required" type="text" id="garuantor_occupation" placeholder="Seamstress" name="occupation" required>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="garuantor_residential">Residential address</label>
                                <input class="form-control required" type="text" id="garuantor_residential" placeholder="21 Ledzekuku St."
                                    name="address" required>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="garuantor_residential">National ID</label>
                                <input class="form-control required" type="text" id="garuantor_national" placeholder="C019382190931"
                                    name="national_id" required>
                            </div>
                        </div>
                        <div class="form-group text-center ">
                            <div class="col-12">
                                <button class="btn w-lg btn-custom waves-effect waves-light" id="submit_guarantor" type="submit">Add
                                    Guarantor</button>
                            </div>
                        </div>
                    </div>
                </form>    
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}"></script>
<script>

    $('#dob').datepicker({
        autoclose: true,
    });


    $('#guard_id').on('change', function(){
        $('#guarantor-form-container').css('display', 'block');
    });

    jQuery.browser = {};
        (function () {
            jQuery.browser.msie = false;
            jQuery.browser.version = 0;
            if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                jQuery.browser.msie = true;
                jQuery.browser.version = RegExp.$1;
        }
    })();

    $('#guarantor_form').on('submit', function(e){
        e.preventDefault();
        $('.text-danger').css('display:none');
        var error = false;

        $(this).find('.required').each(function(){
            if($(this).val() == null || $(this).val() == ''){
                error = true;
                $(this).closest('div').append('<p class="text-danger text-small">This field is required.</p>')
            }
        });

        var btn = $(this).find(['#submit_guarantor']);
        var data = $(this).serialize();
        var initial = btn.html();

        if(!error){
            applyLoading(btn);

            $.ajax({
                url : '/api/guarantor/add',
                method : 'POST',
                data : data,
                success : function(data){
                    removeLoading(btn, initial);
                    if(data.error){
                        $.toast({
                            text : data.message,
                            heading : 'Error',
                            position: 'top-right',
                            showHideTransition : 'slide', 
                            bgColor: '#d9534f'
                        });
                    }else{
                        $.toast({
                            text : data.message,
                            heading : 'Done',
                            position: 'top-right',
                            showHideTransition : 'slide', 
                            bgColor: '#5cb85c'
                        });
                        $('#guarantor_form').trigger('reset');
                        $('.selectpicker').selectpicker('refresh');
                    }
                },
                error : function(err){
                    removeLoading(btn, 'Save');
                    $.toast({
                        text : 'Server error',
                        heading : 'Error',
                        position: 'top-right',
                        showHideTransition : 'slide', 
                        bgColor: '#d9534f'
                    });
                }
            });
        }
    });


</script>
@endsection