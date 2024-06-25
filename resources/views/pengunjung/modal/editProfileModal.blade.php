<div class="modal fade" id="editProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('updateProfile', $data->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="col-sm-12">
                            <div class="photoPrev-box">
                                <input type="hidden" name="profilephoto" value="{{$data->profile_photo}}">
                                <img src="{{asset('storage/user/'.$data->profile_photo)}}" class="mb-2 photoPreview">
                                <input type="file" class="form-control" accept=".png, .jpg, .jpeg" id="profile_photo" 
                                name="profilephoto" onchange="previewImg()" style="visibility: hidden">
                            </div>
                            <hr>
                            <label for="profile_photo" class="btn btn-primary m-auto d-flex gap-2 fs-6" style="width:80px; text-align:center; background-color: #36c3bb; border:0"><i class="fa-solid fa-upload"></i>Up</label>
                        </div>                        
                    </div>
                    <div class="mb-3 row">
                        <input type="hidden" class="form-control-plaintext" id="user_code" name="userCode" value="{{$data->user_code}}" readonly>
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
                        <label for="phone" class="col-sm-5 col-form-label">Phone number</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$data->phone}}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nationality" class="col-sm-5 col-form-label">Nationality</label>
                        <div class="col-sm-7">
                            @if ($data->nationality == '...')
                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Your nationality here">
                            @else
                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{$data->nationality}}" required>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-5 col-form-label">Address</label>
                        <div class="col-sm-7">
                            @if ($data->address == '...')
                                <input type="text" class="form-control" id="address" name="address" placeholder="Your address here">
                            @else
                                <input type="text" class="form-control" id="address" name="address" value="{{$data->address}}" required>
                            @endif
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
        const preview = document.querySelector('.photoPreview');

        preview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(photo.files[0]);

        oFReader.onload = function(oFREven){
            preview.src = oFREven.target.result;
        }
    }
</script>