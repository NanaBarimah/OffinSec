@extends('layouts.main-layout', ['page_title'=>'Offences'])
@section('styles')
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
<link href="{{asset('plugins/jquery-toastr/jquery.toast.min.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
        @if($deductions->count() > 0)
            <div class="row">
                <div class="col-xl-4">
                    <!-- Personal-Information -->
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">Offences form</h4>
                        <div class="panel-body">

                            <form id="record_deduction">
                                <div class="form-group">
                                    <label for="guard" class="col-form-label"><b>&nbsp;</b></label>
                                    <input type="text" id="autocomplete" class="form-control" placeholder="Search for guard" />
                                    <input type="hidden" name="guard_id" id="guard_id" />
                                </div>
                                <div class="form-group mb-4">
                                    <select class="selectpicker show-tick" data-style="btn-danger" title="Select an offence"
                                        id="offence" name="deduction_id">
                                        @foreach($deductions as $deduction)
                                        <option value="{{$deduction->id}}">{{$deduction->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" id="date" name="date" class="form-control" placeholder="Date" />
                                </div>
                                <div class="form-group">
                                    <label for="comment">Describe the Offence</label>
                                    <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>

                        </div>
                    </div>
                    <!-- Personal-Information -->
                    <!-- offences forms -->



                </div>


                <div class="col-xl-8">

                    <div class="row">

                        <div class="card-box col-sm-12">

                            <div class="col-12">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Name of Guard</th>
                                            <th>Offences</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach($offending_guards as $guard)
                                        <tr>
                                            <td>{{$guard->firstname.' '.$guard->lastname}}</td>
                                            <td>{{$guard->offense}}</td>
                                            <td>{{Carbon\Carbon::parse($guard->pivot->date)->format('jS F Y')}}</td>
                                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">{{$guard->pivot->details}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>







                    </div>
                    <!-- end row -->


                </div>
                <!-- end col -->

            </div>
        @else
            <div class="row">
                <div class="jumbotron p-4">
                    <h1 class="display-4">No offence types</h1>
                    <p class="lead">To record a guard's offence, you must first register an offence type.</p>
                    <hr class="my-4">
                    <p>
                        To add an offence type, click the button below to continue
                    </p>
                    <a href="/offence-type" class="btn btn-custom waves">Add New</a>
                </div>
            </div>
        @endif

@endsection
@section('scripts')
<script src="{{asset('plugins/autocomplete/jquery.autocomplete.min.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script src="{{asset('plugins/jquery-toastr/jquery.toast.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    var string = "{{$guards}}";
    
    string = string.replace(/&quot;/g, '"');
    string = string.replace(/&amp;/g, '&');

    var guards = JSON.parse(string);

    var formatted = $.map(guards, function (guard) { return { value: guard.firstname+' '+guard.lastname, data: { id: guard.id } }; });


    $('#autocomplete').devbridgeAutocomplete({
        lookup: formatted,
        minChars: 1,
        onSelect: function (suggestion) {
            $('#guard_id').val(suggestion.data.id);
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'Sorry, no guard matches your query'
    });

    $('#autocomplete').on('keydown', function () {
        $('#guard_id').val(null);
    });

    $('#date').datepicker({
            autoclose: true,
            todayHighlight: true
        });


    var table = $('#datatable').DataTable();

    $('#record_deduction').on('submit', function(e){
        e.preventDefault();
        $('.text-damage').css('display', 'none');
        var error = false;

        $(this).find('[type="text"], select, textarea').each(function(){
            if($(this).val() == '' || $(this).val() == null){
                error = true;
                $(this).closest('div').append('<p class="text-danger text-small text-damage">This field is required</p>');
            }
        });

        if($(this).find('[type="hidden"]').val() ==  null){
            error = true;
            $(this).closest('div').append('<p class="text-danger text-small text-damage">Select a guard</p>');
        }

        if(!error){
            data = $(this).serialize();
            btn = $(this).find('[type="submit"]');
            applyLoading(btn);

            var guard_name = $('#autocomplete').val();
            var offence = $('#offence :selected').val();
            var date = $('#date').val();
            var details = $('#description').val();

            console.log(guard_name);
            console.log(offence);
            console.log(date);
            console.log(details);
            $.ajax({
                url : '/api/offences/record',
                method : 'POST',
                data : data,
                success: function(data){
                    removeLoading(btn, 'Submit');
                        if(data.error){
                            removeLoading(btn, 'Submit');

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

                            table.rows.add([
                                guard_name,
                                offence,
                                date,
                                details
                            ]).draw();
                        }
                },
                error: function(err){
                    removeLoading(btn, 'Submit');

                    $.toast({
                        text : 'Network error',
                        heading : 'Error',
                        position: 'top-right',
                        showHideTransition : 'slide', 
                        bgColor: '#d9534f'
                    });
                }
            })  
        }
    });
</script>
@endsection