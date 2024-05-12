<div class="footer">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="footer-info">
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">

            <div class="footer-right">

                <div class="footer-social">
                    <div class="row">
                        <div class="col">
                            <a href="https://www.instagram.com/{{$instagram}}" target="_blank">
                                <img src="{{ asset('/assets/images/social/instagram.png') }}" alt="Instagram">
                            </a>
                        </div>
                        <div class="col">
                            <a href="https://api.whatsapp.com/send?phone={{$whatsapp}}" target="_blank">
                                <img src="{{ asset('/assets/images/social/whats.png') }}" alt="Whatsapp ">
                            </a>
                        </div>
                    </div>
                </div>
                ©{{ date('Y') }} {{ env('APP_NAME') }} TODOS OS DIREITOS RESERVADOS
            </div>
        </div>
    </div>

</div>



