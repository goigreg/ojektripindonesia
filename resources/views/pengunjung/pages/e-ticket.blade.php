<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/custom.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('js/custom.js')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Ojek Trip Indonesia I {{$title}}</title>
</head>
<body>
    <main>
        <div class="ticket-container">
            <div class="ticket-card">
                <div class="ticket-header">
                    <div class="ticket-left-header">
                        <div class="ticket-logo">
                            <img src="{{asset('storage/company/' . $logo)}}" alt="">
                            <h6><i class="fa-solid fa-location-dot"></i> {{$address}}</h6>
                        </div>
                    </div>
                    <div class="ticket-right-header">
                        <div class="ticket-number">
                            <h4>No: {{$ticket->ticket_number}}</h4>
                            <h5>Booking date: {{$bookDate->format('Y-m-d')}}</h5>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="ticket-body">
                    <div class="ticket-booking-code">
                        <div>
                            <p><strong>Booking Code:</strong></p>
                        </div>
                        <div>
                            <h5>{{$ticket->booking_code}}</h5>
                        </div>
                    </div>
                    <div class="ticket-book-det-header">
                        <h5>Booking Details</h5>
                        <div class="ticket-book-det-data">
                            <div class="ticket-labels">
                                <p>Name</p>
                            </div>
                            <div class="ticket-data">
                                <p>: {{$ticket->name}}</p>
                            </div>
                        </div>
                        <div class="ticket-book-det-data">
                            <div class="ticket-labels">
                                <p>Number Of People</p>
                            </div>
                            <div class="ticket-data">
                                <p>: {{$numberOfPeople}} people</p>
                            </div>
                        </div>
                        <div class="ticket-book-det-data">
                            <div class="ticket-labels">
                                <p>Package Name</p>
                            </div>
                            <div class="ticket-data">
                                <p>: {{$ticket->package_name}}</p>
                            </div>
                        </div>
                        <div class="ticket-book-det-data">
                            <div class="ticket-labels">
                                <p>Departure Date</p>
                            </div>
                            <div class="ticket-data">
                                <p>: {{$ticket->departure_date}}</p>
                            </div>
                        </div>
                        <hr>
                        <h5>Payment Details</h5>
                        <table class="ticket-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Number Of People</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Adult</th>
                                    <td>{{$ticket->number_of_adult}}</td>
                                    <td>IDR {{number_format($adultPrice)}}</td>
                                </tr>
                                <tr>
                                    <th>Child</th>
                                    <td>{{$ticket->number_of_child}}</td>
                                    <td>IDR {{number_format($childPrice)}}</td>
                                </tr>
                                <tr>
                                    <th>Infant</th>
                                    <td>{{$ticket->number_of_infant}}</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Price Total</th>
                                    <th>IDR {{number_format($priceTotal)}}</th>
                                </tr>
                                <tr>
                                    <th colspan="2">Payment Total</th>
                                    @if ($paymentTotal < $priceTotal)
                                    <th class="ticket-not-paid">IDR {{number_format($paymentTotal)}}</th>
                                    @else
                                    <th>IDR {{number_format($paymentTotal)}}</th>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div>
                            <p><strong>Note:</strong><br>{!! $ticket->note !!}</p>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('sweetalert::alert')
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
</html>