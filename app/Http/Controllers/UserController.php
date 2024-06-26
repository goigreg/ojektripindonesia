<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Http\Requests\StoreuserRequest;
use App\Http\Requests\UpdateuserRequest;
use App\Models\advice;
use App\Models\booking;
use App\Models\companyprofile;
use App\Models\customTour;
use App\Models\message;
use App\Models\transactions;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $data = User::paginate(20);
        $auth = Auth::user();
        $role = $auth->role;
        $authId = $auth->id;

        return view('admin.pages.user', [
            'name'      => 'User',
            'title'     => 'User',
            'sideLogo'  => $sideLogo,
            'navLogoAdmin'          => $navlogoAdmin,
            'dashNotif' => $dashNotif,
            'messageNotif'  => $messageNotif,
            'data'      => $data,
            'role'      => $role,
            'authId'    => $authId
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
        $data = user::whereDate('created_at', '>=', $start_date)
            ->wheredate('created_at', '<=', $end_date)
            ->paginate(20);

        $auth = Auth::user();
        $role = $auth->role;
        $authId = $auth->id;

        return view('admin.pages.user', compact('data', 'start_date', 'end_date'), [
            'name'          => 'User',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'          => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
            'title'         => 'User',
            'role'          => $role,
            'authId'        => $authId
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
        $data = user::where(function ($query) use ($search) {

            $query->where('user_code', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('nationality', 'like', "%$search%")
                ->orWhere('role', 'like', "%$search%");
        })
            ->paginate(20);

        $auth = Auth::user();
        $role = $auth->role;
        $authId = $auth->id;

        return view('admin.pages.user', compact('data', 'search'), [
            'name'          => 'User',
            'title'         => 'User',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'          => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
            'role'          => $role,
            'authId'        => $authId
        ]);
    }
    public function addUserModal()
    {
        $code = User::count();
        $userCode = 'AOT' . date('ym') . $code + 1;
        return view('admin.modal.addUserModal', [
            'title'            => 'Add Admin',
            'user_code'        => $userCode,
        ]);
    }
    public function store(StoreuserRequest $request)
    {
        // emailUnique validator
        $emailUniqueValidator = Validator::make($request->all(), [
            'email'                     => 'unique:users'
        ]);
        if ($emailUniqueValidator->fails()) {
            Alert::toast('Failed, email already existed', 'error');
            return back();
        }

        $data = new user();

        $data->user_code        = $request->userCode;
        $data->name             = $request->name;
        $data->email            = $request->email;
        $data->phone            = $request->phone;
        $data->nationality      = '...';
        $data->address          = $request->address;
        $data->role             = $request->role;
        $data->is_admin         = 1;
        $data->checked          = 1;
        $data->password         = bcrypt($request->password);

        if ($request->hasFile('profilephoto')) {
            $photo    = $request->file('profilephoto');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/user'), $filename);
            $data->profile_photo = $filename;
        } else {
            $data->profile_photo = 'default.png';
        }
        $data->save();
        Alert::toast('Data successfully saved, please verify the email!', 'success');
        return redirect('/admin/user');
    }
    public function viewUser($id)
    {
        $data = user::findOrFail($id);
        $data->update([
            'checked'   => '0'
        ]);

        return view(
            'admin.modal.viewUserModal',
            [
                'title' => 'View User Data',
                'data'  => $data,
            ]
        )->render();
    }
    public function edit($id)
    {
        $data = user::findOrFail($id);

        return view(
            'admin.modal.editUserModal',
            [
                'title'     => 'Edit User Data',
                'data'      => $data,
            ]
        )->render();
    }
    public function update(UpdateuserRequest $request, user $user, $id)
    {
        $data = User::findOrFail($id);
        if ($request->email == $data->email) {
            $email = $data->email;
            $emailverified = $data->email_verified_at;
        } else {
            $validator = Validator::make($request->all(), [
                'email'                     => 'required|email:dns|unique:users',
            ]);
            if ($validator->fails()) {
                Alert::toast('Failed, email already exist', 'error');
                return back();
            }
            $email = $request->email;
            $emailverified = null;
        }

        if ($request->file('profilephoto')) {
            $photo = $request->file('profilephoto');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/user'), $filename);
            $data->profile_photo = $filename;
        } else {
            $filename = $request->profilephoto;
        }

        if ($request->password == $data->password) {
            $password = $data->password;
        } else {
            $password = bcrypt($request->password);
        }

        $field = [
            'user_code'             => $request->userCode,
            'name'                  => $request->name,
            'email'                 => $email,
            'email_verified_at'     => $emailverified,
            'address'               => $request->address,
            'phone'                 => $request->phone,
            'role'                  => $request->role,
            'profile_photo'         => $filename,
            'password'              => $password

        ];

        if ($request->email == $data->email) {
            $data::where('id', $id)->update($field);
            Alert::toast('Data successfully changed', 'success');
            return redirect('/admin/user');
        } else {
            $data::where('id', $id)->update($field);

            if (Auth::user()->id == $data->id) {
                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();
                Alert::toast('Please re-login!', 'warning');
                return redirect('/admin');
            } else {
                Alert::toast('Data successfully changed', 'success');
                return redirect('/admin/user');
            }
        }
    }
    public function destroy(user $user, $id)
    {
        $data = user::findOrFail($id);
        $data->delete();
        Alert::toast('Data successfully deleted', 'success');
        return redirect('/admin/user');
    }
}
