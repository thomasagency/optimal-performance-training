<!DOCTYPE html>
<html lang="en">
   <head>
      <!--Start of Google Analytics script-->
      @if ($bs->is_analytics == 1)
      {!! $bs->google_analytics_script !!}
      @endif
      <!--End of Google Analytics script-->

      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <meta name="description" content="@yield('meta-description')">
      <meta name="keywords" content="@yield('meta-keywords')">

      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{$bs->website_title}} @yield('pagename')</title>
      <!-- favicon -->
      <link rel="shortcut icon" href="{{asset('assets/front/img/'.$bs->favicon)}}" type="image/x-icon">

      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,700italic,400italic' rel='stylesheet' type='text/css'>
        <link class="gfont" href='https://fonts.googleapis.com/css?family=Lato:300,300italic,400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        <link class="gfont" href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <link class="gfont" href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic' rel='stylesheet' type='text/css'>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap&subset=cyrillic" rel="stylesheet">


      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
      <!-- plugin css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/plugin.min.css')}}">
      <!--default css-->
      <link rel="stylesheet" href="{{asset('assets/front/css/default.css')}}">
      <!-- main css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/gym-style.css')}}">
      <!-- common css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/common-style.css')}}">
      <!-- main css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/gym-responsive.css')}}">

      @if ($bs->is_tawkto == 1 || $bex->is_whatsapp == 1)
      <style>
        #scroll_up {
            right: auto;
            left: 20px;
        }
      </style>
      @endif

      @if (count($langs) == 0)
      <style media="screen">
      .support-bar-area ul.social-links li:last-child {
          margin-right: 0px;
      }
      .support-bar-area ul.social-links::after {
          display: none;
      }
      </style>
      @endif

      <!-- responsive css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
      <!-- common base color change -->
      <link href="{{url('/')}}/assets/front/css/common-base-color.php?color={{$bs->base_color}}" rel="stylesheet">
      <!-- base color change -->
      <link href="{{url('/')}}/assets/front/css/gym-base-color.php?color={{$bs->base_color}}" rel="stylesheet">


      @if ($rtl == 1)
      <!-- RTL css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/rtl.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/gym-rtl.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/pb-rtl.css')}}">
      @endif

      @yield('styles')

      <!-- jquery js -->
      <script src="{{asset('assets/front/js/jquery-3.3.1.min.js')}}"></script>

      @if ($bs->is_appzi == 1)
      <!-- Start of Appzi Feedback Script -->
      <script async src="https://app.appzi.io/bootstrap/bundle.js?token={{$bs->appzi_token}}"></script>
      <!-- End of Appzi Feedback Script -->
      @endif

      <!-- Start of Facebook Pixel Code -->
      @if ($be->is_facebook_pexel == 1)
        {!! $be->facebook_pexel_script !!}
      @endif
      <!-- End of Facebook Pixel Code -->

      <!--Start of Appzi script-->
      @if ($bs->is_appzi == 1)
      {!! $bs->appzi_script !!}
      @endif
      <!--End of Appzi script-->



    <!-- build:embed_css -->
