@extends('layouts.main-layout', ['page_title' => 'Client Salaries'])
@section('styles')
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
<style>
    .salary-box{
        padding: 4px;
        border-radius: 4px;
        border: 1px solid #ddd;
        max-width: 75px; 
        text-align: right;
        color: #666;
    }

    .salary-box[read-only]{
        color: #aaa;
    }

    .text-small{
        font-size: 12px;
    }
</style>
@endsection
@section('content')
        <div class="row">
            <div class="col-xl-4 col">
                <!-- Personal-Information -->
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-20">Tools</h4>
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <label for="apply_to_all">Apply New Wage</label>
                            <input class="form-control" type="number" id="apply_to_all"/>
                        </div>
                        <div class="mt-2 col-sm-12">
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox-g" type="checkbox" name="all_guards" checked>
                                <label for="checkbox-g">
                                    Apply for all guards
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2" style="display: none;" id="role-container">
                            <select class="selectpicker show-tick form-control" data-style="btn-custom" 
                            title="Applicable ranks" id="role" name="role">
                                @foreach($ranks as $rank)
                                <option value="{{$rank->id}}">{{$rank->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right mt-2">
                            <button type="button" id="apply" class="btn btn-custom" onclick="apply()">Apply</button>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label for="reset">Reset All Guard Salaries</label>
                            <p>Be sure you want to reset salaries before you take this action.</p>
                            <div class="text-right">
                                <button type="button" id="reset" class="btn btn-dark" onclick = "reset()">Reset</button>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>


            <div class="col-xl-8">
                <div class="card-box">
                    <h4 class="header-title mb-3">Guards List</h4>

                    <table class="datatable table table-striped" id="datatable">
                        <thead>
                            <th>Guard Name</th>
                            <th>Site Name</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($client->sites as $site)
                                @if($site->duty_roster != null)
                                    @foreach($site->duty_roster->guards as $guard)
                                    <tr>
                                        <td>{{$guard->firstname.' '.$guard->lastname}}</td>
                                        <td>{{$site->name}}</td>
                                        <td class="text-right"><input type="number" class="salary-box" value="{{$guard->client_salary->count() > 0 ? $guard->client_salary[0]->amount : '0.00'}}" step="0.01" readonly/></td>
                                        <td><a href="javascript:void(0)"><i class="dripicons-pencil edit" onclick = "update(this)"></i></a>
                                        &nbsp;<a href="javascript:void(0)" class="text-success update" style="display:none" onclick = "edit(this, '{{$guard->id}}')"><i class="dripicons-checkmark"></i></a>
                                        &nbsp;<a href="javascript:void(0)" class="text-danger cancel" style="display:none" onclick = "cancel(this)"><i class="dripicons-wrong"></i></a></td>
                                    </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end col -->

        </div>
@endsection
@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}" type="text/javascript"></script>
<script>

    $('.selectpicker').selectpicker();
    var name = '{{$client->name}}' + " Salaries " + '<?php echo date('Y-m-d'); ?>';
    var table = $('#datatable').DataTable({
        "bLengthChange": false,
        dom: 'Blfrtip',
        buttons: [ 
            {
                extend: 'excelHtml5',
                title: name
            },
            {
                extend: 'pdfHtml5',
                title: name
            }, 'copy', 'print' ]
    });

    $('#checkbox-g').on("change", function(){
        if($(this).prop('checked')){
            $('#role-container').css('display', 'none');
        }else{
            $('#role-container').css('display', 'block');
        }
    });

    update = (element) => {
        let parent = $(element).closest('tr');
        
        parent.find('.update, .cancel').css('display', 'inline');
        $(element).css('display', 'none');
        
        let textbox = parent.find('.salary-box');
        textbox.data('placeholder', textbox.val());
        textbox.val(null);

        textbox.prop('readonly', false);
        textbox.focus();
    }

    cancel = (element) => {
        let parent = $(element).closest('tr');

        parent.find('.update, .cancel').css('display', 'none');
        parent.find('.edit').css('display', 'inline');

        let textbox = parent.find('.salary-box');
        textbox.val(textbox.data('placeholder'));
        textbox.prop('readonly', true);
    }

    edit = (element, id) => {
        let parent = $(element).closest('tr');
        parent.find('.update, .cancel').css('display', 'none');

        let textbox = parent.find('.salary-box');

        $(element).closest('td').append('<span class="text-muted text-small">Loading</span>');
        
        let data = {
            client_id : '{{$client->id}}',
            guard_id : id,
            amount :  textbox.val()
        }

        $.ajax({
            url : '/api/salaries/edit',
            method : 'POST',
            data : data,
            success : (response) => {
                parent.find('span.text-muted').css('display', 'none');
                parent.find('.edit').css('display', 'inline');
                
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
                        bgColor : '#5cb85c',
                        showHideTransition : 'slide'
                    });
                }
            },
            error : (err) => {
                parent.find('span.text-muted').css('display', 'none');
                parent.find('.update, .cancel').css('display', 'inline');

                $.toast({
                    text : 'Network Error',
                    heading : 'Error',
                    position: 'top-right',
                    showHideTransition : 'slide', 
                    bgColor: '#d9534f'
                });
            }
        });
    }

    const apply = () => {
        let btn = $('#apply');
        let initial = btn.html();

        $('#apply_to_all').closest('div').find('.error-msg').css('display', 'none');

        if($('#apply_to_all').val() == null || $('#apply_to_all').val() == ''){
            $('#apply_to_all').closest('div').append('<p class="text-small text-danger error-msg">Enter an amount</p>')
        }else{
            applyLoading(btn);

            let data = {
                client_id : '{{$client->id}}',
                amount : $('#apply_to_all').val(),
                is_entire : $('#checkbox-g').prop('checked')
            }

            if(!data.is_entire){
                data.role = $('#role').val();
            }

            console.log(data);

            $.ajax({
                url : '/api/salaries/apply',
                method : 'POST',
                data : data,
                success : (response) => {
                    removeLoading(btn, initial);

                    if(response.error){
                        $.toast({
                            text : response.message,
                            heading : 'Error',
                            position: 'top-right',
                            showHideTransition : 'slide', 
                            bgColor: '#d9534f'
                        });
                    }else{
                        $.toast({
                            text : response.message,
                            heading : 'Done',
                            position: 'top-right',
                            bgColor : '#5cb85c',
                            showHideTransition : 'slide'
                        });
                    }
                },
                error : (err) => {
                    removeLoading(btn, initial);
                    
                    $.toast({
                        text : 'Network Error',
                        heading : 'Error',
                        position: 'top-right',
                        showHideTransition : 'slide', 
                        bgColor: '#d9534f'
                    });
                }
            })
        }
    }

    const reset = () => {
        let btn = $('#reset');
        let initial = btn.html();

        applyLoading(btn);

        let data = {
            client_id : '{{$client->id}}'
        }

        $.ajax({
            url : '/api/salaries/reset',
            method : 'POST',
            data : data,
            success : (response) => {
                removeLoading(btn, initial);

                if(response.error){
                    $.toast({
                        text : response.message,
                        heading : 'Error',
                        position: 'top-right',
                        showHideTransition : 'slide', 
                        bgColor: '#d9534f'
                    });
                }else{
                    $.toast({
                        text : response.message,
                        heading : 'Done',
                        position: 'top-right',
                        bgColor : '#5cb85c',
                        showHideTransition : 'slide'
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 500);
                }
            },
            error : (err) => {
                removeLoading(btn, initial);
                
                $.toast({
                    text : 'Network Error',
                    heading : 'Error',
                    position: 'top-right',
                    showHideTransition : 'slide', 
                    bgColor: '#d9534f'
                });
            }
        })
    }    
</script>
@endsection