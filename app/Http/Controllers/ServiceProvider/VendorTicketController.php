<?php

namespace App\Http\Controllers\ServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\ServiceProviderTicketCategory;
use App\Admin\ServiceProviderTicketTitle;
use App\Mails\TicketMail;
use App\ServiceProvider\User;
use App\ServiceProvider\VendorTicket;
use Auth;

class VendorTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this::listData();
        // return $data;
        return view('service_provider.support_ticket.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ServiceProviderTicketCategory::all();
        $title = ServiceProviderTicketTitle::all();
        return view('service_provider.support_ticket.create')->with('categories', $categories)->with('title', $title);
    }
    public function listData(){
        $model = VendorTicket::select('tc.name','service_provider_tickets.id','tt.name as title','ticket_id','status','service_provider_tickets.updated_at')
                                ->join('serviceprovider_ticket_category as tc','tc.id','=','category_id')
                                ->join('serviceprovider_ticket_title as tt','tt.id','=','title')
                                ->where('service_provider_id', session('suserid'))
                                ->get();
        return $model;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TicketMail $mailer)
    {
        $ticket = new VendorTicket();
        if($ticket->validate($request->all())){
            $name = '';
            if($request->has('screenshot')){
                $image = $request->screenshot;
                $extension = $image->getClientOriginalExtension();
                $name = 'screenshot'.(new \Datetime())->format('U').'.'.$extension;
                $image->storeAs(
                    'vendor-ticket',$name ,'file-repo'
                );
            }
            $ticket->fill($request->except("_token"));
            $ticket->service_provider_id = session('suserid');
            $ticket->ticket_id = strtoupper(str_random(10));
            $ticket->status = "Open";
            $ticket->screenshot = $name;
            if($ticket->save()){
                $user = User::find(session('suserid'));
                $mailer->sendTicketInformation($user, $ticket);
                return redirect('service-provider/support-ticket')->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");                   
            }else{
                return redirect()->back()->with('ticket-err', "Server not responding right now, Try again later !!")->withInput();
            }
        }else{
            return redirect()->back()->withErrors($ticket->errors)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = VendorTicket::findorfail($id);
        $ticket->title = ServiceProviderTicketTitle::find($ticket->title)->name;
        $ticket->category = ServiceProviderTicketCategory::find($ticket->category_id)->name;
        // return $ticket;
        return view('service_provider.support_ticket.show')->with('ticket', $ticket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getTitle($categoryid){
        $model = ServiceProviderTicketTitle::where('category_id',$categoryid)->get();
        return response()->json($model);
    }
}