<link rel="stylesheet" type="text/css" media="all" href="{{asset('assets/front/css/igloo.embed.min.css')}}">
    <!-- endbuild -->


    <style>html{margin:0;padding:0;width:100%;min-height:100%;background: url({{asset('assets/front/images/user/image833.jpg ')}}) repeat center center fixed;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;background-color:rgba(255, 255, 255, 0);}body {min-height:100%;}#pcon {padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;box-shadow:none;position:relative;z-index:1;}#sec_0{padding-top:53px;padding-right:0px;padding-bottom:200px;padding-left:0px;margin-top:100px;margin-right:0px;margin-bottom:0px;margin-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;box-shadow:none;position:relative;z-index:2;background:none;}#row_0{padding-top:10px;padding-right:44px;padding-bottom:10px;padding-left:44px;margin-top:27px;margin-right:0px;margin-bottom:0px;margin-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;position:relative;box-shadow:none;background-image:none;background-color:transparent;max-width:1170px;margin-left:auto;margin-right:auto;z-index:1;}#col_0{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;box-shadow:none;background-image:none;background-color:transparent;}#element_0{opacity:1;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;margin-top:69px;margin-right:0px;margin-bottom:0px;margin-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;box-shadow:none;background-image:none;background-color:transparent;}#element_image_0{text-align:center;opacity:1;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;margin-top:0px;margin-bottom:0px;font-size:0px;line-height:1;}#element_image_0 img{max-width:100%;opacity:1;width:100%;height:auto;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;box-shadow:none;}#col_1{padding-top:25px;padding-right:25px;padding-bottom:25px;padding-left:25px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:10px;border-top-right-radius:10px;border-bottom-right-radius:10px;border-bottom-left-radius:10px;box-shadow:none;background-size:cover;background-position:center center;background-repeat:no-repeat;background-color:rgba(0, 0, 0, 0.72);visibility:hidden;}#element_1{opacity:1;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;box-shadow:none;background-image:none;background-color:transparent;}#element_text_1{color:#f5fa4d;opacity:1;text-align:center;font-size:34px;line-height:120%;letter-spacing:0px;font-weight:400;text-transform:none;text-shadow:none;font-family:'Lato';}#element_2{opacity:1;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;box-shadow:none;background-image:none;background-color:transparent;}#element_text_2{color:#ffffff;opacity:1;text-align:center;font-size:22px;line-height:116%;letter-spacing:0px;font-weight:400;text-transform:none;text-shadow:none;font-family:'Shadows Into Light';}#element_3{opacity:1;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;box-shadow:none;background-image:none;background-color:transparent;}#element_email_3{width:100%;display:block;margin:0 auto;width:100%;text-align:center;}#element_email_3 > .frm_email, #element_email_3 > .frm_lastname{width:100%;margin-top: 10px;}#element_email_3 > .frm_custom {margin-top:10px;}#element_email_3 > .frm_custom:first {margin-top:0px;}#element_email_3 > .frm_name input, #element_email_3 > .frm_email input, #element_email_3 > .frm_custom input{width:100%;line-height:100%;font-family:'Open Sans';color:#000000;text-align:center;font-weight:400;font-style:normal;font-size:20px;letter-spacing:0px;text-transform:none;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-style:solid;border-color:#d0d0d0;border-top-left-radius:6px;border-top-right-radius:6px;border-bottom-right-radius:6px;border-bottom-left-radius:6px;box-shadow:none;text-shadow:none;background-image:none;background-color:#f0f0f0;}#element_email_3 > .frm_btn{display:inline-block;overflow:hidden;cursor:pointer;width: 482px;text-align: center;padding-top: 16px;padding-right: 30px;padding-bottom: 16px;padding-left: 30px;margin-top: 15px;border-top-width: 2px;border-right-width: 2px;border-bottom-width: 2px;border-left-width: 2px;border-style: solid;border-color: #ffffff;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-right-radius:5px;border-bottom-left-radius:5px;box-shadow:none;background-image:none;background-color:rgba(215, 57, 57, 0);}#element_email_btn_icon_3{vertical-align:middle;color:#fff;line-height:100%;text-shadow:none;margin-right:5px;font-size:26px;}#element_email_3 > .frm_btn > .frm_btn_cont{display:inline-block;vertical-align:middle;color:#ffffff;font-weight:400;font-style:normal;font-size:26px;line-height:100%;letter-spacing:0px;text-transform:none;font-family:'Lato';text-shadow:none;}#element_email_3 > .frm_thankyou{display:none;width:100%;margin-top: 0px;color: #000000;font-family:'Open Sans';text-align: center;font-weight: 400;font-style: normal;font-size: 20px;line-height: 120%;letter-spacing: 0px;text-transform: none;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;border-top-width: 0px;border-right-width: 0px;border-bottom-width: 0px;border-left-width: 0px;border-style: solid;border-color: #d0d0d0;border-top-left-radius:6px;border-top-right-radius:6px;border-bottom-right-radius:6px;border-bottom-left-radius:6px;box-shadow:none;text-shadow:none;background:none;}#element_4{opacity:1;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-style:solid;border-color:#000000;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;box-shadow:none;background-image:none;background-color:transparent;}#element_text_4{color:#a6a6a6;opacity:1;text-align:center;font-size:13px;line-height:120%;letter-spacing:0px;font-weight:100;text-transform:none;text-shadow:none;font-family:'Lato';}</style>



    <script>
        var id = 104198;
        var animations = {"element_0":{"loop":{"effect":"","speed":50},"element_type":"image","css":{"opacity":1}},"col_1":{"enter":{"effect":"enter.zoomInRotate","time":"2","start":"visible","delay":0},"cue":{"effect":"cue.shakeSoft","time":1,"delay":0,"repeat":0,"repeatDelay":0},"css":{"opacity":1}},"element_1":{"element_type":"text","css":{"opacity":1}},"element_2":{"element_type":"text","css":{"opacity":1}},"element_3":{"element_type":"email","css":{"opacity":1}},"element_4":{"element_type":"text","css":{"opacity":1}}};
        var actions = [];
        var countdowns = [];
        var forms = {"element_email_3":{"index":3,"id":null,"platform":"igloo","list":null,"custom_field":null,"use_name":true,"name_required":false,"redirect":true,"redirect_url":" {{route('front.subscribe')}} ","redirect_target":"_self","close_popup":null,"contest":null}};
        var parallax = [];
        var popups = [];
        var sticky = [];
        var settings = {"force100Height":true,"audio":[],"exit_sound":null};
        var api_url = "https://launchigloo.com/api/";
    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>
    <!-- build:embed_js -->
    <script type="text/javascript" src="{{asset('assets/front/js/igloo.embed.min.js')}}"></script>
    <!-- endbuild -->


    <script type="text/javascript" src="https://chatterpal.me/build/js/chatpal.js?8.2" crossorigin="anonymous" data-cfasync="false"></script>
