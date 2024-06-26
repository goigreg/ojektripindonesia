<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecartproductRequest;
use Illuminate\Http\Request;
use App\Models\client;
use App\Models\cart;
use App\Http\Requests\StoreclientRequest;
use App\Http\Requests\StoreuserRequest;
use App\Http\Requests\UpdateclientRequest;
use App\Http\Requests\UpdateuserRequest;
use App\Models\bankAccount;
use App\Models\booking;
use App\Models\cartproduct;
use App\Models\companyprofile;
use App\Models\customTour;
use App\Models\message;
use App\Models\product;
use App\Models\ticket;
use App\Models\transactions;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

use function Laravel\Prompts\password;

class ClientController extends Controller
{
    public function index()
    {
        $daytour = product::where('category', '=', 1)->paginate(3);
        $funActivity = product::where('category', '=', 2)->paginate(3);
        $package = product::where('category', '=', 3)->paginate(3);
        $countDaytour = product::where('category', '=', 1)->count();
        $countFunActivity = product::where('category', '=', 2)->count();
        $countPackage = product::where('category', '=', 3)->count();

        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();
        return view('pengunjung.pages.home', [
            'title'             => 'Home',
            'daytour'           => $daytour,
            'funActivity'       => $funActivity,
            'package'           => $package,
            'countDaytour'      => $countDaytour,
            'countFunActivity'  => $countFunActivity,
            'countPackage'      => $countPackage,
            'navLogo'           => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'             => $countcart,
        ]);
    }
    public function details($id)
    {       
        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();
        $data = product::find($id);
        return view('pengunjung.pages.details', compact('data'), [
            'title'         => 'Package Details',
            'navLogo'       => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'         => $countcart,
        ]);        
    }
    public function customTourModal()
    {
        $code = customTour::count();
        $customTourCode = 'CT'. date('ym') . $code + 1;
        return view('pengunjung.modal.customTourModal',[
            'title'            =>'Tour Request',
            'custom_code'      => $customTourCode,
        ]);
    }
    public function submitCustomTour(Request $request)
    {
        $user = Auth::user();
        $data = new customTour();

        $data->custom_tour_code = $request->customCode;
        $data->user_id          = $user->id;
        $data->user_name        = $user->name;
        $data->user_email       = $user->email;
        $data->user_phone       = $user->phone;
        $data->subject          = $request->subject;
        $data->description      = $request->description;
        $data->checked          = 1;

        $data->save();
        Alert::toast('Submited successfully, we will reach you soon', 'success');
        return back();
    }
    public function contacts()
    {
        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();        
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();

        $data = companyprofile::all();
        return view('pengunjung.pages.contact', [
            'title'     => 'Contact',
            'navLogo'   => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'     => $countcart,            
            'data'      => $data,         
        ]);
    }
    public function sendMessage(Request $request)
    {
        $data = new message();

        $data->name         = $request->name;
        $data->email        = $request->email;
        $data->phone        = $request->phone;
        $data->message      = $request->message;
        $data->checked      = 1;

        $data->save();
        Alert::toast('Successful! We will reach you soon', 'success');
        return back();
    }
    public function book($id)
    {
        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();
        $data = product::find($id);
        return view('pengunjung.pages.book', compact('data'), [
            'title'             => 'Book',
            'navLogo'           => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'             => $countcart,
        ]);
    }
    public function toursBook($id)
    {
        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();
        $data = product::find($id);
        return view('pengunjung.pages.book', compact('data'), [
            'title'             => 'Book',
            'navLogo'           => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'             => $countcart,
        ]);
    }
    public function toursDetailsBook($id)
    {
        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();
        $data = product::find($id);
        return view('pengunjung.pages.book', compact('data'), [
            'title'             => 'Book',
            'navLogo'           => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'             => $countcart,
        ]);
    }
    public function detailsBook($id)
    {
        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();
        $data = product::find($id);
        return view('pengunjung.pages.book', compact('data'), [
            'title'             => 'Book',
            'navLogo'           => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'             => $countcart,
        ]);
    }
    public function bookings(Request $request, $id)
    {        
        $data = new booking();

        $code = booking::count();

        $data->user_id               = Auth::id();
        $data->package_id            = $id;
        $data->package_name          = $request->packageName;
        $data->booking_code          = 'B'. date('ym') . $code + 1;
        $data->name                  = $request->firstName. ' '. $request->lastName;
        $data->email                 = $request->email;
        $data->phone                 = $request->phone;
        $data->number_of_adult       = $request->adult;
        $data->number_of_child       = $request->child;
        $data->number_of_infant      = $request->infant;
        $data->price_total           = $request->totalPrice;
        $data->remaining_payment     = $request->totalPrice;
        $data->departure_date        = $request->date;
        $data->payment_status        = 1;
        $data->checked               = 1;

        $data->save();
        Alert::success('Successfully reserved', 'Please complete your payment!');
        return redirect('/checkOut');
    }
    public function checkOut(){
        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();        
        $data = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->get();
        // $ticket = ticket::where(['user_id' => Auth::id(), 'departure_date' => date('Y-m-d')])->count();
        $ticket = ticket::where(['user_id' => Auth::id()])->whereDate('departure_date', '>=', date('Y-m-d'))->count();
        
        return view('pengunjung.pages.checkOut', [
            'title'         => 'Check Out',
            'data'          => $data,
            'navLogo'       => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'         => $countcart,
            'ticket'        => $ticket
        ]);
    }
    public function viewBookData($id){

        $data = booking::findOrFail($id);
        $product = product::where(['id' => $data->package_id])->get();        
        
        return view('pengunjung.modal.viewBookDataModal',
            [
                'title' => 'Booking Details',
                'data'  => $data,
                'product'  => $product,
            ]
        )->render();
    }
    public function updateBookData(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email'                     => 'required|email:dns',
        ]);
        if ($validator->fails()) {
            Alert::toast('Failed, please input email correctly', 'error');
            return back();
        }
        $data = booking::findOrFail($id); 
        $plus = $request->totalPrice - $data->price_total;
        $minus = $data->price_total - $request->totalPrice;
        if ($request->totalPrice >= $data->price_total) {
            $remainingPayment = $data->remaining_payment + $plus;
        }else {
            $remainingPayment = $data->remaining_payment - $minus;
        }
        
        $field = [
            'booking_code'          => $request->bookingCode,
            'departure_date'        => $request->departureDate,
            'name'                  => $request->name,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
            'number_of_adult'       => $request->adult,
            'number_of_child'       => $request->child,
            'number_of_infant'      => $request->infant,
            'price_total'           => $request->totalPrice,
            'remaining_payment'     => $remainingPayment,
        ];

        $dbTransaction = transactions::where(['booking_code' => $request->bookingCode])->count();

        if ($dbTransaction > 0) {
            $transaction = transactions::where(['booking_code' => $request->bookingCode])->get();
            foreach ($transaction as $x) {
                $totalPayment = $x->payment_total;
            }
            $field = ['remaining_payment' => $request->totalPrice - $totalPayment];
        }

        $data::where('id', $id)->update($field);
        Alert::toast('Data successfully changed', 'success');
        return back();
    }
    public function cancelBooking($id)
    {
        $data = booking::findOrFail($id);
        $data->delete();
        Alert::toast('Successfully Canceled', 'success');
        return back();
    }
    public function payNow($id)
    {
        $data = booking::findOrFail($id);
        $bca = bankAccount::where('bank_name', '=', 'BCA')->get();
        $bri = bankAccount::where('bank_name', '=', 'BRI')->get();
        $bni = bankAccount::where('bank_name', '=', 'BNI')->get();
        $mandiri = bankAccount::where('bank_name', '=', 'Mandiri')->get();
        
        return view('pengunjung.modal.payNowModal',
            [
                'title'     => 'Payment',
                'data'      => $data,
                'bca'       => $bca,
                'bri'       => $bri,
                'bni'       => $bni,
                'mandiri'   => $mandiri,
            ]
        );
 
    }
    public function submitPayment(Request $request)
    {
        $existed = transactions::where(['booking_code' => $request->bookingCode])->count();

        if ($existed >= 1) {
            $data = transactions::where(['booking_code' => $request->bookingCode])->get();

            if($request->file('paymentProof')){
                $photo    = $request->file('paymentProof');
                $filename = date('Ymd').'_'.$photo->getClientOriginalName();
                $photo->move(public_path('storage/payment_proof'),$filename);
                $data->payment_proof = $filename;
            }else{
                $filename = $request->paymentProof;
            }

            $updateTransaction = transactions::where(['booking_code' => $request->bookingCode]);
            $updateTransaction->update([
                'bank_name'     => $request->bankName,
                'payment_proof' => $filename,
                'payment_total' => $request->priceTotal
            ]);
            
            $updateBooking = booking::where(['booking_code' => $request->bookingCode]);
            $updateBooking->update([
                'remaining_payment' => 0,
                'payment_status'    => 0
            ]);
        } else {
            $code = transactions::count();
            $data = new transactions();
    
            $data->transaction_code     = 'T'. date('ym') . $code + 1;
            $data->booking_code         = $request->bookingCode;
            $data->name                 = $request->name;
            $data->price_total          = $request->priceTotal;
            $data->payment_total        = $request->priceTotal;
            $data->bank_name            = $request->bankName;
            $data->payment_method       = 'Via website';
            $data->checked              = 1;
    
            if($request->hasFile('paymentProof')){
                $photo    = $request->file('paymentProof');
                $filename = date('Ymd').'_'.$photo->getClientOriginalName();
                $photo->move(public_path('storage/payment_proof'),$filename);
                $data->payment_proof = $filename;
            }
    
            $data->save();
            
            $dbBooking = booking::where(['booking_code' => $request->bookingCode])->get();
            foreach($dbBooking as $x) {
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
                'remaining_payment' => 0,
                'payment_status'    => 0
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
        }     

        Alert::success('Payment successfull', 'Please check your ticket!');
        return redirect('/checkOut');
    }
    public function profile()
    {
        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();
        $data = Auth::user();
        $ticket = ticket::where(['user_id' => Auth::id()])->get();

        return view('pengunjung.pages.profile', [
            'title'         => 'Profile',
            'data'          => $data,
            'ticket'        => $ticket,
            'navLogo'       => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'         => $countcart,
        ]);
    }
    public function downloadPdf($id)
    {
        $ticket = ticket::findOrFail($id);
        $numberOfPeople = $ticket->number_of_adult + $ticket->number_of_child + $ticket->number_of_infant;
        $companyinfo = companyprofile::all();
        foreach ($companyinfo as $x){
            $logo = $x->secondary_logo;
            $address = $x->address;
            $email = $x->main_email;
            $phone = $x->main_phone;
        }

        $dbBooking = booking::where(['booking_code' => $ticket->booking_code])->get();
        foreach ($dbBooking as $x) {
            $bookDate = $x->created_at;
        }
        $dbProduct = product::where(['id' => $ticket->package_id])->get();
        foreach ($dbProduct as $x) {
            $adultPrice = $x->price;
            $childPrice = $x->child_price;
        }
        $dbTransaction = transactions::where(['booking_code' => $ticket->booking_code])->get();
        foreach ($dbTransaction as $x) {
            $priceTotal = $x->price_total;
            $paymentTotal = $x->payment_total;
        }
        $data = [
            'title'         => 'e-ticket',
            'ticket'        => $ticket,
            'companyInfo'   => $companyinfo,
            'logo'          => $logo,
            'address'       => $address,
            'email'         => $email,
            'phone'         => $phone,
            'bookDate'      => $bookDate,
            'numberOfPeople'    =>$numberOfPeople,
            'adultPrice'    => $adultPrice,
            'childPrice'    => $childPrice,
            'priceTotal'    => $priceTotal,
            'paymentTotal'  => $paymentTotal,
        ];

        $pdf = Pdf::loadView('pengunjung.pages.e-ticket', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('invoice.pdf');
    }
    public function viewTicket($id)
    {
        $ticket = ticket::findOrFail($id);
        $numberOfPeople = $ticket->number_of_adult + $ticket->number_of_child + $ticket->number_of_infant;
        $companyinfo = companyprofile::all();
        foreach ($companyinfo as $x){
            $logo = $x->secondary_logo;
            $address = $x->address;
            $email = $x->main_email;
            $phone = $x->main_phone;
        }

        $dbBooking = booking::where(['booking_code' => $ticket->booking_code])->get();
        foreach ($dbBooking as $x) {
            $bookDate = $x->created_at;
        }
        $dbProduct = product::where(['id' => $ticket->package_id])->get();
        foreach ($dbProduct as $x) {
            $adultPrice = $x->price;
            $childPrice = $x->child_price;
        }
        $dbTransaction = transactions::where(['booking_code' => $ticket->booking_code])->get();
        foreach ($dbTransaction as $x) {
            $priceTotal = $x->price_total;
            $paymentTotal = $x->payment_total;
        }

        return view('pengunjung.pages.e-ticket', compact('logo', 'address', 'email', 'phone', 'bookDate',
         'numberOfPeople', 'adultPrice', 'childPrice', 'priceTotal', 'paymentTotal'), [
            'title'         => 'E-ticket',
            'ticket'        => $ticket,
            'companyInfo'   => $companyinfo
        ]);
    }
    public function profileViewTicket($id)
    {
        $ticket = ticket::findOrFail($id);
        $numberOfPeople = $ticket->number_of_adult + $ticket->number_of_child + $ticket->number_of_infant;
        $companyinfo = companyprofile::all();
        foreach ($companyinfo as $x){
            $logo = $x->secondary_logo;
            $address = $x->address;
            $email = $x->main_email;
            $phone = $x->main_phone;
        }

        $dbBooking = booking::where(['booking_code' => $ticket->booking_code])->get();
        foreach ($dbBooking as $x) {
            $bookDate = $x->created_at;
        }
        $dbProduct = product::where(['id' => $ticket->package_id])->get();
        foreach ($dbProduct as $x) {
            $adultPrice = $x->price;
            $childPrice = $x->child_price;
        }
        $dbTransaction = transactions::where(['booking_code' => $ticket->booking_code])->get();
        foreach ($dbTransaction as $x) {
            $priceTotal = $x->price_total;
            $paymentTotal = $x->payment_total;
        }

        return view('pengunjung.pages.e-ticket', compact('logo', 'address', 'email', 'phone', 'bookDate',
         'numberOfPeople', 'adultPrice', 'childPrice', 'priceTotal', 'paymentTotal'), [
            'title'         => 'e-ticket',
            'ticket'        => $ticket,
            'companyInfo'   => $companyinfo
        ]);
    }
    public function sementara()
    {
        return view('pengunjung.pages.sementara', [
            'title'         => 'Sementara'
        ]);
    }
    public function registerFormShow()
    {
        $code = User::count();
        $userCode = 'MOT'. date('ym') . $code + 1;
        return view('pengunjung.modal.memberRegister', [
            'title'              =>'Register',
            'userCode'          => $userCode,
        ]);
        
    }
    public function store(StoreuserRequest $request)
    {
        // name validator
        $nameValidator = Validator::make($request->all(), [
            'name'                      => ['required', 'min:3', 'max:255']
        ]);
        if ($nameValidator->fails()) {
            Alert::toast('Failed, name must be at least 3 characters!', 'error');
            return back();
        }
        // emailUnique validator
        $emailUniqueValidator = Validator::make($request->all(), [
            'email'                     => 'unique:users'
        ]);
        if ($emailUniqueValidator->fails()) {
            Alert::toast('Failed, email already existed', 'error');
            return back();
        }
        // phone validator
        $phoneValidator = Validator::make($request->all(), [
            'phone'                     => 'min:5'
        ]);
        if ($phoneValidator->fails()) {
            Alert::toast('Failed, phone number is invalid', 'error');
            return back();
        }
        // password validator
        $passwordValidator = Validator::make($request->all(), [
            'password'                  => 'min:6'
        ]);
        if ($passwordValidator->fails()) {
            Alert::toast('Failed, password must be at least 6 characters!', 'error');
            return back();
        }
        // passwordConfirm validator
        $passwordConfirmValidator = Validator::make($request->all(), [
            'passwordConfirmation'      => 'required_with:password|same:password|min:6'
        ]);
        if ($passwordConfirmValidator->fails()) {
            Alert::toast('Failed, passwords are not matched', 'error');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name'                      => ['required', 'min:3', 'max:255'],
            'email'                     => 'required|email:dns|unique:users',
            'phone'                     => 'required',
            'password'                  => 'min:6',
            'passwordConfirmation'      => 'required_with:password|same:password|min:6',
        ]);
        if ($validator->fails()) {
            Alert::toast('Failed, some informations are invalid', 'error');
            return back();
        }

        $data = new user();

        $data->user_code             = $request->userCode;
        $data->name                  = $request->name;
        $data->email                 = $request->email;
        $data->phone                 = $request->phone;
        $data->nationality           = '...';
        $data->address               = '...';
        $data->password              = bcrypt($request->password);
        $data->profile_photo         = 'default.png';
        $data->is_admin              = 0;
        $data->checked               = 1;


        $data->save();

        $loginData = $request->validate([
            'email'         => 'required|email:dns',
            'password'      => 'required'
        ]);
        
        if(Auth::attempt($loginData)){
            Alert::toast('Welcome', 'success');
            $request->session()->regenerate();
            return redirect('/profile');
        }
    }
    public function loginFormShow()
    {
        return view('pengunjung.modal.memberLogin', [
            'title'              =>'Login',
        ]);
        
    }
    public function memberLogin(Request $request)
    {
        $loginData = $request->validate([
            'email'         => 'required|email:dns',
            'password'      => 'required'
        ]);

            if(Auth::attempt($loginData)){
                Alert::toast('Welcome', 'success');
                $request->session()->regenerate();
                return redirect('/profile');
            }else{
                Alert::toast('Incorrect email or password', 'error');
                return back();                
            }
    }
    public function memberLogout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::toast('Logged out', 'success');
        return redirect('/');
    }
    public function editProfilePhoto()
    {
        $data = Auth::user();
        return view('pengunjung.modal.editProfilePhotoModal',
            [
                'title' => 'Edit Photo',
                'data'  => $data,
            ]
        )->render();
    }
    public function updateProfilePhoto(UpdateuserRequest $request, user $user, $id)
    {
        $data = User::findOrFail($id);
    
        if($request->file('profilephoto')){
            $photo = $request->file('profilephoto');
            $filename = date('Ymd').'_'.$photo->getClientOriginalName();
            $photo->move(public_path('storage/user'), $filename);
            $data->profile_photo = $filename;
        } else{
            $filename = $request->profilephoto;
        }
        $field = [
            'profile_photo'        => $filename
        ];

        $data::where('id', $id)->update($field);
        Alert::toast('Profile picture updated', 'success');
        return redirect('/profile');
    }
    public function changePassword()
    {
        $data = Auth::user();
        return view('pengunjung.modal.changePasswordModal',
            [
                'title' => 'Change Password',
                'data'  => $data,
            ]
        )->render();
    }
    public function updatePassword(UpdateuserRequest $request, $id)
    {
        $data = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'currentPassword'          => 'required',
            'newPassword'              => 'min:6',
            'newPasswordConfirmation'  => 'required_with:newPassword|same:newPassword' 
        ]);
        $field = [
            'password'  => bcrypt($request->newPassword)
        ];
        if(Hash::check($request->currentPassword, $data->password)){
            if ($validator->fails()) {
                Alert::toast('Failed, passwords are not matched', 'error');
                return redirect('/profile');
            }else{
                $data::where('id', $id)->update($field);
                Alert::toast('Password updated', 'success');
                return redirect('/profile');         
            }
        }else{
            Alert::toast('Failed, password is incorrect', 'error');
            return redirect('/profile');
        }
    }
    public function editProfile()
    {
        $data = Auth::user();
        return view('pengunjung.modal.editProfileModal',
            [
                'title' => 'Edit Profile',
                'data'  => $data,
            ]
        )->render();
    }
    public function updateProfile(UpdateuserRequest $request, user $user, $id)
    {
        $data = User::findOrFail($id);

        if ($request->email == $data->email) {
            $email = $data->email;
        } else {
            $validator = Validator::make($request->all(), [
                'email'                     => 'required|email:dns|unique:users',
            ]);
            if ($validator->fails()) {
                Alert::toast('Failed, email already exist', 'error');
                return back();
            }
            $email = $request->email;
        }
        
        if($request->file('profilephoto')){
            $photo = $request->file('profilephoto');
            $filename = date('Ymd').'_'.$photo->getClientOriginalName();
            $photo->move(public_path('storage/user'), $filename);
            $data->profile_photo = $filename;
        } else{
            $filename = $request->profilephoto;
        }

        $field = [
            'user_code'            => $request->userCode,
            'name'                 => $request->name,
            'email'                => $email,
            'phone'                => $request->phone,
            'nationality'          => $request->nationality ?? '...',
            'address'              => $request->address ?? '...',
            'profile_photo'        => $filename
        ];


        $data::where('id', $id)->update($field);
        Alert::toast('Profile updated', 'success');
        return redirect('/profile');
    }
    public function deleteAccount($id)
    {
        // Auth::id()->delete();
        $data = user::findOrFail($id);
        $data->delete();
        Alert::toast('Account deleted', 'success');
        return redirect('/');
    }
}
