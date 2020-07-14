<?php

namespace App\Http\Controllers\Admin;

use App\Admin\ClientTicketTitle;
use App\Admin\ServiceProviderTicketCategory;
use App\Admin\ServiceProviderTicketTitle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TicketCategory;
use App\Mails\TicketMail;
use App\ServiceProvider\User;
use App\ServiceProvider\VendorTicket;
use Auth;
use DB;

class VendorTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function openIndex()
    {
        return view('admin.vendor_ticket.open_ticket');
    }    
    public function joinTable(){
        $model = new VendorTicket();
        $join = VendorTicket::select('tc.name','spu.contact_name as vendor_name','service_provider_tickets.id','tt.name as title','message','ticket_id','screenshot','service_provider_tickets.created_at','service_provider_tickets.updated_at')
                    ->join('serviceprovider_ticket_category as tc','tc.id','=','category_id')
                    ->join('serviceprovider_ticket_title as tt','tt.id','=','title')
                    ->join('service_provider_users as spu','spu.id','=','service_provider_tickets.service_provider_id')
                    ->orderBy('service_provider_tickets.id','desc');
        return $join;
    }
    public function openTicketData(Request $request){
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = $this::joinTable();
        $rwrd = $rwrd->where('service_provider_tickets.status', 'Open');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd =$rwrd->where('name', 'LIKE', "%$search%")->orwhere('description', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    public function processingIndex()
    {
        return view('admin.vendor_ticket.processing_ticket');
    }    
    public function processingTicketData(Request $request){
        $model = new VendorTicket();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = $this::joinTable();
        $rwrd = $rwrd->where('service_provider_tickets.status', 'Processing');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd =$rwrd->where('name', 'LIKE', "%$search%")->orwhere('description', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    public function closedIndex(){
        return view('admin.vendor_ticket.closed_ticket');
    }
    public function closedTicketData(Request $request){
        $model = new VendorTicket();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = $this::joinTable();
        $rwrd = $rwrd->where('service_provider_tickets.status', 'Closed');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd =$rwrd->where('name', 'LIKE', "%$search%")->orwhere('description', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }

    function updateStatus(Request $r, $id, TicketMail $mailer){
        $this->validate($r, [
            'remarks' => 'required|max:500'
        ]);

        $model = VendorTicket::find($id);
        $model->status = $r->status;
        $model->remarks = $r->remarks;
        if($model->save()){
            $user = User::find($model->service_provider_id);
            $model->category_id = ServiceProviderTicketCategory::find($model->category_id)->name;
            $model->title = ServiceProviderTicketTitle::find($model->title)->name;
            $mailer->sendTicketInformation($user, $model);
            return response()->json($this->successMessage('Data successfully updated'));
        }else{
            return response()->json('Status update failed!', 500);
        }
    }
}
