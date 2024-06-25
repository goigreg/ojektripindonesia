<?php

namespace App\Http\Controllers;

use App\Models\transactions;
use App\Http\Requests\StoretransactionsRequest;
use App\Http\Requests\UpdatetransactionsRequest;
use App\Models\advice;
use App\Models\booking;
use App\Models\companyprofile;
use App\Models\customTour;
use App\Models\message;
use App\Models\order;
use App\Models\product;
use App\Models\ticket;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nOrderCount = booking::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nMemberCount = User::where(['role' => 'member', 'checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nCustomTourCount = customTour::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nTransactionCount = transactions::where(['checked' => 1, 'payment_method' => 'Via website'])->whereDate('created_at', date('Y-m-d'))->count();
        $dashNotif = $nOrderCount + $nMemberCount + $nCustomTourCount + $nTransactionCount;
        $messageNotif = message::where(['checked' => 1])->count();

        $sideLogo = companyprofile::where(['id' => 1])->get();
        $navlogoAdmin = companyprofile::where(['id' => 1])->get();
        $order = booking::where(['id' => 050321])->get();
        $orderData = booking::where(['id' => 050321])->get();
        $transData = User::all();
        $data = transactions::paginate(20);
        return view('admin.pages.transaction',[
            'name'          => 'Transactions',
            'title'         =>'Transactions',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'          => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
            'data'          => $data,
            'order'         => $order,
            'orderData'     => $orderData,
            'transData'     => $transData
        ]);
    }
    public function filter(Request $request)
    {
        $start_date = $request->startDate;
        $end_date = $request->endDate;

        $nOrderCount = booking::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nMemberCount = User::where(['role' => 'member', 'checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nCustomTourCount = customTour::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nTransactionCount = transactions::where(['checked' => 1, 'payment_method' => 'Via website'])->whereDate('created_at', date('Y-m-d'))->count();
        $dashNotif = $nOrderCount + $nMemberCount + $nCustomTourCount + $nTransactionCount;
        $messageNotif = message::where(['checked' => 1])->count();

        $sideLogo = companyprofile::where(['id' => 1])->get();
        $navlogoAdmin = companyprofile::where(['id' => 1])->get();
        $order = booking::where(['id' => 050321])->get();
        $orderData = booking::where(['id' => 050321])->get();        
        $transData = User::all();
        $data = transactions::whereDate('created_at', '>=', $start_date)
                        ->wheredate('created_at', '<=', $end_date)
                        ->paginate(20);
        
        return view('admin.pages.transaction', compact('data', 'start_date', 'orderData', 'transData', 'end_date'),[
            'name'          => 'Transactions',
            'title'         =>'Transactions',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'          => $navlogoAdmin,
            'order'         => $order,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->search;

        $nOrderCount = booking::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nMemberCount = User::where(['role' => 'member', 'checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nCustomTourCount = customTour::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nTransactionCount = transactions::where(['checked' => 1, 'payment_method' => 'Via website'])->whereDate('created_at', date('Y-m-d'))->count();
        $dashNotif = $nOrderCount + $nMemberCount + $nCustomTourCount + $nTransactionCount;
        $messageNotif = message::where(['checked' => 1])->count();

        $sideLogo = companyprofile::where(['id' => 1])->get();
        $navlogoAdmin = companyprofile::where(['id' => 1])->get();
        $order = booking::where(['id' => 050321])->get();
        $orderData = booking::where(['id' => 050321])->get();
        $transData = User::all();
        $data = transactions::where(function($query) use ($search){

                    $query->where('transaction_code', 'like', "%$search%")
                    ->orWhere('booking_code', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('payment_method', 'like', "%$search%");
                })
                ->paginate(20);

        return view('admin.pages.transaction', compact('data', 'orderData', 'transData', 'search'),[
            'name'          => 'Transactions',
            'title'         =>'Transactions',
            'order'         => $order,
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'          => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
        ]);

    }
    public function searchBooking(Request $request)
    {
        $searchBooking = $request->searchBooking;

        $nOrderCount = booking::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nMemberCount = User::where(['role' => 'member', 'checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nCustomTourCount = customTour::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nTransactionCount = transactions::where(['checked' => 1, 'payment_method' => 'Via website'])->whereDate('created_at', date('Y-m-d'))->count();
        $dashNotif = $nOrderCount + $nMemberCount + $nCustomTourCount + $nTransactionCount;
        $messageNotif = message::where(['checked' => 1])->count();

        $sideLogo = companyprofile::where(['id' => 1])->get();
        $navlogoAdmin = companyprofile::where(['id' => 1])->get();
        $orderData = booking::all();
        $order = booking::where(function($query) use ($searchBooking){
                    $query->where('booking_code', 'like', "%$searchBooking%");
                })
                ->get();
        $countBookingCode = booking::where(function($query) use ($searchBooking){
                    $query->where('booking_code', 'like', "%$searchBooking%");
                })
                ->count();
        $bookingCode = booking::where(function($query) use ($searchBooking){
                    $query->where('booking_code', 'like', "%$searchBooking%");
                })
                ->get(['booking_code']);

        $transData = transactions::where(['id' => 050321])->get();
        if ($countBookingCode > 0) {
            foreach ($bookingCode as $x) {
                $existed = transactions::where('booking_code', $x->booking_code)->count();
            }
                            
            if ($existed > 0) {
                Alert::toast('Data has existed', 'error');
                return redirect('/admin/transaction');
            }else{
                return view('admin.pages.transaction', compact('order', 'orderData', 'transData', 'searchBooking'),[
                    'name'          => 'Transactions',
                    'title'         => 'Transactions',
                    'sideLogo'      => $sideLogo,
                    'navLogoAdmin'          => $navlogoAdmin,
                    'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
                ]);
            }
        }else{
            return view('admin.pages.transaction', compact('order', 'orderData', 'transData', 'searchBooking'),[
                'name'          => 'Transactions',
                'title'         => 'Transactions',
                'sideLogo'      => $sideLogo,
                'navLogoAdmin'          => $navlogoAdmin,
                'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
            ]);
        }
    }
    public function viewTransaction($id)
    {
        $data = transactions::findOrFail($id);
        $data->update([
            'checked'   => '0'
        ]);

        return view('admin.modal.viewTransactionModal',
        [
            'title' => 'Transaction Details',
            'data'  => $data,
        ]
    )->render();
    }
    public function editTransaction($id)
    {
        $data = transactions::findOrFail($id);

        return view('admin.modal.editTransactionModal',
        [
            'title' => 'Edit Transaction',
            'data'  => $data,
        ]
    )->render();
    }
    public function updateTransaction(Request $request, $id)
    {
        $data = transactions::findOrFail($id);

        if($request->file('paymentProof')){
            $photo    = $request->file('paymentProof');
            $filename = date('Ymd').'_'.$photo->getClientOriginalName();
            $photo->move(public_path('storage/payment_proof'),$filename);
            $data->payment_proof = $filename;
        }else{
            $filename = $request->paymentProof;
        }

        $field = [
            'bank_name'     => $request->bankName,
            'payment_proof' => $filename,
            'payment_total' => $request->paymentTotal
        ];

        $data::where('id', $id)->update($field);

        if ($request->paymentTotal < $request->priceTotal) {
            $paymentStatus = 1;
        } else {
            $paymentStatus = 0;
        }
        
        // $dbBooking = booking::where(['booking_code' => $request->bookingCode])->get();
        // foreach($dbBooking as $x) {
        //     $remainingPayment = $x->remaining_payment;
        // }
        // $plus = $request->paymentTotal - $remainingPayment;
        // $minus = $remainingPayment - $request->paymentTotal;
        // if ($request->paymentTotal >= $remainingPayment) {
        //     $updateRemainingPayment = $remainingPayment - $request->paymentTotal
        // }
        $updateBooking = booking::where(['booking_code' => $request->bookingCode]);
        $updateBooking->update([
            'remaining_payment' => $request->priceTotal - $request->paymentTotal,
            'payment_status' => $paymentStatus
        ]);
        Alert::toast('Data successfully updated', 'success');
        return redirect('admin/transaction');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addTransactionModal($id)
    {
        $data = booking::findOrFail($id);

        return view('admin.modal.addTransactionModal',[
            'title'     => 'Add Transaction',
            'data'      => $data
        ])->render();
    }
    public function storeTransaction(Request $request)
    {
        $code = transactions::count();
        $data = new transactions();

        $data->transaction_code     = 'T'. date('ym') . $code + 1;
        $data->booking_code         = $request->bookingCode;
        $data->name                 = $request->name;
        $data->price_total          = $request->priceTotal;
        $data->payment_total        = $request->paymentTotal;
        $data->bank_name            = $request->bankName;
        $data->payment_method       = 'Via admin';
        $data->checked              = 1;

        if($request->hasFile('paymentProof')){
            $photo    = $request->file('paymentProof');
            $filename = date('Ymd').'_'.$photo->getClientOriginalName();
            $photo->move(public_path('storage/payment_proof'),$filename);
            $data->payment_proof = $filename;
        }

        $data->save();

        if ($request->paymentTotal < $request->priceTotal) {
            $paymentStatus = 1;
        } else {
            $paymentStatus = 0;
        }
        
        $dbBooking = booking::where(['booking_code' => $request->bookingCode])->get();
        foreach($dbBooking as $x) {
            $remainingPayment = $x->remaining_payment;
            $userId = $x->user_id;
            $packageId = $x->package_id;
            $packageName = $x->package_name;
            $numberOfAdult = $x->number_of_adult;
            $numberOfChild = $x->number_of_child;
            $numberOfInfant = $x->number_of_infant;
            $departureDate = $x->departure_date;
        }
        $dbProduct = product::where(['id' => $packageId])->get();
        foreach ($dbProduct as $x) {
            $note = $x->note;
        }
        $updateBooking = booking::where(['booking_code' => $request->bookingCode]);
        $updateBooking->update([
            'remaining_payment' => $remainingPayment - $request->paymentTotal,
            'payment_status'    => $paymentStatus
        ]);

        $ticket = new ticket();

        $ticket->ticket_number      = date('ym') . rand('000', '999');
        $ticket->user_id            = $userId;
        $ticket->package_id         = $packageId;
        $ticket->package_name       = $packageName;
        $ticket->booking_code       = $request->bookingCode;
        $ticket->name               = $request->name;
        $ticket->number_of_adult    = $numberOfAdult;
        $ticket->number_of_child    = $numberOfChild;
        $ticket->number_of_infant   = $numberOfInfant;
        $ticket->departure_date     = $departureDate;
        $ticket->note               = $note;
        $ticket->status             = 1;

        $ticket->save();

        Alert::toast('Data successfully saved', 'success');
        return redirect('/admin/transaction');
    }

    /**
     * Display the specified resource.
     */
    public function show(transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetransactionsRequest $request, transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = transactions::findOrFail($id);
        $data->delete();

        $dbBooking = booking::where(['booking_code' => $data->booking_code])->get();
        foreach($dbBooking as $x){
            $priceTotal = $x->price_total;
        }
        $updateBooking = booking::where(['booking_code' => $data->booking_code]);
        $updateBooking->update([
            'payment_status' => '1',
            'remaining_payment' => $priceTotal
        ]);

        $deleteTicket = ticket::where(['booking_code' => $data->booking_code]);
        $deleteTicket->delete();

        Alert::toast('Data successfully deleted', 'success');
        return redirect('/admin/Transaction');
    }
}
