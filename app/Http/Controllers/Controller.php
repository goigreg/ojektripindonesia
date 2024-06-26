<?php

namespace App\Http\Controllers;

use App\Models\booking;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\cart;
use App\Models\cartproduct;
use App\Models\companyprofile;
use App\Models\product;
use App\Models\transactionDetails;
use App\Models\transactions;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        //
    }
    public function tours()
    {
        $data = product::where('category', '=', 1000)->get();
        $daytour = product::where('category', '=', 1)->get();
        $funActivity = product::where('category', '=', 2)->get();
        $package = product::where('category', '=', 3)->get();

        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();
        return view('pengunjung.pages.tours', [
            'title'             => 'Tours',
            'data'              => $data,
            'daytour'           => $daytour,
            'funActivity'       => $funActivity,
            'package'           => $package,
            'navLogo'           => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'             => $countcart,
        ]);
    }
    public function searchTours(Request $request)
    {
        $search = $request->search;

        $data = product::where(function ($query) use ($search) {

            $query->where('package_name', 'like', "%$search%");
        })->get();

        $daytour = product::where('category', '=', 1000)->get();
        $funActivity = product::where('category', '=', 1000)->get();
        $package = product::where('category', '=', 1000)->get();

        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();
        return view('pengunjung.pages.tours', [
            'title'             => 'Tours',
            'search'            => $search,
            'data'              => $data,
            'daytour'           => $daytour,
            'funActivity'       => $funActivity,
            'package'           => $package,
            'navLogo'           => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'             => $countcart,
        ]);
    }
    public function tourDetails($id)
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
    public function about_us()
    {
        $navLogo = companyprofile::where(['id' => 1])->get();
        $footerInfo = companyprofile::where(['id' => 1])->get();
        $countcart = booking::where(['user_id' => Auth::id(), 'payment_status' => 1])->count();

        $data = companyprofile::where(['id' => 1])->get();
        return view('pengunjung.pages.about_us', [
            'title'     => 'About Us',
            'navLogo'   => $navLogo,
            'footerInfo'        => $footerInfo,
            'count'     => $countcart,
            'data'      => $data,
        ]);
    }
    public function adminLogin()
    {
        return view('admin.pages.login', [
            'name'      => 'Admin Login',
            'title'     => 'Admin Login',
        ]);
    }
    public function loginProcess(Request $request)
    {
        $loginData = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if (Auth::attempt($loginData)) {
            if (Auth::user()->is_admin == 1) {
                Alert::toast('Wellcome', 'success');
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            } else {
                Alert::toast('You are not admin', 'warning');
                $request->session()->regenerate();
                return redirect()->intended('/profile');
            }
        } else {
            Alert::toast('Incorrect email or password', 'error');
            return redirect('/admin');
        }
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::toast('You are logged out', 'success');
        return redirect('/admin');
    }
}
