<?php

namespace App\Http\Controllers\Buyer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\ClientTicketCategory;
use App\Admin\ClientTicketTitle;
use App\Buyer\ClientTicket;
use App\Mails\TicketMail;
use App\Buyer\ClientUsers;
use App\Admin\SupportMessage;
class ClientTicketController extends Controller
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
        return view('client.support_ticket.index')->with('data', $data);
    }    
    public function listData(){
        $model = ClientTicket::select('tc.name','client_tickets.id','tt.name as title','ticket_id','status','client_tickets.updated_at')
                                ->join('client_ticket_category as tc','tc.id','=','category_id')
                                ->join('client_ticket_title as tt','tt.id','=','title')
                                ->where('client_id', session('cuserid'))->get();
        return $model;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ClientTicketCategory::all();
        $title = ClientTicketTitle::all();  
        return view('client.support_ticket.create')->with('categories', $categories)->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TicketMail $mailer)
    {
        // return $request->all();
        $ticket = new ClientTicket();
        if($ticket->validate($request->all())){
            $name = '';
            if($request->has('screenshot')){
                $image = $request->screenshot;
                $extension = $image->getClientOriginalExtension();
                $name = 'screenshot'.(new \Datetime())->format('U').'.'.$extension;
                $image->storeAs(
                    'client-ticket',$name ,'file-repo'
                );
            }
            $ticket->fill($request->except('_token'));
            $ticket->client_id = session('cuserid');
            $ticket->ticket_id = strtoupper(str_random(10));
            $ticket->status = "Open";
            $ticket->screenshot = $name;
            if($ticket->save()){
                $user = ClientUsers::find(session('cuserid'));
                $mailer->sendTicketInformation($user, $ticket);
                return redirect('client/support-ticket')->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
            }
        }else{
            // return $ticket->errors;
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
        $ticket = ClientTicket::findorfail($id);
        $ticket->title = ClientTicketTitle::find($ticket->title)->name;
        $ticket->category = ClientTicketCategory::find($ticket->category_id)->name;
        return view('client.support_ticket.show')->with('ticket', $ticket);
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
        $model = ClientTicketTitle::where('category_id',$categoryid)->get();
        return response()->json($model);
    }
}
