<!DOCTYPE html>
<html lang="en">
 <head>
  <base href="{{ $assetBase }}">
  <link href="css/video-js.css" rel="stylesheet"/>
  @php
    try { $leadSettings = app(\App\Settings\LeadCaptureSettings::class); } catch (\Throwable $e) { $leadSettings = null; }
    $resolvedIsoRaw = strtoupper(request()->attributes->get('resolved_iso') ?? request('__country', request('geo', '')) ?? 'PH');
    $computedIso = $resolvedIsoRaw;
    $forceCountry = false;
    if ($leadSettings && ($leadSettings->country_auto_adjust_enabled ?? true) === false) {
        $computedIso = strtoupper($leadSettings->priority_country ?? 'GB');
        $forceCountry = true;
    }
  @endphp
  <meta content="{{ $computedIso }}" name="isoCode"/>
  <meta content="{{ $forceCountry ? '1' : '0' }}" name="forceCountry"/>
  <meta charset="utf-8"/>
  <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
  <title>
   Trader Ai ™ – The Official Site
  </title>
  <meta content="Trader Ai Crypto Trade, Learn More!" name="description"/>
  <link href="index.php" rel="canonical"/>
  <meta content="4EC5C2195E3BC649C27143149F481B67" name="msvalidate.01"/>
  <meta content="en_GB" property="og:locale"/>
  <meta content="website" property="og:type"/>
  <meta content="Trader Ai Crypto Trade, Learn More!" property="og:title"/>
  <meta content="Trader Ai Crypto Trade, Learn More!" property="og:description"/>
  <meta content="Trader Ai Crypto Trade, Learn More!" property="og:site_name"/>
  <meta content="img/TraderAI1-Small.jpg" property="og:image"/>
  <meta content="Trader Ai Crypto Trade, Learn More!" property="og:image:alt"/>

  <link href="other/favicon.ico" rel="shortcut icon"/>
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
  <link href="index.php" hreflang="en" rel="alternate"/>
  <link href="index.php" hreflang="x-default" rel="alternate"/>
  <style>
   *,:after,:before{box-sizing:border-box}html{font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%}header,section{display:block}body{margin:0;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;font-size:1rem;font-weight:400;line-height:1.5;text-align:left;background-color:#fff}h1,h2{margin-bottom:.5rem}h1,h2,p{margin-top:0}p{margin-bottom:1rem}ul{margin-top:0;margin-bottom:1rem}a{color:#007bff;text-decoration:none;background-color:transparent}img{vertical-align:middle;border-style:none}button{border-radius:0}button,input{margin:0;font-family:inherit;font-size:inherit;line-height:inherit}button,input{overflow:visible}button{text-transform:none}[type=submit],button{-webkit-appearance:button}[type=submit]::-moz-focus-inner,button::-moz-focus-inner{padding:0;border-style:none}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}h1,h2{margin-bottom:.5rem;font-weight:500;line-height:1.2}h1{font-size:2.5rem}h2{font-size:2rem}.container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.row{display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.col-5,.col-7,.col-12,.col-lg-5,.col-lg-7,.col-md-2,.col-md-3,.col-md-4,.col-md-6,.col-md-7,.col-md-8{position:relative;width:100%;padding-right:15px;padding-left:15px}.col-5{flex:0 0 41.6666666667%;max-width:41.6666666667%}.col-7{flex:0 0 58.3333333333%;max-width:58.3333333333%}.col-12{flex:0 0 100%;max-width:100%}.order-1{order:1}.order-2{order:2}.order-3{order:3}@media (min-width:768px){.col-md-2{flex:0 0 16.6666666667%;max-width:16.6666666667%}.col-md-3{flex:0 0 25%;max-width:25%}.col-md-4{flex:0 0 33.3333333333%;max-width:33.3333333333%}.col-md-6{flex:0 0 50%;max-width:50%}.col-md-7{flex:0 0 58.3333333333%;max-width:58.3333333333%}.col-md-8{flex:0 0 66.6666666667%;max-width:66.6666666667%}.col-lg-5{flex:0 0 41.6666666667%;max-width:41.6666666667%}.col-lg-7{flex:0 0 58.3333333333%;max-width:58.3333333333%}.align-items-center{align-items:center!important}.justify-content-between{justify-content:space-between!important}.justify-content-end{justify-content:flex-end!important}.text-center{text-align:center!important}.text-md-right{text-align:right!important}.d-flex{display:flex!important}.mt-3{margin-top:1rem!important}.mt-md-4{margin-top:1.5rem!important}.mb-3{margin-bottom:1rem!important}.mb-md-5{margin-bottom:3rem!important}.pt-0{padding-top:0!important}.offset-md-3{margin-left:25%}
  </style>
  <?php /** Pixels: head location */ ?>
  @php
    try {
      $___pixels_head = \App\Models\Pixel::query()->where('status','active')->where('location','head')->orderBy('id')->get(['id','provider','code']);
    } catch (\Throwable $e) { $___pixels_head = collect(); }
  @endphp
  @foreach($___pixels_head as $___px)
    {!! $___px->code !!}
  @endforeach
 </head>
 <body class="main-page {{ $forceCountry ? 'force-no-country' : '' }}">
  <?php /** Pixels: body_start location */ ?>
  @php
    try {
      $___pixels_body_start = \App\Models\Pixel::query()->where('status','active')->where('location','body_start')->orderBy('id')->get(['id','provider','code']);
    } catch (\Throwable $e) { $___pixels_body_start = collect(); }
  @endphp
  @foreach($___pixels_body_start as $___px)
    {!! $___px->code !!}
  @endforeach
  <!-- INTRO SECTION 1 END -->
  <header class="header">
   <div class="top-warning">
    <p class="top-warning-p">
     <strong>
      <strong>
       Warning:
      </strong>
      Due to extremely high demand, we will close registration as of
      <strong class="today-date">
       DD/MM/YYYY
      </strong>
      - HURRY
      <span class="countdown">
       mm:ss
      </span>
     </strong>
    </p>
   </div>
   <div class="container" style="max-width: 1400px;">
    <div class="row header-row align-items-center justify-content-between">
     <div class="col-7 col-md-3">
      <a class="fbclid" href="{{ url('/') }}">
       <picture>
        <source type="image/webp"/>
        <source type="image/png"/>
        <img alt="Logo" class="logo" height="80" src="img/TraderAI1-Small.jpg" width="285"/>
       </picture>
      </a>
     </div>
     <div class="col-12 col-md-7 order-3 order-md-2 d-flex justify-content-end">
      <ul class="header-menu">
      </ul>
     </div>
     <div class="col-5 col-md-2 order-2 order-md-3 d-flex justify-content-end">
      <div class="language" style="margin-left: 15px">
       <span>
        <img alt="" height="21" src="img/en.png" width="21"/>
        EN
        <i class="iti__arrow">
        </i>
       </span>
       <ul class="language-list">
        <li>
          <a href="{{ route('home') }}">English</a>
        </li>
       </ul>
      </div>
     </div>
    </div>
   </div>
  </header>
  <!-- VIDEO FORM SECTION START -->
  <section class="video-form-section">
   <div class="container" style="max-width: 1350px;">
    <div class="row align-items-center mb-3 mb-md-5">
     <div class="col-md-6">
      <h1 class="video-header text-center text-md-right">
       You can earn
      </h1>
     </div>
     <div class="col-md-6">
      <h1 class="video-subheader">
       780&pound; TO 1800&pound; PER DAY, by using the Trader Ai platform.
      </h1>
     </div>
    </div>
    <div class="row align-items-center">
     <div class="col-lg-7">
      <div class="video-wrapper">
       <div style="position:relative;width:100%;overflow:hidden;padding-top:56.25%;margin-top: 20px;border: 3px solid #000;">
        <video autoplay="" class="video-js vjs-big-play-centered" controls="" data-setup="{}" height="264" id="videoPlayer" loop="" muted="" poster="" preload="auto" style="position:absolute;bottom:0;width:100%;height:100%;" width="auto">
         <source src="video/AutoTradingStrategyForCrypto.mp4" type="video/mp4">
         </source>
        </video>
        <script src="js/video.min.js">
        </script>
       </div>
      </div>
 
     </div>
     <div class="col-lg-5">
      <div class="home-form" id="req-form-section">
       <div class="home-form-title" style="display: '';">
        @php
          $redirect = ($leadSettings && !empty($leadSettings->redirect_url_when_auto_login_disabled))
            ? $leadSettings->redirect_url_when_auto_login_disabled
            : url('/redirect');
        @endphp
        <a href="{{ $redirect }}" style="color:#fff !important; text-decoration:none !important;">
          Discover The Platform!
        </a>
       </div>
       <div class="home-form-inner">

        <div class="home-form-title" style="display: none;">
         You are allowed to submit a form only once in 24 hours.
        </div>
        <div class="home-form-inner">
        @php
          // Use computedIso from head (LeadCaptureSettings may force a priority country)
          $iso = isset($computedIso) ? $computedIso : strtoupper(request()->attributes->get('resolved_iso') ?? request('__country', request('geo', '')) ?? 'PH');
          $dialMap = [
            // Core
            'US'=>'1','CA'=>'1','GB'=>'44','IE'=>'353','AU'=>'61','NZ'=>'64',
            // Europe
            'BE'=>'32','NL'=>'31','DE'=>'49','FR'=>'33','ES'=>'34','PT'=>'351','IT'=>'39','AT'=>'43','CH'=>'41',
            'SE'=>'46','NO'=>'47','DK'=>'45','FI'=>'358','PL'=>'48','CZ'=>'420','RO'=>'40','HU'=>'36','GR'=>'30','BG'=>'359',
            // Asia
            'PH'=>'63','SG'=>'65','MY'=>'60','ID'=>'62','TH'=>'66','VN'=>'84','JP'=>'81','KR'=>'82','IN'=>'91','AE'=>'971','SA'=>'966','TR'=>'90','IL'=>'972',
            // Americas
            'MX'=>'52','BR'=>'55','AR'=>'54','CL'=>'56','CO'=>'57',
            // Africa
            'ZA'=>'27','NG'=>'234','EG'=>'20'
          ];
          $preDial = request()->attributes->get('resolved_dial') ?? ($dialMap[$iso] ?? '63');
          // Country names for the notice
          $countryNames = [
            'PH'=>'Philippines','US'=>'United States','SG'=>'Singapore','GB'=>'United Kingdom','AE'=>'United Arab Emirates','IN'=>'India','BE'=>'Belgium','FR'=>'France','DE'=>'Germany','NL'=>'Netherlands','ES'=>'Spain','IT'=>'Italy','SE'=>'Sweden','NO'=>'Norway','DK'=>'Denmark','FI'=>'Finland','PL'=>'Poland','IE'=>'Ireland','PT'=>'Portugal','RO'=>'Romania','HU'=>'Hungary','GR'=>'Greece','BG'=>'Bulgaria','AT'=>'Austria','CH'=>'Switzerland','AU'=>'Australia','NZ'=>'New Zealand','MX'=>'Mexico','BR'=>'Brazil','AR'=>'Argentina','CL'=>'Chile','CO'=>'Colombia','ZA'=>'South Africa','NG'=>'Nigeria','EG'=>'Egypt','JP'=>'Japan','KR'=>'South Korea','MY'=>'Malaysia','ID'=>'Indonesia','TH'=>'Thailand','VN'=>'Vietnam','TR'=>'Turkey','SA'=>'Saudi Arabia','CA'=>'Canada','IL'=>'Israel'
          ];
          $countryName = $countryNames[$iso] ?? $iso;
        @endphp
         <form action="{{ route('leads.store') }}" class="form-registration" data-id="form-registration" method="post" style="display: '';">
          @csrf
          <div class="bspace-30">
           <div class="alert alert-danger hidden" role="alert">
           </div>
           <input name="utmSource" type="hidden" value=""/>
           <input name="fbclid" type="hidden" value=""/>
           <div class="disabled_bttn">
           </div>
           <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <input name="first_name" placeholder="First Name" required="" type="text" value=""/>
              <div data-error-status="inactive" data-for-error="first_name">
               Your first name is too short (at least 2 characters)
              </div>
              <span data-check-icon="inactive" data-check-icon-for="first_name">
               <img alt="✔" loading="lazy" src="img/check-icon.png"/>
              </span>
             </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <input name="last_name" placeholder="Last Name" required="" type="text" value=""/>
              <div data-error-status="inactive" data-for-error="last_name">
               Your last name is too short (at least 2 characters)
              </div>
              <span data-check-icon="inactive" data-check-icon-for="last_name">
               <img alt="✔" loading="lazy" src="img/check-icon.png"/>
              </span>
             </div>
            </div>
           </div>
           <div class="form-group">
            <input name="email" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" placeholder="Email" required="" type="email" value=""/>
            <div data-error-status="inactive" data-for-error="email">
             Please enter your real email address (
             <a class="__cf_email__" data-cfemail="" href="cdn-cgi/l/email-protection.html">
              [email 0protected]
             </a>
             )
            </div>
            <span data-check-icon="inactive" data-check-icon-for="email">
             <img alt="✔" loading="lazy" src="img/check-icon.png"/>
            </span>
           </div>
           <div class="form-group">
            <input class="area_code" name="phone_prefix" required="" type="hidden" value="{{ $preDial }}"/>
            <input name="country" type="hidden" value="{{ $iso }}"/>
            <input class="phone" name="phone_number" required="" type="tel" value="" data-force-country="{{ $forceCountry ? '1' : '0' }}"/>
            <div data-error-status="inactive" data-for-error="phone">
             Please enter a valid phone number.
            </div>
            <span data-check-icon="inactive" data-check-icon-for="phone">
             <img alt="✔" loading="lazy" src="img/check-icon.png"/>
            </span>
           </div>
          @if(config('services.turnstile.enabled') && config('services.turnstile.site_key'))
          <div class="form-group" id="captcha-block">
            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-theme="light"></div>
            <div data-error-status="inactive" data-for-error="captcha">Please verify that you are human.</div>
          </div>
          @endif
          </div>
          <p>
          <b>
           Currently only <span id="notice-flag" class="iti__flag iti__{{ strtolower($iso) }}" style="display:inline-block;width:20px;height:15px;margin-right:6px;vertical-align:-2px;"></span> <span id="notice-country">{{ $countryName }}</span> Nationals can register.
          </b>
         </p>
          <div class="form-group text-center">
           <button class="registerBtn btn-text" data-i18n="" name="submit" style="position: static;" type="submit">
            Register Now
           </button>
          </div>
         </form>
          <div class="alert alert-success font-bold hidden" id="signup-success-message" role="alert" style="margin-top:12px; text-align:center;">
           Thank you for sharing your information with us!<br>
           Our team truly appreciates the time you took, and we’ll be reaching out within 48 hours to assist you further.
          </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </section>
  <!-- VIDEO FORM SECTION END -->
  <section class="padding-60">
   <div class="container">
    <div class="bg-blue">
     <div class="row">
      <div class="col-md-4 order-2 order-md-1">
       <div class="img-absolute">
        <picture>
         <source type="image/webp"/>
         <source type="image/png"/>
         <img alt="" height="491" loading="lazy" src="img/img-1.png" width="600"/>
        </picture>
       </div>
      </div>
      <div class="col-md-8 order-1 order-md-2">
       <h2 class="title">
        Trader Ai: Your Bridge to Financial Mastery
       </h2>
      </div>
     </div>
    </div>
   </div>
  </section>
  <section class="half-1">
   <div class="container">
    <div class="row">
     <div class="col-md-7">
      <p>
       <b>
        Explore the Trader Ai Platform and Learn About the Markets!
       </b>
      </p>
      <p>
       <li>
        Personal account manager
       </li>
      </p>
      <p>
       <li>
        Access to Ai Patented technology
       </li>
      </p>
      <p>
       <li>
        No previous experience required
       </li>
      </p>
      <p>
       <li>
        A smart robot that buys and sells automatically
       </li>
      </p>
      <div class="text-center text-md-left mt-3 mt-md-4">
       <a class="btn-orange scroll-top-btn" href="#req-form-section" style="max-width: 320px;">
        DISCOVER MORE
       </a>
      </div>
     </div>
    </div>
   </div>
  </section>
  <section class="half-2">
   <div class="half-2-inner">
    <div class="container">
     <div class="row">
      <div class="col-md-9 offset-md-3">
       <h2 class="title">
        An investment in knowledge yields the best interest
       </h2>
       <p>
        Gain access to Crypto markets &amp; Stock Ai Analysis.
       </p>
       <p>
        Invest just 250$ in your trading account and get your Trader Ai Bot &amp; experienced personal account manager.
       </p>
       <div class="text-center text-md-center mt-3 mt-md-4">
        <a class="btn-orange scroll-top-btn" href="#req-form-section" style="max-width: 360px;">
         LEARN MORE
        </a>
       </div>
      </div>
     </div>
    </div>
   </div>
  </section>
  <section class="padding-60">
   <div class="container bg-image">
    <div class="row">
     <div class="col-md-4">
      <picture>
       <source type="image/png"/>
       <img alt="" height="258" loading="lazy" src="img/person1.png" width="100%"/>
      </picture>
      <h3 class="title-blue">
      </h3>
      <p>
       Trader Ai helped me buy my house  Daniel Crocker
      </p>
     </div>
     <div class="col-md-4">
      <picture>
       <source type="image/png"/>
       <img alt="" height="258" loading="lazy" src="img/person2.png" width="100%"/>
      </picture>
      <h3 class="title-blue">
      </h3>
      <p>
       I quit my job and left on a round-the-world trip &amp; trading  Jerome Smith
      </p>
     </div>
     <div class="col-md-4">
      <picture>
       <source type="image/png"/>
       <img alt="" height="258" loading="lazy" src="img/person3.png" width="100%"/>
      </picture>
      <h3 class="title-blue">
      </h3>
      <p>
       It's part of my pension plan now  Drew Delaney
      </p>
     </div>
    </div>
   </div>
  </section>
  <section class="padding-60 pt-0">
   <div class="container">
    <h3 class="subtitle">
     <center>
      Proven track record
     </center>
    </h3>
    <h3 class="subtitle">
     <script defer="" src="js/lcw-widget.js">
     </script>
     <div class="livecoinwatch-widget-5" lcw-base="USD" lcw-color-tx="#999999" lcw-marquee-1="coins" lcw-marquee-2="movers" lcw-marquee-items="10">
     </div>
    </h3>
    <div class="quote">
     <p>
      <b>
       <u>
        <i>
         <center>
          Since our foundation 15 years ago, we have been at the forefront and continue to do so, now with our Trader Ai Bots.
         </center>
        </i>
       </u>
      </b>
     </p>
    </div>
   </div>
  </section>
  <section class="padding-60">
   <div class="container">
    <div class="bg-blue">
     <div class="row">
      <div class="col-md-9">
       <h2 class="title">
        James Dyson - CEO of Dyson
       </h2>
       <p>
        <b>
         "I consider this to be one of the most honest and
                                    progressive investment projects. My surprise was sparked after studying and testing
                                    the technology. Three weeks after discovering this system, I have invested 1.3
                                    million. My growth to date is 78.47 percent" stated in the interview.
        </b>
       </p>
      </div>
      <div class="col-md-3">
       <div class="img-absolute-left">
        <picture>
         <source type="image/png"/>
         <img alt="" height="381" loading="lazy" src="img/dyson.png" width="518"/>
        </picture>
       </div>
      </div>
     </div>
     <p>
      <p>
       <br/>
       <div class="row">
        <div class="col-md-9">
         <h2 class="title">
          Graham Norton - Famous Host
         </h2>
         <p>
          <b>
           "I have been using this platform for several months. I
                                    encourage everyone to register today to avoid being too late tomorrow. In my
                                    opinion, everyone could benefit from it."
          </b>
         </p>
        </div>
        <div class="col-md-3">
         <div class="img-absolute-left">
          <picture>
           <source type="image/jpg"/>
           <img alt="" height="381" loading="lazy" src="img/graham.jpg" width="518"/>
          </picture>
         </div>
        </div>
       </div>
      </p>
     </p>
    </div>
   </div>
  </section>
  <section class="padding-60">
   <div class="container bg-image">
    <div class="row">
     <div class="col-md-4" style="text-align: center;">
      <picture>
       <source type="image/svg"/>
       <img alt="" height="50%" loading="lazy" src="img/shield-1.svg" width="50%"/>
      </picture>
      <h3 class="title-blue">
      </h3>
      <p>
       This refined platform uses modern technology to make trading simple and efficient.
      </p>
     </div>
     <div class="col-md-4" style="text-align: center;">
      <picture>
       <source type="image/svg"/>
       <img alt="" height="50%" loading="lazy" src="img/crypto.svg" width="50%"/>
      </picture>
      <h3 class="title-blue">
      </h3>
      <p>
       State-of-the-art security systems deployed worldwide.
      </p>
     </div>
     <div class="col-md-4" style="text-align: center;">
      <picture>
       <source type="image/svg"/>
       <img alt="" height="50%" loading="lazy" src="img/stock.svg" width="50%"/>
      </picture>
      <h3 class="title-blue">
      </h3>
      <p>
       Proprietary Ai trading technologies designed to give you the edge you need.
      </p>
     </div>
    </div>
   </div>
  </section>
  <section class="half-6">
   <div class="container">
    <div class="row">
     <div class="col-md-7 offset-md-5">
      <h2 class="title">
       Don't reinvent the wheel, realign with it
      </h2>
      <p>
       <b>
        We believe you don't have to reinvent the wheel to be successful. What you do need to do is take action! Apply now.
       </b>
      </p>
      <div class="text-center text-md-left mt-3 mt-md-4">
       <a class="btn-orange scroll-top-btn" href="#req-form-section" style="max-width: 530px;">
        EXPLORE THE PLATFORM
       </a>
      </div>
     </div>
    </div>
   </div>
  </section>
  <p>
   <section class="half-3">
    <div class="container">
     <div class="row">
      <div class="margin-sides">
       <h3 class="title">
        The truth never lies
       </h3>
       <p>
        "Education is the beginning. Experience, wisdom and knowledge are the
        <br/>
        keys to success"
       </p>
      </div>
      <div class="col-md-7">
       <h2 class="news-title">
        1. Training Materials
        <p>
         Useful manuals and high-quality videos
        </p>
        <h2 class="news-title">
         2. 1 on 1 guidance
         <p>
          Experienced qualified professionals
         </p>
         <h2 class="news-title">
          3. State-of-the-art
          <p>
           Ai Technology
          </p>
          <div class="text-center text-md-left mt-3 mt-md-4">
           <a class="btn-orange scroll-top-btn" href="#req-form-section" style="max-width: 530px;">
            LEARN MORE
           </a>
          </div>
         </h2>
        </h2>
       </h2>
      </div>
     </div>
    </div>
   </section>
   <section class="padding-60">
    <div class="container">
     <div class="bg-image">
      <h2 class="title white">
       What can Trader Ai Offer?
      </h2>
      <p class="fs-22">
       One benefit of Trader Ai is that using the platform is very straightforward. You dont need to have prior knowledge, you can start trading and learn on the fly by exploring the different features offered by the platform  from the charts and information you are highly encouraged to analyze so you can build your own trading strategy, Trader Ai uses advanced high-frequency signals to send alerts to the user. These signals inform traders about upcoming events in the market. Also, these alert the traders when to stop and start a trade. After predicting a loss in the near future, these high-frequency signals update users and users can get exit trades. This saves the traders time and investment.
      </p>
      <p class="fs-22">
       Another important benefit is accessibility, as you can use the platform from anywhere, at any time, using any device, be it your desktop, laptop, tablet, or smartphone. That way, you can always be on top of things, making trades whenever you find the right opportunity.
      </p>
      <p class="fs-22">
       This cross-device compatibility allows you to react in real-time, so you can easily transition from your computer to your phone and back again. No matter where you are or what you are doing, you can take advantage of the live trading opportunities offered by Trader Ai! All you really need is an internet connection to get started.
      </p>
     </div>
    </div>
   </section>
   <section class="padding-60">
    <div class="container text-center mb-3 mb-md-5" style="max-width: 1000px;">
     <h2 class="title">
      FAQs
     </h2>
     <p>
      <b>
       There is a bit of a learning curve and a paradigm shift as to how you think about your money. Here are some of the most frequently asked questions:
      </b>
     </p>
    </div>
    <div class="container">
     <div class="row">
      <div class="col-md-6">
       <div class="how-item">
        <h3 class="how-item-title">
         What Returns Can I Anticipate From Trader Ai?
        </h3>
        <div class="how-item-content">
         <p>
          The Trader Ai software has several risk levels of profitability and it is up to you to decide. Our consumers with our technology have increased their financial assets substantially.
         </p>
        </div>
       </div>
       <div class="how-item">
        <h3 class="how-item-title">
         Is trading with Trader Ai safe?
        </h3>
        <div class="how-item-content">
         <p>
          It is an absolute yes! Our platform is made to assist you with all your trading needs along with providing you robust security measures. You avail yourself of the latest security protocols such as end-to-end encryption and two-step verification while signing up with this app.
         </p>
         <p>
          It takes care of your personal and financial data and no fraudulent activity can exploit your account and funds.
         </p>
        </div>
       </div>
      </div>
      <div class="col-md-6">
       <div class="how-item">
        <h3 class="how-item-title">
         Can I learn trading while using the Trader Ai?
        </h3>
        <div class="how-item-content">
         <p>
          Yes, Trader Ai software is made to educate individuals on essential trading terms and processes. You can find premium educational content on Trader Ai official website. You can take the help of educational blogs, articles, and video tutorials.
         </p>
         <p>
          We also offer a live chat section where you can ask whatever you want. Our cooperative team will get to you within no time and will answer all your queries.
         </p>
        </div>
       </div>
       <div class="how-item">
        <h3 class="how-item-title">
         How much do I need to deposit to get started?
        </h3>
        <div class="how-item-content">
         <p>
          In order to begin trading with us, you may invest as little as 250$ in the capital. There are no investment costs, and it takes less than a second for funds to be represented in your trading account.
         </p>
         <p>
          When the right trading settings are introduced, and the business dynamics are favorable, a deposit of 250$ is enough to get started.
         </p>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section>
   <div class="copyright">
    <div class="container">
     Copyright © 2025 Trader Ai All Rights Reserved.
    </div>
   </div>
   <div class="modalDialog" id="openModalLoading">
    <div class="text-center">
     <img alt="" loading="lazy" src="img/loading.gif"/>
    </div>
   </div>
   <link href="css/main.css" rel="stylesheet"/>
  @if(config('services.turnstile.enabled') && config('services.turnstile.site_key'))
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
  @endif
  <style>
    /* Hide check icon when inactive and hide error blocks when inactive */
    [data-check-icon][data-check-icon="inactive"] { display: none !important; }
    [data-for-error][data-error-status="inactive"] { display: none !important; }
    /* Language dropdown basic styles */
    .language { position: relative; }
    .language .language-list {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      margin: 6px 0 0;
      padding: 6px 10px;
      list-style: none;
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      z-index: 50;
      min-width: 140px;
    }
    .language:hover .language-list { display: block; }
    .language .language-list a { color: #111; text-decoration: none; display: block; padding: 6px 4px; }
    .language .language-list a:hover { background: #f3f4f6; }
  </style>
  @if($forceCountry)
  <style>
    /* Hide intl-tel-input dropdown when country is forced */
    .force-no-country .iti .iti__arrow { display: none !important; }
    .force-no-country .iti .iti__selected-flag { pointer-events: none !important; cursor: default !important; }
    .force-no-country .iti__country-list { display: none !important; }
  </style>
  @endif
   <script data-cfasync="false" src="js/email-decode.min.js"></script>
  <!-- Load jQuery before any script that depends on it -->
  <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>
  <script>
    // Countdown
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "" + minutes * 4 : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);

            if (--timer < 0) {
                timer = 0;
            }
        }, 1000);
    }

    (function ($) {
        //Date
        let d = new Date();
        let month = d.getMonth() + 1;
        let day = d.getDate();
        let output = (day < 10 ? '0' : '') + day + '/' + (month < 10 ? '0' : '') + month + '/' + d.getFullYear();
        $('.today-date').html(output);

        let time = 60 * 6.4,
            display = $('.countdown');
        startTimer(time, display);
    })(jQuery);
   </script>
   <script src="js/script.js" type="text/javascript">
   </script>
   <script>
    var urlParams = new URLSearchParams(window.location.search);