<script>
var chatPal = new ChatPal({embedId: 'UJst4ue7VKLj', remoteBaseUrl: 'https://chatterpal.me/', version: '8.2'});
</script>


   </head>



   <body @if($rtl == 1) dir="rtl" @endif>


    <!-- Start finlance_header area -->
    @includeIf('front.gym.partials.navbar')
    <!-- End finlance_header area -->

    @if (!request()->routeIs('front.index') && !request()->routeIs('front.packageorder.confirmation'))
        <!--   breadcrumb area start   -->
        <div class="breadcrumb-area cases lazy" data-bg="{{asset('assets/front/img/' . $bs->breadcrumb)}}" style="background-size:cover;">
            <div class="container">
            <div class="breadcrumb-txt">
                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-sm-10">
                        <span>@yield('breadcrumb-title')</span>
                        <h1>@yield('breadcrumb-subtitle')</h1>
                        <ul class="breadcumb">
                        <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                        <li>@yield('breadcrumb-link')</li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
            <div class="breadcrumb-area-overlay" style="background-color: #{{$be->breadcrumb_overlay_color}};opacity: {{$be->breadcrumb_overlay_opacity}};"></div>
        </div>
        <!--   breadcrumb area end    -->
    @endif

    @yield('content')


    <!--    announcement banner section start   -->
    <a class="announcement-banner" href="{{asset('assets/front/img/'.$bs->announcement)}}"></a>
    <!--    announcement banner section end   -->


		<!-- Start finlance_footer section -->
		<footer class="finlance_footer footer_v1 dark_bg">
            @if (!($bex->home_page_pagebuilder == 0 && $bs->top_footer_section == 0))
			<div class="footer_top pt-120 pb-120">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-sm-12">
							<div class="widget_box about_widget">
                                <a href="{{route('front.index')}}">
                                    <img class="lazy" data-src="{{asset('assets/front/img/'.$bs->footer_logo)}}" alt="">
                                </a>
								<p>
                                    @if (strlen(convertUtf8($bs->footer_text)) > 170)
                                       {{substr(convertUtf8($bs->footer_text), 0, 170)}}<span style="display: none;">{{substr(convertUtf8($bs->footer_text), 170)}}</span>
                                       <a href="#" class="see-more">{{__('see more')}}...</a>
                                    @else
                                       {{convertUtf8($bs->footer_text)}}
                                    @endif
                                </p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-12">
							<div class="widget_box contact_widget">
								<h4 class="widget_title">{{__('Contact Us')}}</h4>
								<p>
                                    <span class="base-color"><i class="fas fa-map-marker-alt"></i></span>
                                    @php
                                    $addresses = explode(PHP_EOL, $bex->contact_addresses);
                                    @endphp

                                    @foreach ($addresses as $address)
                                        {{$address}}
                                        @if (!$loop->last)
                                            |
                                        @endif
                                    @endforeach
                                </p>
								<p>
                                    <span class="base-color">{{__('Phone')}}:</span>
                                    @php
                                    $phones = explode(',', $bex->contact_numbers);
                                    @endphp

                                    @foreach ($phones as $phone)
                                        {{$phone}}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
								<p>
                                    <span class="base-color">{{__('Email')}}:</span>
                                    @php
                                        $mails = explode(',', $bex->contact_mails);
                                    @endphp
                                    @foreach ($mails as $mail)
                                        {{$mail}}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-12">
							<div class="widget_box">
								<h4 class="widget_title">{{__('Useful Links')}}</h4>
								<ul class="widget_link">
                                    @foreach ($ulinks as $key => $ulink)
                                        <li><a href="{{$ulink->url}}">{{convertUtf8($ulink->name)}}</a></li>
                                    @endforeach
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-12">
							<div class="widget_box newsletter_box">
								<h4 class="widget_title">{{__('Newsletter')}}</h4>
								<p>{{convertUtf8($bs->newsletter_text)}}</p>
								<form id="footerSubscribeForm" action="{{route('front.subscribe')}}" method="post">
                                    @csrf


								<div class="form_group">

                    
                    <input type="text" class="form_control" placeholder="{{__('Enter Name')}}" name="name" required>

                    <p id="errname" class="text-danger mb-0 err-name"></p>



					<input type="email" class="form_control" placeholder="{{__('Enter Email Address')}}" name="email" required>

                    <p id="erremail" class="text-danger mb-0 err-email"></p>


					<button type="submit" class="finlance_btn py-0">{{__('Subscribe')}}</button>
									
                                    </div>


								</form>
							</div>
						</div>
					</div>
				</div>
            </div>
            @endif


            @if (!($bex->home_page_pagebuilder == 0 && $bs->copyright_section == 0))
			<div class="footer_bottom">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="copyright_text">
								<p>{!! replaceBaseUrl(convertUtf8($bs->copyright_text)) !!}</p>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="social_box">
								<ul>
                                    @foreach ($socials as $key => $social)
                                        <li><a target="_blank" href="{{$social->url}}"><i class="{{$social->icon}}"></i></a></li>
                                    @endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
            @endif
		</footer><!-- End finlance_footer section -->

        @if ($bex->is_shop == 1 && $bex->catalog_mode == 0)
            <div id="cartIconWrapper">
                <a class="d-block" id="cartIcon" href="{{route('front.cart')}}">
                    <div class="cart-length">
                        <i class="fas fa-cart-plus"></i>
                        <span class="length">{{cartLength()}} {{__('ITEMS')}}</span>
                    </div>
                    <div class="cart-total">
                        {{$bex->base_currency_symbol_position == 'left' ? $bex->base_currency_symbol : ''}}
                        {{cartTotal()}}
                        {{$bex->base_currency_symbol_position == 'right' ? $bex->base_currency_symbol : ''}}
                    </div>
                </a>
            </div>
        @endif


    <!--====== PRELOADER PART START ======-->
    @if ($bex->preloader_status == 1)
    <div id="preloader">
        <div class="loader revolve">
            <img src="{{asset('assets/front/img/' . $bex->preloader)}}" alt="">
        </div>
    </div>
    @endif
    <!--====== PRELOADER PART ENDS ======-->

    <!--Scroll-up-->
    <a id="scroll_up" ><i class="fas fa-angle-up"></i></a>

    {{-- WhatsApp Chat Button --}}
    <div id="WAButton"></div>


    {{-- Cookie alert dialog start --}}
    @if ($be->cookie_alert_status == 1)
    @include('cookieConsent::index')
    @endif
    {{-- Cookie alert dialog end --}}

    {{-- Popups start --}}
    @includeIf('front.partials.popups')
    {{-- Popups end --}}

      @php
        $mainbs = [];
        $mainbs = json_encode($mainbs);
      @endphp
      <script>
        var mainbs = {!! $mainbs !!};
        var mainurl = "{{url('/')}}";
        var vap_pub_key = "{{env('VAPID_PUBLIC_KEY')}}";

        var rtl = {{ $rtl }};
      </script>
      <!-- popper js -->
      <script src="{{asset('assets/front/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
      <!-- Plugin js -->
      <script src="{{asset('assets/front/js/plugin.min.js')}}"></script>

      <!-- main js -->
      <script src="{{asset('assets/front/js/gym-main.js')}}"></script>
      <!-- pagebuilder custom js -->
      <script src="{{asset('assets/front/js/common-main.js')}}"></script>

      {{-- whatsapp init code --}}
      @if ($bex->is_whatsapp == 1)
        <script type="text/javascript">
            var whatsapp_popup = {{$bex->whatsapp_popup}};
            var whatsappImg = "{{asset('assets/front/img/whatsapp.svg')}}";
            $(function () {
                $('#WAButton').floatingWhatsApp({
                    phone: "{{$bex->whatsapp_number}}", //WhatsApp Business phone number
                    headerTitle: "{{$bex->whatsapp_header_title}}", //Popup Title
                    popupMessage: `{!! nl2br($bex->whatsapp_popup_message) !!}`, //Popup Message
                    showPopup: whatsapp_popup == 1 ? true : false, //Enables popup display
                    buttonImage: '<img src="' + whatsappImg + '" />', //Button Image
                    position: "right" //Position: left | right

                });
            });
        </script>
      @endif

      @yield('scripts')

      @if (session()->has('success'))
      <script>
         toastr["success"]("{{__(session('success'))}}");
      </script>
      @endif

      @if (session()->has('error'))
      <script>
         toastr["error"]("{{__(session('error'))}}");
      </script>
      @endif

      <!--Start of subscribe functionality-->
      <script>
        $(document).ready(function() {
          $("#subscribeForm, #footerSubscribeForm").on('submit', function(e) {
            // console.log($(this).attr('id'));

            e.preventDefault();

            let formId = $(this).attr('id');
            let fd = new FormData(document.getElementById(formId));
            let $this = $(this);

            $.ajax({
              url: $(this).attr('action'),
              type: $(this).attr('method'),
              data: fd,
              contentType: false,
              processData: false,
              success: function(data) {
                // console.log(data);
                if ((data.errors)) {
                  $this.find(".err-email").html(data.errors.email[0]);
                } else {
                  toastr["success"]("You are subscribed successfully!");
                  $this.trigger('reset');
                  $this.find(".err-email").html('');
                }
              }
            });
          });

            // lory slider responsive
            $(".gjs-lory-frame").each(function() {
                let id = $(this).parent().attr('id');
                $("#"+id).attr('style', 'width: 100% !important');
            });
        });
      </script>
      <!--End of subscribe functionality-->

      <!--Start of Tawk.to script-->
      @if ($bs->is_tawkto == 1)
      {!! $bs->tawk_to_script !!}
      @endif
      <!--End of Tawk.to script-->

      <!--Start of AddThis script-->
      @if ($bs->is_addthis == 1)
      {!! $bs->addthis_script !!}
      @endif
      <!--End of AddThis script-->
   </body>
</html>
