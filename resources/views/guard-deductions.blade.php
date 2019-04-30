@extends('layouts.main-layout', ['page_title' => 'Guard Deductions']);
@section('styles')
<link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"/>
<style>
    .hideable{
        display: none;
    }

    .text-small{
        font-size: 12px;
    }

    .table tr td, .table thead th{
        font-size: 14px;
    }
</style>
@endsection
@section('content')
            <div class="row">
                <div class="col-xl-3">
                    <!-- Personal-Information -->
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">Select Month</h4>
                        <div class="panel-body">

                            <form action="#" id="record_shift">
                                @csrf
                                <div class="col-lg-12">

                                    <div class="p-20">
                                        <div class="center-block" style="margin: 0 auto;">
                                            <div id="datepicker-inline" class=""></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-4">                               
                                    <button type="submit" class="btn btn-success">View Deductions</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Personal-Information -->
                    <!-- offences forms -->



                </div>


                <div class="col-xl-9">

                    <div class="row">

                        
                        <div class="card-box col-sm-12">
                            <h4 class="header-title m-t-0 m-b-30">Result</h4>
                            <div class="col-12">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name of Guard</th>
                                                    <th>No. of Offences</th>
                                                    <th>Total Deduction</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                            </div>
                        </div>







                    </div>
                    <!-- end row -->


                </div>
                <!-- end col -->

            </div>
@endsection
@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script>
   
    var selected_month = null;

    var table = $('.table').DataTable({
        "language": {
            "emptyTable":     "No deductions recorded for this month"
        }
    });

    $('#datepicker-inline').datepicker({
            autoclose: true,
            format: 'mm/yyyy',
            viewMode: 1, 
            minViewMode: "months"
    }).on('changeMonth', function(e){
        selected_month = e.date;
    });

    $('#record_shift').on('submit', function(e){
        e.preventDefault();

        if(selected_month == null){
            $(this).append('<p class="text-danger text-small">Select a month</p>');
            return false;
        }else{
            console.log(selected_month);
            btn = $(this).find('[type="submit"]');
            table.clear().draw();

            applyLoading(btn);

            $.ajax({
                'url' : '/api/deductions/view',
                'method' : 'GET',
                data : 'date='+selected_month,
                success: function(data){
                    removeLoading(btn, 'View Deductions');

                    for(var i = 0; i<data.guards.length; i++){
                        table.rows.add([
                            [
                                data.guards[i].firstname+' '+data.guards[i].lastname,
                                data.guards[i].offence_count,
                                'GHS '+data.guards[i].offence_total
                            ]
                        ]).draw();
                    }
                },
                error: function(data){
                     $.toast({
                        text : 'Network error',
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