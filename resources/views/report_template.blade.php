<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
<meta name="viewport" content="width=device-width"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Offin Security</title>
<style>
table.attendance {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table.attendance caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table.attendance tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table.attendance th,
table.attendance td {
  padding: .625em;
  text-align: center;
}

table.attendance th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
</style>
</head>
<body>
    <!--div style="background:#ffffff; display:block;">
        <div>
            <div style="width:100%">
                <div style="display:block; width:100%;">
                    <div style="display:inline-block; width:66%;">
                        <img src="{{asset('assets/images/offin-logo.png')}}" alt="" height="54" style="margin:8px">
                    </div>
                    <div style="display: inline-block; width: 33%;">
                        <h2>Scheduled Report</h2>
                    </div>
                </div>

                
                <div style="display: block; width:100%; margin-top:12px;">
                    <div style="display:inline-block; width:48%;">
                        <h4>{{$client->name}}</h4>

                        <address style="line-height:24px;">
                            {{$client->email}}<br/>
                            Phone: {{$client->phone_number}}
                        </address>

                    </div>

                    <div style="display:inline-block; width:48%;">
                    <div style="float:right">
                        <h4>Offin Security Ltd</h4>

                        <address style="line-height:24px;">
                            info@offinghana.com<br>
                            Phone: (00233) 203 598142
                        </address>

                    </div>
                    </div>
                </div>


                <div style="width:100%; display:block; margin-top: 12px;">
                    <div style="display:inline-block; width:50%;">
                    <div style="float:left;">
                        <div style="margin-top: 12px;">
                            <p><b>Hello, {{$client->name}}</b></p>
                            <p style="color:#aaaaaa; font-weight: 500">
                                As requested, the following report includes information dated between <b>{{Carbon\Carbon::parse($start_date)->format('jS F Y')}}</b> and <b>{{Carbon\Carbon::parse($end_date)->format('jS F Y')}}</b> on the specified content, grouped according to respective sites</p>
                        </div>
                    </div>    
                    </div>
                    <div style="display: inline-block; width: 40%; margin-left: 16px; margin-top:12px;">
                        <div style="float:right;">
                        <h4>Contents</h4>
                        <ol style="color:#aaaaaa">
                            <li>Incidents Recorded</li>
                            <li>Occurrences Recorded</li>
                            <li>Attendances Recorded</li>
                            <li>Extra Notes</li>
                        </ol>
                        </div>
                    </div>
                </div>
                @foreach($client->sites as $site)
                <div style="display:block; width: 100%; margin-top:15px;">
                    <h2>
                        {{$site->name}}
                    </h2>
                    <div style="width:100%; padding-left:24px;">
                        <h3>Section 1 - Incident Reports</h3>
                        @if($site->incidents->count() > 0)
                        @foreach($site->incidents as $incident)
                        <div style="display:block; margin-top: 24px; padding-left: 24px;">
                            <h5>{{Carbon\Carbon::parse($incident->created_at)->format('jS F, Y g:i A')}}</h5>

                            <div style="margin-top:12px; width: 100%;">
                                <p><b><u>Incident</u></b><br/><br/>{{$incident->incident}}</p>
                                <p><b><u>Actions Taken</u></b><br/><br/>{{$incident->action_taken}}</p>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <p style="color:#aaaaaa; font-weight: 500">No incidents recorded for the specified time period.</p>
                        @endif
                    </div>
                    <div style="width:100%; padding-left:24px; margin-top: 48px;">
                            <h3>Section 2 - Occurrence Reports</h3>
                            @if($site->occurrences->count() > 0)
                            @foreach($site->occurrences as $occurrence)
                            <div style="display:block; margin-top: 24px; padding-left: 24px;">
                                <h5>{{Carbon\Carbon::parse($occurrence->created_at)->format('jS F, Y g:i A')}}</h5>

                                <div style="margin-top:12px; width: 100%;">
                                    <p><b><u>Occurrence</u></b><br/><br/>{{$occurrence->occurrence}}</p>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <p style="color:#aaaaaa; font-weight: 500">No incidents recorded for the specified time period.</p>
                            @endif
                    </div>
                    <div style="width:100%; padding-left:24px; margin-top: 48px;">
                        <h3>Section 3 - Attendance Report</h3>
                        <div style="width:100%;">
                            <div style="width:100%;">
                                    <table class="table mt-4">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Number of guards present</th>
                                        </tr></thead>
                                        <tbody>
                                        @foreach($site->sorted as $attendance)
                                        <tr>
                                            <td>{{Carbon\Carbon::parse($attendance[0]->date_time)->format('jS F, Y')}}</td>
                                            <td>
                                                {{sizeof($attendance)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @if($client->sites->count() < 1 )
                <div style="margin-top: 12px;">
                    <p style="color:#aaaaaa; font-weight: 500">No sites registered for this client</p>
                </div>
                @endif
                
                <div style="display: block; width: 100%;">
                    <div style="display:inline-block; width:100%;">
                        <div style="padding-top:15px;">
                            <h2 class="text-muted">Extra Notes:</h2>

                            <p>
                                All accounts are to be paid within 7 days from receipt of
                                invoice. To be paid by cheque or credit card or direct payment
                                online. If account is not paid within 7 days the credits details
                                supplied as confirmation of work undertaken will be charged the
                                agreed quoted fee noted above.
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div-->
    <div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
            </td>
            <td align="center">
                <img src="assets/images/offin-logo.png" alt="Logo" height="72" class="logo"/>
            </td>
            <td align="right" style="width: 40%;">
            </td>
        </tr>

    </table>
    <table width="100%">
        <tr>
            <td style="width:50%; text-align: left;">
                <h4>{{$client->name}}</h4>
                <p>
                    Email: {{$client->email}}<br/>
                    Phone: {{$client->phone_number}}
                </p>
            </td>
            <td style="width:50%; text-align: right;">
                <h4>Offin Security Limited</h4>
                <pre>
                    Email: info@offinghana.com
                    Phone: (00233) 203 598142
                </pre>
            </td>
        </tr>
    </table>
    </div>


    <br/>

    <div class="invoice" style="margin-top:18px; padding:24px;">
        <p>Dear Sir/Madam, </p>
        <h3 style="text-align: center;">Scheduled Attendance Report</h3>
        <p style="margin-top:12px;">As requested, the following report includes information dated between <b>{{Carbon\Carbon::parse($start_date)->format('jS F Y')}}</b> and <b>{{Carbon\Carbon::parse($end_date)->format('jS F Y')}}</b> on the proceeding table of contents, grouped according to respective sites</p>

        <div style="display:block; margin-top:18px;">
            <h4><u>Table of contents</u></h4>
            <ol style="margin-top:8px;">
                <li>Incident Reports</li>
                <li>Occurrence Reports</li>
                <li>Attendance Reports</li>
                <li>Extra Notes</li>
            </ol>
        </div>
        <div style="display:block; margin-top:20px">
        @if($client->sites->count() > 0)    
            @foreach($client->sites as $site)
                <div style="display:block; width: 100%; margin-top:15px;">
                    <h2>
                        {{$site->name}}
                    </h2>
                    <div style="width:100%; padding-left:24px;">
                        <h4><u>Section 1 - Incident Reports</u></h4>
                        @if($site->incidents->count() > 0)
                        @foreach($site->incidents as $incident)
                        <div style="display:block; margin-top:4px; padding-left: 24px;">
                            <h4>{{Carbon\Carbon::parse($incident->created_at)->format('jS F, Y g:i A')}}</h4>

                            <div style="width: 100%;">
                                <p><b>Incident: </b>{{$incident->incident}}</p>
                                <p><b>Actions Taken: </b>{{$incident->action_taken}}</p>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <p style="color:#aaaaaa; font-weight: 500; padding-left:24px;">No incidents recorded for the specified time period.</p>
                        @endif
                    </div>
                    <div style="width:100%; padding-left:24px; margin-top: 48px;">
                            <h4><u>Section 2 - Occurrence Reports</u></h4>
                            @if($site->occurrences->count() > 0)
                            @foreach($site->occurrences as $occurrence)
                            <div style="display:block; margin-top: 4px; padding-left: 24px;">
                                <h5>{{Carbon\Carbon::parse($occurrence->created_at)->format('jS F, Y g:i A')}}</h5>

                                <div style="width: 100%;">
                                    <p><b>Occurrence: </b>{{$occurrence->occurrence}}</p>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <p style="color:#aaaaaa; font-weight: 500; padding-left:24px;">No incidents recorded for the specified time period.</p>
                            @endif
                    </div>
                    <div style="width:100%; padding-left:24px; margin-top: 48px;">
                        <h4><u>Section 3 - Attendance Report</u></h4>
                        <div style="width:100%;">
                            <div style="width:100%;">
                                    <table class="table mt-4 attendance">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Number of guards present</th>
                                        </tr></thead>
                                        <tbody>
                                        @foreach($site->sorted as $attendance)
                                        <tr>
                                            <td>{{Carbon\Carbon::parse($attendance[0]->date_time)->format('jS F, Y')}}</td>
                                            <td>
                                                {{sizeof($attendance)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <p style="font-weight:bold; color: #aaaaaa">No sites registered for this client</p>
        @endif
        </div>
    </div>
    <div style="display: block; width: 100%;">
        <div style="display:inline-block; width:100%;">
            <div style="padding-top:15px;">
                <h2 class="text-muted">Extra Notes:</h2>

                <p>
                    {{!! $incidents !!}}
                </p>
            </div>

        </div>
    </div>

    <div class="information" style="position: absolute; bottom: 0;" class=>
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
                </td>
                <td align="right" style="width: 50%;">
                    Designed by
                </td>
            </tr>

        </table>
    </div>
</body>
</html>