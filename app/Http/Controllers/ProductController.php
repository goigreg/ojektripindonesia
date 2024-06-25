<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Models\advice;
use App\Models\booking;
use App\Models\companyprofile;
use App\Models\customTour;
use App\Models\message;
use App\Models\transactions;
use App\Models\User;
use Illuminate\Support\Facades\Session;
// use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
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
        $data = product::paginate(15);
        return view('admin.pages.product', [
            'name'          => 'Product',
            'title'         => 'Product',
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
        $data = product::whereDate('created_at', '>=', $start_date)
            ->wheredate('created_at', '<=', $end_date)
            ->paginate(20);

        return view('admin.pages.product', compact('data', 'start_date', 'end_date'), [
            'name'          => 'Product',
            'title'         => 'Product',
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
        $data = product::where(function ($query) use ($search) {

            $query->where('package_code', 'like', "%$search%")
                ->orWhere('package_name', 'like', "%$search%")
                ->orWhere('category', 'like', "%$search%");
        })
            ->paginate(20);

        return view('admin.pages.product', compact('data', 'search'), [
            'name'          => 'Product',
            'title'         => 'Product',
            'sideLogo'      => $sideLogo,
            'navLogoAdmin'  => $navlogoAdmin,
            'dashNotif'     => $dashNotif,
            'messageNotif'  => $messageNotif,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addPackage()
    {
        $code = product::count();
        $packageCode = 'OTI' . date('ym') . $code + 1;
        return view('admin.modal.addPackageModal', [
            'title'              => 'Add Package',
            'package_code'       => $packageCode,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproductRequest $request)
    {

        $data = new product();

        $data->package_code         = $request->packageCode;
        $data->package_name         = $request->packageName;
        $data->category             = $request->category;
        $data->price                = $request->price;
        $data->child_price          = $request->chdPrice;
        $data->discount             = 0;
        $data->people_min           = $request->peopleMin;
        $data->package_desc         = $request->packageDesc;
        $data->itin_loc1            = $request->location1 ?? 'none';
        $data->itin_loc2            = $request->location2 ?? 'none';
        $data->itin_loc3            = $request->location3 ?? 'none';
        $data->itin_loc4            = $request->location4 ?? 'none';
        $data->itin_loc5            = $request->location5 ?? 'none';
        $data->itin_loc6            = $request->location6 ?? 'none';
        $data->itin_loc7            = $request->location7 ?? 'none';
        $data->itin_loc8            = $request->location8 ?? 'none';
        $data->itin_loc9            = $request->location9 ?? 'none';
        $data->itin_loc10           = $request->location10 ?? 'none';
        $data->itin_desc1           = $request->description1 ?? 'none';
        $data->itin_desc2           = $request->description2 ?? 'none';
        $data->itin_desc3           = $request->description3 ?? 'none';
        $data->itin_desc4           = $request->description4 ?? 'none';
        $data->itin_desc5           = $request->description5 ?? 'none';
        $data->itin_desc6           = $request->description6 ?? 'none';
        $data->itin_desc7           = $request->description7 ?? 'none';
        $data->itin_desc8           = $request->description8 ?? 'none';
        $data->itin_desc9           = $request->description9 ?? 'none';
        $data->itin_desc10           = $request->description10 ?? 'none';
        $data->inclusion            = $request->inclusion;
        $data->exclusion            = $request->exclusion;
        $data->note                 = $request->note;
        $data->is_active             = 1;

        if ($request->hasFile('photo1')) {
            $photo1    = $request->file('photo1');
            $filename1 = date('Ymd') . '_' . $photo1->getClientOriginalName();
            $photo1->move(public_path('storage/product'), $filename1);
            $data->package_photo1 = $filename1;
        }
        if ($request->hasFile('photo2')) {
            $photo2    = $request->file('photo2');
            $filename1 = date('Ymd') . '_' . $photo2->getClientOriginalName();
            $photo2->move(public_path('storage/product'), $filename1);
            $data->package_photo2 = $filename1;
        }
        if ($request->hasFile('photo3')) {
            $photo3    = $request->file('photo3');
            $filename1 = date('Ymd') . '_' . $photo3->getClientOriginalName();
            $photo3->move(public_path('storage/product'), $filename1);
            $data->package_photo3 = $filename1;
        }

        $data->save();
        Alert::toast('Data successfully saved', 'success');
        return redirect('/admin/product');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = product::findOrFail($id);

        return view(
            'admin.modal.editModal',
            [
                'title' => 'Edit Product Data',
                'data'  => $data,
            ]
        )->render();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductRequest $request, product $product, $id)
    {
        $data = product::findOrFail($id);

        if ($request->file('photo1')) {
            $photo1 = $request->file('photo1');
            $filename1 = date('Ymd') . '_' . $photo1->getClientOriginalName();
            $photo1->move(public_path('storage/product'), $filename1);
            $data->package_photo1 = $filename1;
        } else {
            $filename1 = $request->photo1;
        }
        if ($request->file('photo2')) {
            $photo2 = $request->file('photo2');
            $filename2 = date('Ymd') . '_' . $photo2->getClientOriginalName();
            $photo2->move(public_path('storage/product'), $filename2);
            $data->package_photo2 = $filename2;
        } else {
            $filename2 = $request->photo2;
        }
        if ($request->file('photo3')) {
            $photo3 = $request->file('photo3');
            $filename3 = date('Ymd') . '_' . $photo3->getClientOriginalName();
            $photo3->move(public_path('storage/product'), $filename3);
            $data->package_photo3 = $filename3;
        } else {
            $filename3 = $request->photo3;
        }

        $field = [
            'package_code'     => $request->packageCode,
            'package_name'     => $request->packageName,
            'category'         => $request->category,
            'price'            => $request->price,
            'child_price'      => $request->chdPrice,
            'discount'         => $request->discount ?? 0,
            'people_min'       => $request->peopleMin,
            'package_desc'     => $request->packageDesc,
            'itin_loc1'        => $request->location1 ?? 'none',
            'itin_loc2'        => $request->location2 ?? 'none',
            'itin_loc3'        => $request->location3 ?? 'none',
            'itin_loc4'        => $request->location4 ?? 'none',
            'itin_loc5'        => $request->location5 ?? 'none',
            'itin_loc6'        => $request->location6 ?? 'none',
            'itin_loc7'        => $request->location7 ?? 'none',
            'itin_loc8'        => $request->location8 ?? 'none',
            'itin_loc9'        => $request->location9 ?? 'none',
            'itin_loc10'       => $request->location10 ?? 'none',
            'itin_desc1'       => $request->description1 ?? 'none',
            'itin_desc2'       => $request->description2 ?? 'none',
            'itin_desc3'       => $request->description3 ?? 'none',
            'itin_desc4'       => $request->description4 ?? 'none',
            'itin_desc5'       => $request->description5 ?? 'none',
            'itin_desc6'       => $request->description6 ?? 'none',
            'itin_desc7'       => $request->description7 ?? 'none',
            'itin_desc8'       => $request->description8 ?? 'none',
            'itin_desc9'       => $request->description9 ?? 'none',
            'itin_desc10'      => $request->description10 ?? 'none',
            'inclusion'        => $request->inclusion,
            'exclusion'        => $request->exclusion,
            'note'             => $request->note,
            'package_photo1'   => $filename1,
            'package_photo2'   => $filename2,
            'package_photo3'   => $filename3,
            'is_active'        => 1
        ];

        $data::where('id', $id)->update($field);
        Alert::toast('Data successfully changed', 'success');
        return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product, $id)
    {
        $data = product::findOrFail($id);
        $data->delete();
        Alert::toast('Data successfully deleted', 'success');
        return redirect('/admin/product');
    }
}
