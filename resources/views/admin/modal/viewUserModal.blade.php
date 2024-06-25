<div class="modal fade" id="viewUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="user-code" class="col-sm-5 col-form-label">User Code</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control-plaintext" id="user-code" name="userCode" value="{{$data->user_code}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-5 col-form-label">Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-5 col-form-label">Email</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="email" name="email" value="{{$data->email}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nationality" class="col-sm-5 col-form-label">Nationality</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="nationality" name="nationality" value="{{$data->nationality}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="address" class="col-sm-5 col-form-label">Address</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="address" name="address" value="{{$data->address}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="phone" class="col-sm-5 col-form-label">Phone number</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$data->phone}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="role" class="col-sm-5 col-form-label">Role</label>
                    <div class="col-sm-7">                                  
                        <input type="text" class="form-control" id="role" name="role" value="Member" readonly>                        
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="profile_photo" class="col-sm-5 col-form-label">Profile photo</label>
                    <div class="col-sm-7">
                        <img src="{{asset('storage/user/'.$data->profile_photo)}}" class="mb-2 adminPhotoPreview">
                        <input type="text" class="form-control mt-2" name="profilephoto" value="{{$data->profile_photo}}" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>