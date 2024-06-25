<?php

namespace App\Http\Controllers;

use App\Models\advice;
use App\Models\booking;
use App\Models\companyprofile;
use App\Models\customTour;
use App\Models\message;
use App\Models\transactions;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class adminController extends Controller
{
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
        $nOrder = booking::whereDate('created_at', date('Y-m-d'))->get();
        $nMember = User::where(['role' => 'member'])->whereDate('created_at', date('Y-m-d'))->get();
        $nTransaction = transactions::whereDate('created_at', date('Y-m-d'))->get();
        $nCustom = customTour::whereDate('created_at', date('Y-m-d'))->get();
        $orders = booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                                ->whereYear('created_at', date('Y'))
                                ->groupBy('month')
                                ->orderBy('month')
                                ->get();
        
        $labels = [];
        $data = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#FF5722', '#009688', '#795548', '#9C27B0', '2196F3', '#FF9800', '#CDDC39', '#607D88'];

        for ($i=1; $i <= 12; $i++) { 
            $month = date('F', mktime(0,0,0,$i,1));
            $count = 0;
            
            foreach ($orders as $order) {
                if($order->month == $i){
                    $count = $order->count;
                    break;
                }
            }
            
            array_push($labels,$month);
            array_push($data,$count);
        }

        $datasets = [
            [
                'label' => 'Orders',
                'data' => $data,
                'backgroundColor' => $colors
            ]
            ];

        return view('admin.pages.dashboard', compact('datasets', 'labels'), [
            'name'                  => 'Dashboard',
            'title'                 => 'Admin Dashboard',
            'sideLogo'              => $sideLogo,
            'navLogoAdmin'          => $navlogoAdmin,
            'nOrderCount'           => $nOrderCount,
            'nMemberCount'          => $nMemberCount,
            'nTransactionCount'     => $nTransactionCount,
            'nCustomCount'          => $nCustomTourCount,
            'dashNotif'             => $dashNotif,
            'messageNotif'          => $messageNotif,
            'nOrder'                => $nOrder,
            'nMember'               => $nMember,
            'nTransaction'          => $nTransaction,
            'nCustom'               => $nCustom,
        ]);
    }
    public function order(){
        $nOrderCount = booking::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nMemberCount = User::where(['role' => 'member', 'checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nCustomTourCount = customTour::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nTransactionCount = transactions::where(['checked' => 1, 'payment_method' => 'Via website'])->whereDate('created_at', date('Y-m-d'))->count();
        $dashNotif = $nOrderCount + $nMemberCount + $nCustomTourCount + $nTransactionCount;
        $messageNotif = message::where(['checked' => 1])->count();

        $sideLogo = companyprofile::where(['id' => 1])->get();
        $navlogoAdmin = companyprofile::where(['id' => 1])->get();
        $data = booking::paginate(20);

        return view('admin.pages.order',[
            'name'          => 'Order',
            'title'         => 'Order',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'  => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
            'data'          => $data,
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
        $data = booking::whereDate('created_at', '>=', $start_date)
                        ->wheredate('created_at', '<=', $end_date)
                        ->paginate(20);
        
        return view('admin.pages.order', compact('data', 'start_date', 'end_date'),[
            'name'          => 'Order',
            'title'         =>'Order',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'  => $navlogoAdmin,
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
        $data = booking::where(function($query) use ($search){

                    $query->where('booking_code', 'like', "%$search%")
                    ->orWhere('package_name', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('departure_date', 'like', "%$search%");
                })
                ->paginate(20);

        return view('admin.pages.order', compact('data', 'search'),[
            'name'          => 'Order',
            'title'         =>'Order',
            'sideLogo'      => $sideLogo,            
            'navLogoAdmin'  => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
        ]);

    }
    public function viewOrder($id)
    {
        $data = booking::findOrFail($id);
        $user = User::where(['id' => $data->user_id])->get();
        $data->update([
            'checked'   => '0'
        ]);

        return view('admin.modal.viewOrderModal',[
            'title'     => 'Order Detail',
            'data'      => $data,
            'user'      => $user
        ])->render();
    }
    public function customTour(){
        $nOrderCount = booking::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nMemberCount = User::where(['role' => 'member', 'checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nCustomTourCount = customTour::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nTransactionCount = transactions::where(['checked' => 1, 'payment_method' => 'Via website'])->whereDate('created_at', date('Y-m-d'))->count();
        $dashNotif = $nOrderCount + $nMemberCount + $nCustomTourCount + $nTransactionCount;
        $messageNotif = message::where(['checked' => 1])->count();

        $sideLogo = companyprofile::where(['id' => 1])->get();
        $navlogoAdmin = companyprofile::where(['id' => 1])->get();
        $data = customTour::paginate(20);

        return view('admin.pages.customTour',[
            'name'          => 'Custom Tour Request',
            'title'         => 'Custom Tour Request',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'  => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
            'data'          => $data,
        ]);
    }
    public function customFilter(Request $request)
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
        $data = customTour::whereDate('created_at', '>=', $start_date)
                        ->wheredate('created_at', '<=', $end_date)
                        ->paginate(20);
        
        return view('admin.pages.customTour', compact('data', 'start_date', 'end_date'),[
            'name'          => 'custom Tour Request',
            'title'         =>'custom Tour Request',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'  => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
        ]);
    }
    public function searchCustom(Request $request)
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
        $data = customTour::where(function($query) use ($search){

                    $query->where('custom_tour_code', 'like', "%$search%")
                    ->orWhere('user_name', 'like', "%$search%")
                    ->orWhere('user_email', 'like', "%$search%")
                    ->orWhere('user_phone', 'like', "%$search%")
                    ->orWhere('subject', 'like', "%$search%");
                })
                ->paginate(20);

        return view('admin.pages.customTour', compact('data', 'search'),[
            'name'          => 'custom Tour Request',
            'title'         =>'custom Tour Request',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'  => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
        ]);

    }
    public function viewCustom($id)
    {
        $data = customTour::findOrFail($id);
        $data->update([
            'checked'   => '0'
        ]);

        return view('admin.modal.viewCustomTourModal',[
            'title'     => 'Custom Tour Request',
            'data'      => $data
        ])->render();
    }
    public function message(){
        $nOrderCount = booking::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nMemberCount = User::where(['role' => 'member', 'checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nCustomTourCount = customTour::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nTransactionCount = transactions::where(['checked' => 1, 'payment_method' => 'Via website'])->whereDate('created_at', date('Y-m-d'))->count();
        $dashNotif = $nOrderCount + $nMemberCount + $nCustomTourCount + $nTransactionCount;
        $messageNotif = message::where(['checked' => 1])->count();

        $sideLogo = companyprofile::where(['id' => 1])->get();
        $navlogoAdmin = companyprofile::where(['id' => 1])->get();
        $newData = message::where(['checked' => 1])->get();
        $viewedData = message::where(['checked' => 0])->paginate(20);
        $data = message::paginate(20);
        return view('admin.pages.message',[
            'name'          => 'Message',
            'title'         => 'Message',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'  => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
            'newData'       => $newData,
            'viewedData'    => $viewedData,
            'data'          => $data,
        ]);
    }
    public function filterMessage(Request $request)
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
        $newData = message::where(['checked' => 10])->get();
        $data = message::whereDate('created_at', '>=', $start_date)
                        ->wheredate('created_at', '<=', $end_date)
                        ->paginate(20);
        
        return view('admin.pages.message', compact('data', 'newData', 'start_date', 'end_date'),[
            'name'          => 'Message',
            'title'         =>'Message',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'  => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
        ]);
    }
    public function searchMessage(Request $request)
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
        $newData = message::where(['checked' => 10])->get();
        $data = message::where(function($query) use ($search){

                    $query->where('created_at', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
                })
                ->paginate(20);

        return view('admin.pages.message', compact('data', 'newData', 'search'),[
            'name'          => 'Message',
            'title'         =>'Message',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'  => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
        ]);

    }
    public function viewMessage($id)
    {
        $data = message::findOrFail($id);
        $data->update([
            'checked'   => '0'
        ]);

        return view('admin.modal.viewMessageModal',[
            'title'     => 'Message Detail',
            'data'      => $data
        ])->render();
    }
    public function companyProfile()
    {
        $nOrderCount = booking::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nMemberCount = User::where(['role' => 'member', 'checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nCustomTourCount = customTour::where(['checked' => 1])->whereDate('created_at', date('Y-m-d'))->count();
        $nTransactionCount = transactions::where(['checked' => 1, 'payment_method' => 'Via website'])->whereDate('created_at', date('Y-m-d'))->count();
        $dashNotif = $nOrderCount + $nMemberCount + $nCustomTourCount + $nTransactionCount;
        $messageNotif = message::where(['checked' => 1])->count();

        $sideLogo = companyprofile::where(['id' => 1])->get();
        $navlogoAdmin = companyprofile::where(['id' => 1])->get();
        $data = companyprofile::all();
        return view('admin.pages.companyprofile', [
            'name'          => 'Company Profile',
            'title'         => 'Company Profile',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'  => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
            'data'          => $data
        ]);
    }
    public function updateCompanyProfile(Request $request, $id)
    {
        $data = companyprofile::findOrFail($id);

        if ($request->file('primaryLogo')) {
            $pLogo = $request->file('primaryLogo');
            $filename1 = date('Ymd').'_'.$pLogo->getClientOriginalName();
            $pLogo->move(public_path('storage/company'), $filename1);
            $data->profile_photo = $filename1;
        }else{
            $filename1 = $request->primaryLogo;
        }
        if ($request->file('secondaryLogo')) {
            $sLogo = $request->file('secondaryLogo');
            $filename2 = date('Ymd').'_'.$sLogo->getClientOriginalName();
            $sLogo->move(public_path('storage/company'), $filename2);
            $data->profile_photo = $filename2;
        }else{
            $filename2 = $request->secondaryLogo;
        }

        $field = [
            'about_company'     => $request->aboutCompany,
            'vision'            => $request->vision,
            'mission'           => $request->mission,
            'main_email'        => $request->mainEmail,
            'other_email'       => $request->otherEmail,
            'main_phone'        => $request->mainPhone,
            'other_phone'       => $request->otherPhone,
            'address'           => $request->address,
            'primary_logo'      => $filename1,
            'secondary_logo'    => $filename2,
        ];

        $data::where('id', $id)->update($field);
        Alert::toast('Data successfully changed', 'success');
        return back();
    }
}
