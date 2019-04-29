<div class="container invoice">
  <table>
      <tr>
          <td>
              <h1>Scheduled Client Report</h1>
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
              <h5>Attendance Report for guards between <b>{{Carbon\Carbon::parse($end_date)->format('jS F Y')}}</b> and <b>{{Carbon\Carbon::parse($start_date)->format('jS F Y')}}</b></h5>
          </td>
      </tr>
      <tr>
          <td>
              <h3>Contents</h3>
              <p>
                    As requested, the following report includes information for the specified time period on the following, grouped into respective sites:
                    <ol>
                        <li>Incidents Recorded</li>
                        <li>Occurences Recorded</li>
                        <li>Attendance Recorded</li>
                        <li>Extra Notes</li>
                    </ol>
              </p>
          </td>
      </tr>
      <tr>
          @foreach($client->sites as $site)
          <td style="margin-bottom: 40px">
            <h4>{{$site->name}}</h4>
            <h5>
                Incident Reports
            </h5>
            @if($site->incidents->count() > 0)
            <div>
                @foreach($site->incidents as $incident)
                <p style="font-weight: bold; font-size: 16px; text-transform: uppercase;">Date: {{Carbon\Carbon::parse($incident->created_at)->format('jS F, Y')}}</p>
                <table style="border:2px; width: 100%;">
                    <thead>
                        <th>Incident</th>
                        <th>Action Taken</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$incident->incident}}</td>
                            <td>{{$incident->action_taken}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
            @else
            <p>No incidents were recorded for this site during the specified time period</p>
            @endif
          </td>  
          @endforeach
      </tr>
      <tr>
          <td>
            <h5>
                Attendance Reports
            </h5>
            
          </td>
      </tr>
  </table>
</div>