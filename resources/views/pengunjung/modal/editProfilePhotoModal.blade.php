<div class="modal fade" id="editProfilePhotoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('updateProfilePhoto', $data->id)}}" method="POST" enctype="multipart/form-data">
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
                            <label for="profile_photo" class="btn btn-primary w-25 m-auto d-flex gap-2 fs-6" style="background-color: #36c3bb; border:0"><i class="fa-solid fa-upload"></i>Up</label>
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