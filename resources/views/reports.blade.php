@extends('layouts.main-layout', ['page_title' => 'Send Report'])
@section('styles')
<link href="{{asset('plugins/jquery.steps/css/jquery.steps.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/jquery-toastr/jquery.toast.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
            <div class="row notLoader" style="display:none">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title">Report Generation Wizard</h4>
                        <p class="text-muted m-b-30 font-13">
                            Send a report
                        </p>

                        <div class="pull-in">
                            <form id="basic-form" action="#" method="post">
                                <div>
                                    <h3>Report Details</h3>
                                    <section>
                                        <div id="report_details">
                                            <div class="form-row mb-3">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="col-form-label"><b>Client </b>Name <br/></label>
                                                    <select class="selectpicker show-tick validate" data-style="btn-custom" title="Client" id="client_id" name="client_id">
                                                        @foreach($clients as $client)
                                                            <option value="{{$client->id}}" data-email="{{$client->email}}" <?php if(isset($current_client) && $current_client != null && $current_client->id == $client->id) {echo 'selected';} ?>>{{$client->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="col-form-label"><b>Recepient </b>Email <br/></label>
                                                    <input type="email" name="email" id="email" class="form-control validate" <?php if(isset($current_client) && $current_client != null) {echo "value='$current_client->email'";} ?>/>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <label for="date-range" class="col-form-label"><b>Date </b> Range<br/></label>
                                                <div class="input-daterange input-group" id="date-range">
                                                    <input type="text" class="form-control validate" name="start_date" placeholder="Start Date" />
                                                    <input type="text" class="form-control validate" name="end_date" placeholder="End Date"/>
                                                </div>
                                                <p class="text-muted"><i>Hint: Select the dates for which the report starts and ends respectively.</i></p>
                                            </div>
                                        </div>
                                    </section>
                                    <h3>Content</h3>
                                    <section>
                                        <label for="elm1" class="col-form-label"><b>Incidents</b></label>
                                        <textarea id="elm1" name="incidents"></textarea>
                                    </section>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
@endsection
@section('scripts')
<script src="{{asset('plugins/jquery.steps/js/jquery.steps.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('plugins/jquery-toastr/jquery.toast.min.js')}}" type="text/javascript"></script>
<script>
//wizard initialization
!function ($) {
            "use strict";

            var FormWizard = function () { };
            var mce;

            FormWizard.prototype.createBasic = function ($form_container) {
                $form_container.children("div").steps({
                    headerTag: "h3",
                    bodyTag: "section",
                    transitionEffect: "slideLeft",
                    
                    onStepChanging: function (event, currentIndex, newIndex) {
                        //NOTE: Here you can do form validation and return true or false based on your validation logic
                        $('.text-danger').css('display', 'none');
                        var error = false;
                        switch(currentIndex){
                            case 0:
                                $('#report_details').find('select, input').each(function(){
                                    if($(this).val() == null || $(this).val() == ''){
                                        $(this).closest('.form-group').append('<span class="text-danger text-small">This field is required</span>')
                                        error = true;
                                    }
                                });
                                
                                break;
                        }

                        return !error;
                    },

                    onFinished: function (event, currentIndex) {
                        //NOTE: Submit the form, if all validation passed.
                        $('#basic-form').submit();
                        console.log(tinymce.get('elm1').getContent());

                    }
                });
                return $form_container;
            },
                //creates vertical form
                FormWizard.prototype.createVertical = function ($form_container) {
                    $form_container.steps({
                        headerTag: "h3",
                        bodyTag: "section",
                        transitionEffect: "fade",
                        stepsOrientation: "vertical"
                    });
                    return $form_container;
                },
                FormWizard.prototype.init = function () {
                    //initialzing various forms

                    //basic form
                    this.createBasic($("#basic-form"));

                    //vertical form
                    this.createVertical($("#wizard-vertical"));
                },
                //init
                $.FormWizard = new FormWizard, $.FormWizard.Constructor = FormWizard
        }(window.jQuery),

            //initializing 
            function ($) {
                "use strict";
                $.FormWizard.init()
            }(window.jQuery);

        $(document).ready(function(){
            if($("#elm1").length > 0){
                    tinymce.init({
                        selector: "textarea#elm1",
                        theme: "modern",
                        height:300,
                        plugins: [
                            "table contextmenu paste"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | preview media  ",
                        style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ]
                    });
                }
            $('.notLoader').css('display', 'block');
        });

        jQuery('#date-range').datepicker({
            toggleActive: true
        });

        $('#client_id').on('change', function(){
            var email = $(this).find(':selected').data('email');

            $('#email').val(email);
        });

        $('#basic-form').on('submit', function(e){
            e.preventDefault();

            var result = $('ul[aria-label=Pagination]').children().find('a');
            var btn;


            $(result).each(function ()  { 
                if ($(this).text() == 'Finish') {
                    btn = $(this)
                }else{
                    $(this).css('display', 'none');
                }
            });

            var formData = $(this).serialize();
            formData += '&incidents='+tinymce.get('elm1').getContent();
            applyLoading(btn);

            $.ajax({
                url : '/api/report/send-report',
                method : 'POST',
                data: formData,
                success: function(data){
                        removeLoading(btn, 'Finish');
                        if(data.error){
                            removeLoading(btn, 'Add Client');
                            $(result).each(function ()  {
                                $(this).css('display', 'block');
                            });

                        $.toast({
                                text : data.message,
                                heading : 'Error',
                                position: 'top-right',
                                showHideTransition : 'slide', 
                                bgColor: '#d9534f'
                            });
                        
                        }else{
                            $('#new_client').trigger('reset');
                            $.toast({
                                text : data.message,
                                heading : 'Done',
                                position: 'top-right',
                                bgColor : '#5cb85c',
                                showHideTransition : 'slide'
                            });

                            setTimeout(function(){
                                location.reload();
                            }, 500);
                        }
                    },
                error: function(err){
                    removeLoading(btn, 'Finish');
                    $(result).each(function ()  {
                        $(this).css('display', 'block');
                    });
                    $.toast({
                        text : 'Network error',
                        heading : 'Error',
                        position: 'top-right',
                        showHideTransition : 'slide', 
                        bgColor: '#d9534f'
                    });
                }
            });
        });
</script>
@endsection