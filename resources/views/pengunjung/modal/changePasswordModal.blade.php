<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('updatePassword', $data->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">                   
                    <div class="mb-3 row">
                        <label for="current_password" class="col-sm-5 col-form-label">Current Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="currentPassword" id="current_password" placeholder="Current password" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="new_password" class="col-sm-5 col-form-label">New Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="newPassword" id="new_password" placeholder="Password min 6 characters" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-sm-5 col-form-label">New Password Confirmation</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="newPasswordConfirmation" id="new_password_confirmation" placeholder="Confirm your new password" required>
                        </div>
                    </div>                    
                    <hr>
                    <div class="justify-content-center col-sm-12 mb-2 text-center">
                        <button type="submit" class="btn btn-success"style="width: 150px;">Submit</button>
                    </div>
                </div>            
            </form>
        </div>
    </div>
</div>
<script>
    $('#changePasswordModal').on('shown.bs.modal', function () {
    $('#current_password').focus()
    })
</script>