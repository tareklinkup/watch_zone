<footer class="footer-area footer-three-area">
    <div class="container">
        <!--== Start Footer Main ==-->
        <div class="footer-main">
            <div class="row mb-n6">
                <div class="col-md-6 col-lg-4 mb-6">
                    <div class="widget-item">
                        <h4 class="widget-title">About Us</h4>
                        <div class="widget-contact widget-contact-two">
                            <p class="widget-contact-desc me-n1">
                                {{$content->footer_text}}
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-6">
                    <div class="widget-item">
                        <h4 class="widget-title">Contact Information</h4>
                        {{-- <h4 class="widget-title widget-collapsed-title collapsed" data-bs-toggle="collapse"
                            data-bs-target="#widgetTitleId-3">
                            Store
                        </h4> --}}
                        <div class="widget-contact widget-contact-two">

                            <div class="widget-info-item mb-2">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <p>{{$content->address}}</p>
                            </div>

                            <div class="widget-info-item mb-2">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <div class="info-item-call">
                                    <a href="mailto:{{ $content->email }}"> {{$content->email}} </a>
                                </div>
                            </div>
                            <div class="widget-info-item">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <div class="info-item-call">
                                    <a href="tel://{{$content->phone_one}} "> {{$content->phone_one}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-2  mb-6">
                    <div class="widget-item">
                        <h4 class="widget-title">Quick Links</h4>
                       
                        <div  class="widget-collapse-body">
                            <ul class="widget-nav">
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li><a href="{{route('privacy.policy')}}">Privacy Policy</a></li> 
                                <li><a href="{{route('terms.condition')}}">Terms & Conditions</a></li>
                                {{-- <li><a href="#">FAQ's</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-2  mb-6">
                    <div class="widget-item">
                        <h4 class="widget-title">Account</h4>
                       
                        <div class="widget-collapse-body">
                            <ul class="widget-nav">
                                <li><a href="{{route('customer.dashboard')}}">My account</a></li>
                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#trackModal">Orders Tracking</a></li>
                                <li><a href="{{route('product.cart')}}">Cart</a></li>
                                <li><a href="{{route('warranty.policy')}}">Warranty Policy</a></li>
                            
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--== End Footer Main ==-->

    </div>
  
</footer>
  <!--== Start Footer Bottom ==-->
  <div class="footer-bottom">
    <div class="container">
        <div class="copyright ">
            <div class="copy_left">
                All Rights Researved  © {{ date('Y') }} {{$content->com_name}}. 
                
            </div>
            <div class="copy_right">
                <span>Designed Developed by : </span>  <a target="_blank" href="http://linktechbd.com/" style="color:#fff"> Link-Up Technology Ltd.</a> 
                
            </div>
        </div>
       

         
    </div>
</div>
<!--== End Footer Bottom ==-->