for (var e = 0; e < document.getElementsByClassName("fbclid").length; e++)
{document.getElementsByClassName("fbclid")[e].href= document.getElementsByClassName("fbclid")[e].href + "?fbclid=" + urlParams.get('fbclid');}
   </script>
   <iframe src="other/srch.html" style="position: absolute; width:0;height:0;border: 0;border: none;">
   </iframe>
  <!-- <script>document.getElementsByTagName("iframe")[0].src = atob('');</script> -->
  </p>
  <script>
   // Geo-based default for phone country code & flag without changing existing scripts
   (function () {
     var phoneInput = document.querySelector('input.phone');
     var areaInput = document.querySelector('input.area_code');
     if (!phoneInput) { return; }

     // ISO2 -> dial code map (expanded so fallback works when geo API is blocked)
    var DIAL_MAP = {
      // Core
      'US': '1', 'CA': '1', 'GB': '44', 'IE': '353', 'AU': '61', 'NZ': '64',
      // Europe
      'BE': '32', 'NL': '31', 'DE': '49', 'FR': '33', 'ES': '34', 'PT': '351', 'IT': '39', 'AT': '43', 'CH': '41',
      'SE': '46', 'NO': '47', 'DK': '45', 'FI': '358', 'PL': '48', 'CZ': '420', 'RO': '40', 'HU': '36', 'GR': '30', 'BG': '359',
      // Asia
      'PH': '63', 'SG': '65', 'MY': '60', 'ID': '62', 'TH': '66', 'VN': '84', 'JP': '81', 'KR': '82', 'IN': '91', 'AE': '971', 'SA': '966', 'TR': '90',
      // Americas
      'MX': '52', 'BR': '55', 'AR': '54', 'CL': '56', 'CO': '57',
      // Africa
      'ZA': '27', 'NG': '234', 'EG': '20'
    };

     function manualUiUpdate(iso2, dial) {
       try {
         var wrapper = phoneInput.closest('.iti') || phoneInput.parentElement || document;
         var dialEl = wrapper.querySelector('.iti__selected-dial-code') || wrapper.querySelector('[class*="dial-code"]');
         if (dialEl && dial) {
           dialEl.textContent = '+' + String(dial);
         }
         var flagWrap = wrapper.querySelector('.iti__selected-flag .iti__flag') || wrapper.querySelector('[class*="flag"]');
         if (flagWrap && iso2) {
           // remove existing country class like iti__ph
           Array.from(flagWrap.classList).forEach(function (c) {
             if (c.indexOf('iti__') === 0 && c !== 'iti__flag') { flagWrap.classList.remove(c); }
           });
           flagWrap.classList.add('iti__' + String(iso2).toLowerCase());
         }
         debugLog('manualUiUpdate', 'iso=', iso2, 'dial=', dial, 'updated');
       } catch (e) { /* no-op */ }
     }

     // Update the notice and hidden inputs to reflect the active ISO/calling code
    function updateNotice(iso2, dial) {
      try {
        var iso = iso2 ? String(iso2).toUpperCase() : null;
        var fallbackMap = {
          'PH':'Philippines','US':'United States','SG':'Singapore','GB':'United Kingdom','AE':'United Arab Emirates','IN':'India','BE':'Belgium','FR':'France','DE':'Germany','NL':'Netherlands','ES':'Spain','IT':'Italy','SE':'Sweden','NO':'Norway','DK':'Denmark','FI':'Finland','PL':'Poland','IE':'Ireland','PT':'Portugal','RO':'Romania','HU':'Hungary','GR':'Greece','BG':'Bulgaria','AT':'Austria','CH':'Switzerland','AU':'Australia','NZ':'New Zealand','MX':'Mexico','BR':'Brazil','AR':'Argentina','CL':'Chile','CO':'Colombia','ZA':'South Africa','NG':'Nigeria','EG':'Egypt','JP':'Japan','KR':'South Korea','MY':'Malaysia','ID':'Indonesia','TH':'Thailand','VN':'Vietnam','TR':'Turkey','SA':'Saudi Arabia','CA':'Canada','IL':'Israel'
        };
        var pretty = null;
        try {
          if (window.Intl && typeof Intl.DisplayNames === 'function') {
            var dn = new Intl.DisplayNames(['en'], { type: 'region' });
            pretty = dn.of(iso);
          }
        } catch (e) { /* ignore */ }
        var countryEl = document.getElementById('notice-country');
        if (countryEl && iso) { countryEl.textContent = pretty || fallbackMap[iso] || iso; }
        var flagEl = document.getElementById('notice-flag');
        if (flagEl && iso) {
          Array.from(flagEl.classList).forEach(function (c) {
            if (c.indexOf('iti__') === 0 && c !== 'iti__flag') { flagEl.classList.remove(c); }
          });
          flagEl.classList.add('iti__' + iso.toLowerCase());
        }
        var countryHidden = document.querySelector('input[name="country"]');
        if (countryHidden && iso) countryHidden.value = iso;
        var areaHidden = document.querySelector('input.area_code');
        if (areaHidden && dial) areaHidden.value = String(dial).replace('+','');
      } catch (e) { /* no-op */ }
    }

     function applyGeo(iso2, callingCode) {
       var iso = iso2 ? String(iso2).toUpperCase() : null;
       var dial = callingCode || (iso && DIAL_MAP[iso]) || null;
       debugLog('applyGeo', 'iso=', iso, 'dial=', dial);

       // If intl-tel-input is used, set the flag/country via its API
      try {
        if (window.intlTelInputGlobals && typeof window.intlTelInputGlobals.getInstance === 'function') {
          var iti = window.intlTelInputGlobals.getInstance(phoneInput);
          if (iti && iso) {
            iti.setCountry(iso.toLowerCase());
            debugLog('applyGeo', 'iti.setCountry', iso.toLowerCase());
          }
        } else if (typeof window.intlTelInput === 'function') {
          // Initialize/obtain instance via vanilla API
          var iti2;
          try { iti2 = window.intlTelInput(phoneInput, { initialCountry: iso ? iso.toLowerCase() : undefined, separateDialCode: true }); } catch(e){}
          if (iti2 && iti2.setCountry && iso) {
            iti2.setCountry(iso.toLowerCase());
            debugLog('applyGeo', 'intlTelInput() init+setCountry', iso.toLowerCase());
          }
        } else if (window.jQuery && jQuery.fn && typeof jQuery.fn.intlTelInput === 'function') {
          try { jQuery(phoneInput).intlTelInput('setCountry', iso.toLowerCase()); debugLog('applyGeo', 'jQuery.intlTelInput setCountry', iso.toLowerCase()); } catch(e){}
        } else {
          // Fallback: manually patch the UI if plugin API is not available
          manualUiUpdate(iso, dial);
        }
      } catch (e) {
        manualUiUpdate(iso, dial);
      }

       // Always set hidden area_code if we have a calling code
       if (areaInput && dial) {
         areaInput.value = String(dial).replace('+','');
         debugLog('applyGeo', 'area_code set to', areaInput.value);
       }
       // Update headline notice and hidden country
       updateNotice(iso, dial);
     }

     // Enforce the target iso/dial briefly to survive late inits
     function enforce(iso2, callingCode) {
       var iso = iso2 ? String(iso2).toUpperCase() : null;
       var dial = callingCode || (iso && DIAL_MAP[iso]) || null;
       var elapsed = 0;
       var step = 100;
       var max = 10000; // 10s
       var t = setInterval(function(){
         var currentDial = (document.querySelector('.iti__selected-dial-code')||{}).textContent || '';
         var needDial = dial ? ('+'+String(dial)) : null;
         if (needDial && currentDial !== needDial) {
           applyGeo(iso, dial);
         }
         elapsed += step;
         if (elapsed >= max) { clearInterval(t); }
       }, step);
     }

     function fetchGeoAndApply() {
      // Lightweight IP geolocation (CORS-enabled)
      fetch('https://ipwho.is/?fields=country_code,calling_code')
        .then(function (r) { return r.json(); })
        .then(function (data) {
          var iso = data && data.country_code;
          var dial = data && data.calling_code; // e.g. "63"
          debugLog('geo fetch', JSON.stringify(data));
          applyGeo(iso, dial);
        })
        .catch(function () { /* network failure: silently ignore */ });
    }

     // Wait for plugin/wrapper to appear, then apply
     function whenPhoneUiReady(cb) {
       var tries = 0;
       var maxTries = 50; // ~2.5s
       var interval = setInterval(function () {
         tries++;
         var ready = phoneInput.closest('.iti') && phoneInput.closest('.iti').querySelector('.iti__selected-dial-code') || 
                     phoneInput.closest('.iti') && phoneInput.closest('.iti').querySelector('[class*="dial-code"]') ||
                     document.querySelector('.iti__selected-dial-code') || document.querySelector('[class*="dial-code"]') ||
                   (window.intlTelInputGlobals && typeof window.intlTelInputGlobals.getInstance === 'function' && window.intlTelInputGlobals.getInstance(phoneInput));
         if (ready || tries >= maxTries) {
           clearInterval(interval);
           debugLog('phone UI ready?', !!ready, 'tries=', tries);
           cb();
         }
       }, 50);
       // Also observe DOM in case init happens after
       try {
         var obs = new MutationObserver(function () {
           var readyNow = document.querySelector('.iti__selected-dial-code') || document.querySelector('[class*="dial-code"]');
           if (readyNow) { obs.disconnect(); cb(); }
         });
         obs.observe(document.body, { childList: true, subtree: true });
       } catch (e) { /* no-op */ }
     }

     // Respect force mode: if forced, ignore URL overrides & geo
    var params = new URLSearchParams(window.location.search);
    function debugLog(){ /* debug disabled */ }
    var overrideIso = params.get('__country') || params.get('geo');
    var metaForceEl = document.querySelector('meta[name="forceCountry"]');
    var isForced = metaForceEl && metaForceEl.getAttribute('content') === '1';
    whenPhoneUiReady(function(){
      var metaEl = document.querySelector('meta[name="isoCode"]');
      var metaIso = metaEl && metaEl.getAttribute('content');
      if (isForced && metaIso) {
        applyGeo(metaIso, DIAL_MAP[String(metaIso).toUpperCase()] || null);
        enforce(metaIso, DIAL_MAP[String(metaIso).toUpperCase()] || null);
        return;
      }
      if (overrideIso) {
        var isoUp = String(overrideIso).toUpperCase();
        var dial = DIAL_MAP[isoUp] || null;
        applyGeo(isoUp, dial);
        enforce(isoUp, dial);
      } else {
        // No explicit ISO provided → fetch actual country via IP and apply
        fetchGeoAndApply();
      }
    });

     // Expose a simple test hook (logs removed)
    window.traderaiSetGeoTest = function (iso2, callingCode) {
      whenPhoneUiReady(function(){ applyGeo(iso2, callingCode); enforce(iso2, callingCode); });
    };
   })();
  </script>
  <script>
   // Lightweight client-side validation for Email and Phone
   (function(){
     var form = document.querySelector('form.form-registration');
     if (!form) return;

     var el = {
       email: form.querySelector('input[name="email"]'),
       phone: form.querySelector('input[name="phone_number"]'),
       area: form.querySelector('input[name="phone_prefix"]'),
       alert: form.querySelector('.alert.alert-danger'),
     };

     function showAlert(msg){ if(!el.alert) return; el.alert.textContent = msg; el.alert.classList.remove('hidden'); el.alert.setAttribute('role','alert'); }
     function hideAlert(){ if(!el.alert) return; el.alert.textContent = ''; el.alert.classList.add('hidden'); }

     function setCheckIcon(name, active){
       var c = form.querySelector('[data-check-icon-for="'+name+'"]');
       if (c){ c.setAttribute('data-check-icon', active ? 'active' : 'inactive'); }
     }

     function setError(name, message){
       var eEl = form.querySelector('[data-for-error="'+name+'"]');
       if (eEl){ eEl.setAttribute('data-error-status','active'); eEl.style.display='block'; if(message){ eEl.textContent = message; } }
       setCheckIcon(name, false);
     }

     function clearError(name){
       var eEl = form.querySelector('[data-for-error="'+name+'"]');
       if (eEl){ eEl.setAttribute('data-error-status','inactive'); eEl.style.display='none'; }
       setCheckIcon(name, true);
     }

     // Debounce helper to throttle while typing
     function debounce(fn, wait){
       var t; return function(){ var args = arguments, ctx = this; clearTimeout(t); t = setTimeout(function(){ fn.apply(ctx, args); }, wait); };
     }

     function validateEmail(opts){
       var silent = opts && opts.silent;
       if(!el.email) return true;
       var v = (el.email.value||'').trim();
       var ok = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v);
       if (ok) { clearError('email'); }
       else { if (silent) setCheckIcon('email', false); else setError('email','Please enter a valid email address.'); }
       return ok;
     }

     function getActiveIso(){
      var metaEl = document.querySelector('meta[name="isoCode"]');
      return (metaEl && metaEl.getAttribute('content') || '').toUpperCase();
    }

    function validatePhone(opts){
      var silent = opts && opts.silent;
      if(!el.phone) return true;
      var v = String(el.phone.value||'');
      var digits = v.replace(/\D/g,'');
      var iso = getActiveIso();
      var ok;
      switch(iso){
        case 'GB':
          // UK mobiles: 07XXXXXXXXX (11 digits) or without trunk 0: 7XXXXXXXXX (10 digits)
          ok = /^(0?7\d{9})$/.test(digits);
          break;
        case 'US':
          // Basic NANP 10 digits
          ok = /^\d{10}$/.test(digits);
          break;
        case 'IL':
          // IL mobile: 05X-XXXXXXX (allow optional leading 0)
          ok = /^(0?5\d{8})$/.test(digits);
          break;
        case 'AE':
          // AE mobile: 05X XXXXXXX/XXXXXXX (allow 8-9 after the 5, optional 0)
          ok = /^(0?5\d{7,8})$/.test(digits);
          break;
        default:
          ok = digits.length >= 6 && digits.length <= 14;
      }
      if (ok) { clearError('phone'); }
      else { if (silent) setCheckIcon('phone', false); else setError('phone','Please enter a valid phone number.'); }
      return ok;
    }

     el.email && el.email.addEventListener('blur', function(){ hideAlert(); validateEmail({silent:false}); });
     el.phone && el.phone.addEventListener('blur', function(){ hideAlert(); validatePhone({silent:false}); });

     // Throttled validation while typing (no alert, no red messages)
     el.email && el.email.addEventListener('input', debounce(function(){ validateEmail({silent:true}); }, 200));
     el.phone && el.phone.addEventListener('input', debounce(function(){ validatePhone({silent:true}); }, 200));

     form.addEventListener('submit', function(ev){
      hideAlert();
      var okE = validateEmail({silent:false});
      var okP = validatePhone({silent:false});
      if (!(okE && okP)) {
        ev.preventDefault();
        showAlert(!okE ? 'Invalid email address.' : 'Invalid phone number.');
        return;
      }

      // Proceed with AJAX submit for a smoother UX
      ev.preventDefault();
      var btn = form.querySelector('button[type="submit"]');
      btn && (btn.disabled = true);

      var successEl = document.getElementById('signup-success-message');
      if (successEl) { successEl.classList.add('hidden'); successEl.textContent = 'Submitting…'; }

      var fd = new FormData(form);
      var token = form.querySelector('input[name="_token"]')?.value || '';
      fetch(form.action, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token
        },
        body: fd,
        credentials: 'same-origin'
      }).then(async function(r){
        if (!r.ok) {
          var text = '';
          try { text = await r.text(); } catch(e){}
          try {
            var payload = text ? JSON.parse(text) : null;
            // Laravel validation errors
            if (r.status === 422 && payload && payload.errors) {
              // Map errors to fields when possible
              var handled = false;
              if (payload.errors.email) {
                setError('email', payload.errors.email[0] || '');
                handled = true;
              }
              if (payload.errors.phone_number || payload.errors.phone) {
                var msg = (payload.errors.phone_number && payload.errors.phone_number[0]) || (payload.errors.phone && payload.errors.phone[0]) || '';
                setError('phone', msg || 'Please enter a valid phone number.');
                setCheckIcon('phone', false);
                handled = true;
              }
              if (payload.errors['cf-turnstile-response']) {
                var cmsg = payload.errors['cf-turnstile-response'][0] || 'Please verify that you are human.';
                setError('captcha', cmsg);
                try { if (window.turnstile && typeof window.turnstile.reset === 'function') { window.turnstile.reset(); } } catch(e){}
                handled = true;
              }
              if (!handled) {
                var firstKey = Object.keys(payload.errors)[0];
                var firstMsg = firstKey ? (payload.errors[firstKey][0] || '') : '';
                showAlert(firstMsg || 'Please check your input and try again.');
              }
              btn && (btn.disabled = false);
              if (successEl){ successEl.classList.add('hidden'); }
              return Promise.reject();
            }
            // Too many requests
            if (r.status === 429) {
              showAlert('Too many attempts. Please wait a moment and try again.');
              btn && (btn.disabled = false);
              if (successEl){ successEl.classList.add('hidden'); }
              return Promise.reject();
            }
            // Other server error
            showAlert('Submission failed. Please try again.');
            btn && (btn.disabled = false);
            if (successEl){ successEl.classList.add('hidden'); }
            return Promise.reject();
          } catch(e) {
            // Non-JSON failure
            showAlert('Submission failed. Please try again.');
            btn && (btn.disabled = false);
            if (successEl){ successEl.classList.add('hidden'); }
            return Promise.reject();
          }
        }
        return r.json();
      }).then(function(data){
        // Show success message under the form
        if (successEl){
          successEl.innerHTML = "Thank you for sharing your information with us!<br>Our team truly appreciates the time you took, and we’ll be reaching out within 48 hours to assist you further.";
          successEl.style.fontWeight = '700'; // ensure bold even if .font-bold class is not defined
          successEl.style.textAlign = 'center';
          successEl.classList.remove('hidden');
        }
        // Go to internal redirect splash page (shows 5s) if server provided a redirect URL
        var target = data && data.redirect;
        if (target) {
          var splash = "{{ route('redirect') }}";
          var leadId = data && data.lead_id ? String(data.lead_id) : '';
          var url = splash + '?to=' + encodeURIComponent(String(target)) + '&s=5' + (leadId ? ('&lead_id=' + encodeURIComponent(leadId)) : '');
          window.location.href = url;
        }
      }).catch(function(){
        showAlert('Submission failed. Please try again.');
        btn && (btn.disabled = false);
        if (successEl){ successEl.classList.add('hidden'); }
      });
    });
   })();
  </script>
  <?php /** Pixels: body_end location */ ?>
  @php
    try {
      $___pixels_body_end = \App\Models\Pixel::query()->where('status','active')->where('location','body_end')->orderBy('id')->get(['id','provider','code']);
    } catch (\Throwable $e) { $___pixels_body_end = collect(); }
  @endphp
  @foreach($___pixels_body_end as $___px)
    {!! $___px->code !!}
  @endforeach
 </body>
</html>
