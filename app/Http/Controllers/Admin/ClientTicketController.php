<?php

namespace App\Http\Controllers\Admin;

use App\Admin\ClientTicketCategory;
use App\Admin\ClientTicketTitle;
use App\Buyer\ClientTicket;
use App\Buyer\ClientUsers;
use App\Http\Controllers\Controller;
use App\Mails\TicketMail;
use DB;
use Illuminate\Http\Request;

class ClientTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function openIndex()
    {
        return view('admin.client_ticket.open_ticket');
    }

    public function joinTable()
    {
        $model = new ClientTicket();
        $join = ClientTicket::select('tc.name', 'cu.name as client_name', 'client_tickets.id', 'tt.name as title','message', 'ticket_id', 'client_tickets.status','client_tickets.screenshot', 'client_tickets.created_at', 'client_tickets.updated_at')
        ->join('client_ticket_category as tc', 'tc.id', '=', 'category_id')
        ->join('client_ticket_title as tt', 'tt.id', '=', 'title')
        ->join('client_users as cu', 'cu.id', '=', 'client_tickets.client_id')
        ->orderBy('client_tickets.id','desc');
        return $join;
    }

    public function openTicketData(Request $request)
    {
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = $this::joinTable();
        $rwrd = $rwrd->where('client_tickets.status', 'Open');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = $rwrd->where('name', 'LIKE', "%$search%")->orwhere('description', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }

    public function processingIndex()
    {
        return view('admin.client_ticket.processing_ticket');
    }

    public function processingTicketData(Request $request)
    {
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = $this::joinTable();
        $rwrd = $rwrd->where('client_tickets.status', 'Processing');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = $rwrd->where('name', 'LIKE', "%$search%")->orwhere('description', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }

    public function closedIndex()
    {
        return view('admin.client_ticket.closed_ticket');
    }

    public function closedTicketData(Request $request)
    {
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = $this::joinTable();
        $rwrd = $rwrd->where('client_tickets.status', 'Closed');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = $rwrd->where('name', 'LIKE', "%$search%")->orwhere('description', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }

    function updateStatus(Request $r, $id, TicketMail $mailer)
    {
        $this->validate($r, [
            'remarks' => 'required|max:500'
        ]);
        $model = ClientTicket::find($id);
        $model->status = $r->status;
        $model->remarks = $r->remarks;
        if ($model->save()) {
            $user = ClientUsers::find($model->client_id);
            $model->category_id = ClientTicketCategory::find($model->category_id)->name;
            $model->title = ClientTicketTitle::find($model->title)->name;
            $mailer->sendTicketInformation($user, $model);
            return response()->json($this->successMessage('Data successfully updated'));
        } else {
            return response()->json('Status update failed!', 500);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
