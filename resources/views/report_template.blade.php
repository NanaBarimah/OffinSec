<div class="container invoice">
  <table>
      <tr>
          <td>
              <h1>Scheduled Attendance Report</h1>
          </td>
      </tr>
      <tr style="margin-top: 16px">
        <td>
            <h4>{{$client->name}}
            <br/>{{$client->email}}
            <br/>{{$client->phone_number}}</h4>
        </td>
        <td>
            <h4>Offin Security Limited
            <br/>info@offinsecuritygh.com
            <br/>+233 261527546</h4>
        </td>
      </tr>
      <tr>
          <td style="width: 100%;">
              <h5 style="text-align: center">Attendance Report for guards between <b>{{Carbon\Carbon::parse($end_date)->format('jS F Y')}}</b> and <b>{{Carbon\Carbon::parse($start_date)->format('jS F Y')}}</b></h5>
          </td>
      </tr>
      <tr>
          <td>
              <p>
                  This report contains the following information:
                    <ul>
                        <li>Attendance of guards between the specified dates per site</li>
                        <li>Incidents that occured on the sites between the dates specified</li>
                    </ul>
              </p>
          </td>
      </tr>
      <tr>
          <td>
            <h2>
                Incident Reports
            </h2>
            @if($incidents!=null)
            <div>
                {!! $incidents !!}
            </div>
            @else
            <p>No incidents were recorded during the specified time period</p>
            @endif
          </td>  
      </tr>
      <tr>
          <td>
            <h2>
                Attendance Reports
            </h2>
            <p>These were the guards that <b>checked in </b> with our biometric time attendance system </p>
            @foreach($attendances as $attendance)
            <h4>{{$attendance->name}}</h4>
            <table>
                <thead>
                    <th>Guard Name</th>
                    <th>Time In</th>
                </thead>
                <tbody>
                    @foreach($attendance->attendances as $attendance)
                        <tr>
                            <td>
                                {{$attendance->owner_guard->name}}
                            </td>
                            <td>
                                {{$attendance->date_time}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
          </td>
      </tr>
  </table>
</div>