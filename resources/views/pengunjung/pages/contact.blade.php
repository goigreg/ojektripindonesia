@extends('pengunjung.layout.index')

@section('contents')
<div class="row d-flex contact-form justify-content-between bg-white">
    @foreach ($data as $x)    
    <div class="col-md-6 contact-logo align-content-center">
        <img src="{{asset('storage/company/'. $x->primary_logo)}}" style="width: 100%;">
    </div>
    @endforeach
    <div class="col-md-6 contact-message-form d-flex justify-content-center p-4">
        <form action="{{route('sendMessage')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="col-sm-10">
                <h4 class="text-center">Send us a message</h4>
                <div class="row mb-4">
                    <label for="name" class="col-form-label">Name<span style="color: red;">*</span></label>
                    <div>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Your name here" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="email" class="col-form-label">Email<span style="color: red;">*</span></label>
                    <div>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your email here" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="phone" class="col-form-label">Phone<span style="color: red;">*</span></label>
                    <div>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Your phone here" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="message" class="col-form-label">Your Message<span style="color: red;">*</span></label>
                    <div>
                        <textarea class="form-control" name="message" id="message" cols="30" rows="3" required></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="blank-space"></div>
@endsection