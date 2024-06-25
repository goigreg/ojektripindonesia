<footer>
    <div class="row col-md-12 footer-container">
        <div class="col-md-4 footer-content text-center mt-4">
            <h3>Contact Us</h3>
            @foreach ($footerInfo as $x)
                <p>Email  :<br> {{$x->main_email}}</p>
                <p>Phone  :<br> {{$x->main_phone}}</p>
                <p>Address:<br> {{$x->address}}</p>
            @endforeach
        </div>
        <div class="col-md-4 footer-content mt-4">
            <h3>Quick Links</h3>
            <ul class="list">
                <li><a href="/">Home</a></li>
                <li><a href="/tours">Tours</a></li>
                <li><a href="/rentals">Rentals</a></li>
                <li><a href="/about_us">About Us</a></li>
            </ul>
        </div>
        <div class="col-md-4 footer-content mt-4">
            <h3>Find Us</h3>
            <ul class="social-icons">
                <li><a href="https://www.instagram.com/ojek_tripindonesia/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="https://web.facebook.com/profile.php?id=100091928727820" target="_blank"><i class="fa-brands fa-square-facebook"></i></a></li>
                <li><a href="https://www.youtube.com/@ojektripbali2855" target="_blank"><i class="fa-brands fa-square-youtube"></i></a></li>
                <li><a href="https://wa.link/s923mu" target="_blank"><i class="fa-brands fa-square-whatsapp"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="bottom-bar">
        <p>Copyright &copy; 2024 Ojek Trip Indonesia. All right reserved.</p>
    </div>
</footer>