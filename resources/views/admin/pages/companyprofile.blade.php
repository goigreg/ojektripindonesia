@extends('admin.layout.index')

@section('content')
<div class="card mb-4">
    @foreach ($data as $x)
        <form action="{{route('updateCompanyProfile', $x->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="col-md-12 c-profile-card">        
                <div class="col-md-6 primary-logo">
                    <div class="primary-logo-img">
                        <img src="{{asset('storage/company/'.$x->primary_logo)}}" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <h6 class="text-center d-inline-block pt-2">Primary Logo</h6>
                        <button type="button" class="btn p-0 edit-primary-logo d-inline-block" onclick="pLogo(0)"><span class="material-icons" style="padding: 3px">edit</span></button>
                    </div>
                    <div class="mt-4 mx-auto w-50" id="input-pLogo" style="display: none">
                        <input type="hidden" class="form-control" name="primaryLogo" value="{{$x->primary_logo}}">
                        <input type="file" class="form-control" accept=".png, .jpg, .jpeg" name="primaryLogo" id="primary-logo">
                        <div class="d-flex justify-content-end mt-1 gap-2">
                            <button type="submit" class="btn btn-primary" id="bSave-pLogo">Save</button>
                            <button type="button" class="btn btn-danger" id="bCancle-pLogo" onclick="pLogo(1)">Cancel</button> 
                        </div>
                    </div>
                </div>
                <div class="col-md-6 secondary-logo">
                    <div class="secondary-logo-img">
                        <img src="{{asset('storage/company/'.$x->secondary_logo)}}" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <h6 class="text-center d-inline-block pt-2">Secondary Logo</h6>
                        <button type="button" class="btn p-0 edit-secondary-logo d-inline-block" onclick="sLogo(0)"><span class="material-icons" style="padding: 3px">edit</span></button>
                    </div>
                    <div class="mt-4 mx-auto w-50" id="input-sLogo" style="display: none">
                        <input type="hidden" class="form-control" name="secondaryLogo" value="{{$x->secondary_logo}}">
                        <input type="file" class="form-control" accept=".png, .jpg, .jpeg" name="secondaryLogo" id="secondary-logo">
                        <div class="d-flex justify-content-end mt-1 gap-2">
                            <button type="submit" class="btn btn-primary" id="bSave-sLogo">Save</button>
                            <button type="button" class="btn btn-danger" id="bCancle-sLogo" onclick="sLogo(1)">Cancel</button> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-company">
                <hr>
                <div class="d-flex justify-content-center">
                    <h6 class="text-center d-inline-block pt-2">About Company</h6>
                    <button type="button" class="btn p-0 btn-aboutCompany d-inline-block" id="btn-about-company" onclick="about(0)"><span class="material-icons" style="padding: 3px">edit</span></button>
                </div>
                <div class="mt-4" id="tArea-about" style="display: none">
                    <textarea class="form-control" name="aboutCompany" id="about-company" cols="30" rows="10">{{$x->about_company}}</textarea>
                    <div class="d-flex justify-content-end mt-1 gap-2">
                        <button type="submit" class="btn btn-primary" id="bSave-about">Save</button>
                        <button type="button" class="btn btn-danger" id="bCancle-about" onclick="about(1)">Cancel</button> 
                    </div>
                </div>
                <div class="mt-4" id="p-about">
                    <p>{!! $x->about_company !!}</p>
                </div>
            </div>
            <div class="vision">
                <hr>
                <div class="d-flex justify-content-center">
                    <h6 class="text-center d-inline-block pt-2">Vision</h6>
                    <button type="button" class="btn p-0 btn-vision d-inline-block" id="btn-vision" onclick="vision1(0)"><span class="material-icons" style="padding: 3px">edit</span></button>
                </div>
                <div class="mt-4" id="tArea-vision" style="display: none">
                    <textarea class="form-control" name="vision" id="vision" cols="30" rows="10">{{$x->vision}}</textarea>
                    <div class="d-flex justify-content-end mt-1 gap-2">
                        <button type="submit" class="btn btn-primary" id="bSave-vision">Save</button>
                        <button type="button" class="btn btn-danger" id="bCancle-vision" onclick="vision1(1)">Cancel</button> 
                    </div>
                </div>
                <div class="mt-4" id="p-vision">
                    <p>{!! $x->vision !!}</p>
                </div>
            </div>
            <div class="mission">
                <hr>
                <div class="d-flex justify-content-center">
                    <h6 class="text-center d-inline-block pt-2">Mission</h6>
                    <button type="button" class="btn p-0 btn-mission d-inline-block" id="btn-mission" onclick="mission1(0)"><span class="material-icons" style="padding: 3px">edit</span></button>
                </div>
                <div class="mt-4" id="tArea-mission" style="display: none">
                    <textarea class="form-control" name="mission" id="mission" cols="30" rows="10">{{$x->mission}}</textarea>
                    <div class="d-flex justify-content-end mt-1 gap-2">
                        <button type="submit" class="btn btn-primary" id="bSave-mission">Save</button>
                        <button type="button" class="btn btn-danger" id="bCancle-mission" onclick="mission1(1)">Cancel</button> 
                    </div>
                </div>
                <div class="mt-4" id="p-mission">
                    <p>{!! $x->mission !!}</p>
                </div>
            </div>
            <div class="company-email">
                <hr>
                <div class="d-flex justify-content-center">
                    <h6 class="text-center d-inline-block pt-2">Email</h6>
                    <button type="button" class="btn p-0 btn-email d-inline-block" id="btn-email" onclick="email(0)"><span class="material-icons" style="padding: 3px">edit</span></button>
                </div>
                <div class="mt-4" id="tArea-email" style="display: none">
                    <label for="main-email" class="col-form-label">Main Email</label>
                    <input type="email" class="form-control" name="mainEmail" id="main-email" value="{{$x->main_email}}">
                    <label for="other-email" class="col-form-label mt-2">Other Email</label>
                    <textarea class="form-control" name="otherEmail" id="other-email" cols="30" rows="10">{{$x->other_email}}</textarea>
                    <div class="d-flex justify-content-end mt-1 gap-2">
                        <button type="submit" class="btn btn-primary" id="bSave-email">Save</button>
                        <button type="button" class="btn btn-danger" id="bCancle-email" onclick="email(1)">Cancel</button> 
                    </div>
                </div>
                <div class="mt-4 w-50 m-auto" id="p-email">
                    <p><ol>{{$x->main_email}}</ol> {!! $x->other_email !!}</p>
                </div>
            </div>
            <div class="company-phone">
                <hr>
                <div class="d-flex justify-content-center">
                    <h6 class="text-center d-inline-block pt-2">Phone</h6>
                    <button type="button" class="btn p-0 btn-phone d-inline-block" id="btn-phone" onclick="phone(0)"><span class="material-icons" style="padding: 3px">edit</span></button>
                </div>
                <div class="mt-4" id="tArea-phone" style="display: none">
                    <label for="main-phone" class="col-form-label">Main Phone</label>
                    <input type="text" class="form-control" name="mainPhone" id="main-phone" value="{{$x->main_phone}}">
                    <label for="other-phone" class="col-form-label mt-2">Other phone</label>
                    <textarea class="form-control" name="otherPhone" id="other-phone" cols="30" rows="10">{{$x->other_phone}}</textarea>
                    <div class="d-flex justify-content-end mt-1 gap-2">
                        <button type="submit" class="btn btn-primary" id="bSave-phone">Save</button>
                        <button type="button" class="btn btn-danger" id="bCancle-phone" onclick="phone(1)">Cancel</button> 
                    </div>
                </div>
                <div class="mt-4 w-25 m-auto" id="p-phone">
                    <p><ol>{{$x->main_phone}}</ol> {!! $x->other_phone !!}</p>
                </div>
            </div>
            <div class="company-address mb-5">
                <hr>
                <div class="d-flex justify-content-center">
                    <h6 class="text-center d-inline-block pt-2">Address</h6>
                    <button type="button" class="btn p-0 btn-address d-inline-block" id="btn-address" onclick="address1(0)"><span class="material-icons" style="padding: 3px">edit</span></button>
                </div>
                <div class="mt-4" id="tArea-address" style="display: none">
                    <input type="text" class="form-control" name="address" id="address" value="{{$x->address}}">
                    <div class="d-flex justify-content-end mt-1 gap-2">
                        <button type="submit" class="btn btn-primary" id="bSave-address">Save</button>
                        <button type="button" class="btn btn-danger" id="bCancle-address" onclick="address1(1)">Cancel</button> 
                    </div>
                </div>
                <div class="mt-4" id="p-address">
                    <p>{{$x->address}}</p>
                </div>
            </div>
        </form>    
    @endforeach
