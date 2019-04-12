<?php

namespace App\Http\Controllers;

use App\Report;
use App\Client;
use App\Site;
use PDF;

use Mail;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-report');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'template' => 'required'
        ]);

        $report = new Report();

        $report->client_id = $request->client_id;
        $report->template = $request->template;

        if($report->save()){
            return response()->json([
                'error' => false,
                'data' => $report,
                'message' => 'Report Created Successfully'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Error creating report'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $report = new Report();

        return view('edit-report')->with('report', $report);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'client_id' => 'required',
            'template' => 'required'
        ]);

        $report->client_id = $request->client_id;
        $report->template = $request->template;

        if($report->update()){
            return response()->json([
                'error' => false,
                'data' => $report,
                'message' => 'Report Updated Successfully'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Error updating report'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }

    public function send(Request $request){
        $clients = Client::all();
        return view('reports')->with('clients', $clients);
    }

    public function generateReport(Request $request){
        $request->validate([
            'client_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'email' => 'required'
        ]);

        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        
        $client = Client::where('id', $request->client_id)->first();
        $id = $client->id;

        $attendances = Site::with('attendances', 'attendances.owner_guard')
                        ->where('client_id', $id)->whereHas('attendances', function($q) use ($start_date, $end_date){
                            $q->whereRaw("DATE(date_time) BETWEEN DATE('$start_date') AND DATE('$end_date')");
                        })->get();
        
        $to_name = $client->name;
        $to_email = $request->email;

        $incidents = $request->incidents;
        
        $pdf = PDF::loadView('report_template', compact('client', 'attendances', 'start_date', 'end_date', 'incidents'));
        $link = storage_path().'/docs'.'/'.microtime().'-'.$client->name.'['.$start_date.'].pdf';
        $pdf->save($link);
        $pdf->stream('download.pdf');
        
        $data = array('start_date' => $request->start_date, 'end_date' => $request->end_date, 'link' => $link);

        Mail::send('email_templates.basic', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Scheduled Report');
            $message->from('noreply@offinsecuritygh.com','Offin Security');
        });

        if(count(Mail::failures()) > 0){
            return response()->json([
                'error' => true,
                'message' => 'Could not send the mail'
            ]);
        }else{
            return response()->json([
                'error' => false,
                'message' => 'Report sent successfully'
            ]);
        }
        
    }
}
