<div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('updateUserData', $data->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
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
                            <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-5 col-form-label">Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="email" name="email" value="{{$data->email}}" required autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-5 col-form-label">Address</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="address" name="address" value="{{$data->address}}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone" class="col-sm-5 col-form-label">Phone number</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$data->phone}}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="role" class="col-sm-5 col-form-label">Role</label>
                        <div class="col-sm-7">
                            @if (Auth::user()->role === 'manager')                                
                                <select type="text" class="form-control" id="role" name="role" required>
                                    <option value="admin" {{$data->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="manager" {{$data->role === 'manager' ? 'selected' : '' }}>Manager</option>
                                </select>
                            @else                                
                                <select type="text" class="form-control" id="role" name="role" required>
                                    <option value="admin" {{$data->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="profile_photo" class="col-sm-5 col-form-label">Profile photo</label>
                        <div class="col-sm-7">
                            <input type="hidden" name="profilephoto" value="{{$data->profile_photo}}">
                            <img src="{{asset('storage/user/'.$data->profile_photo)}}" class="mb-2 adminPhotoPreview">
                            <input type="file" class="form-control" accept=".png, .jpg, .jpeg" id="profile_photo" 
                            name="profilephoto" onchange="previewImg()">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-5 col-form-label">Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="password" name="password" value="{{$data->password}}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function previewImg() {
        const photo = document.querySelector('#profile_photo');
        const preview = document.querySelector('.adminPhotoPreview');

        preview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(photo.files[0]);

        oFReader.onload = function(oFREven){
            preview.src = oFREven.target.result;
        }
    }
</script>