</div>
<script>
    function pLogo(x){
        if (x == 0) document.getElementById("input-pLogo").style.display = "block";
        else document.getElementById("input-pLogo").style.display = "none";
        return;
    }
    function sLogo(x){
        if (x == 0) document.getElementById("input-sLogo").style.display = "block";
        else document.getElementById("input-sLogo").style.display = "none";
        return;
    }
    function about(x){
        if (x == 0) document.getElementById("tArea-about").style.display = "block",
                    document.getElementById("p-about").style.display = "none";
        else document.getElementById("tArea-about").style.display = "none",
             document.getElementById("p-about").style.display = "block";
        return;
    }
    function vision1(x){
        if (x == 0) document.getElementById("tArea-vision").style.display = "block",
                    document.getElementById("p-vision").style.display = "none";
        else document.getElementById("tArea-vision").style.display = "none",
             document.getElementById("p-vision").style.display = "block";
        return;
    }
    function mission1(x){
        if (x == 0) document.getElementById("tArea-mission").style.display = "block",
                    document.getElementById("p-mission").style.display = "none";
        else document.getElementById("tArea-mission").style.display = "none",
             document.getElementById("p-mission").style.display = "block";
        return;
    }
    function email(x){
        if (x == 0) document.getElementById("tArea-email").style.display = "block",
                    document.getElementById("p-email").style.display = "none";
        else document.getElementById("tArea-email").style.display = "none",
             document.getElementById("p-email").style.display = "block";
        return;
    }
    function phone(x){
        if (x == 0) document.getElementById("tArea-phone").style.display = "block",
                    document.getElementById("p-phone").style.display = "none";
        else document.getElementById("tArea-phone").style.display = "none",
             document.getElementById("p-phone").style.display = "block";
        return;
    }
    function address1(x){
        if (x == 0) document.getElementById("tArea-address").style.display = "block",
                    document.getElementById("p-address").style.display = "none";
        else document.getElementById("tArea-address").style.display = "none",
             document.getElementById("p-address").style.display = "block";
        return;
    }
    // =============CKEditor for the text area========
    ClassicEditor
		.create( document.querySelector( '#about-company' ) )
		.catch( error => {
			console.error( error );
		} );
    ClassicEditor
		.create( document.querySelector( '#vision' ) )
		.catch( error => {
			console.error( error );
		} );
    ClassicEditor
		.create( document.querySelector( '#mission' ) )
		.catch( error => {
			console.error( error );
		} );
    ClassicEditor
		.create( document.querySelector( '#other-email' ) )
		.catch( error => {
			console.error( error );
		} );
    ClassicEditor
		.create( document.querySelector( '#other-phone' ) )
		.catch( error => {
			console.error( error );
		} );
</script>
@endsection