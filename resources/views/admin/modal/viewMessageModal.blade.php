<div class="modal fade" id="viewMessageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="date" class="col-sm-5 col-form-label">Date</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="date" name="date" value="{{$data->created_at->format('Y-M-d')}}" readonly>
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
                    <label for="phone" class="col-sm-5 col-form-label">Phone number</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$data->phone}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="message" class="col-sm-5 col-form-label">Message</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" name="message" id="message" cols="30" rows="5">{{$data->message}}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>