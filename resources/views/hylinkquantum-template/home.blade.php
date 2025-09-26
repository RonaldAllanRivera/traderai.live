<!DOCTYPE html>
<html lang="en">
 <head>
 <base href="{{ $assetBase }}">
  @php
    try { $leadSettings = app(\App\Settings\LeadCaptureSettings::class); } catch (\Throwable $e) { $leadSettings = null; }
    $resolvedIsoRaw = strtoupper(request()->attributes->get('resolved_iso') ?? request('__country', request('geo', '')) ?? 'PH');
    $computedIso = $resolvedIsoRaw;
    $forceCountry = false;
    if ($leadSettings && ($leadSettings->country_auto_adjust_enabled ?? true) === false) {
        $computedIso = strtoupper($leadSettings->priority_country ?? 'GB');
        $forceCountry = true;
    }
    $dialMap = [
      'US'=>'1','CA'=>'1','GB'=>'44','IE'=>'353','AU'=>'61','NZ'=>'64',
      'BE'=>'32','NL'=>'31','DE'=>'49','FR'=>'33','ES'=>'34','PT'=>'351','IT'=>'39','AT'=>'43','CH'=>'41',
      'SE'=>'46','NO'=>'47','DK'=>'45','FI'=>'358','PL'=>'48','CZ'=>'420','RO'=>'40','HU'=>'36','GR'=>'30','BG'=>'359',
      'PH'=>'63','SG'=>'65','MY'=>'60','ID'=>'62','TH'=>'66','VN'=>'84','JP'=>'81','KR'=>'82','IN'=>'91','AE'=>'971','SA'=>'966','TR'=>'90','IL'=>'972',
      'MX'=>'52','BR'=>'55','AR'=>'54','CL'=>'56','CO'=>'57',
      'ZA'=>'27','NG'=>'234','EG'=>'20'
    ];
    $preDial = request()->attributes->get('resolved_dial') ?? ($dialMap[$computedIso] ?? '63');
  @endphp
  <meta name="isoCode" content="{{ $computedIso }}"/>
  <meta name="forceCountry" content="{{ $forceCountry ? '1' : '0' }}"/>  
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <link href="other/fav.png" rel="icon" type="image/x-icon"/>
  <link href="css/bootstrap.min.css" rel="stylesheet"/>
  <link href="css/slick.css" rel="stylesheet"/>
  <link href="css/slick-theme.css" rel="stylesheet"/>
  <link href="css/rSlider.min.css" rel="stylesheet"/>
  <link href="css/animate.css" rel="stylesheet"/>
  <link href="css/main.css" rel="stylesheet"/>
  <title>
   Quantum Ai: Official Website 2025 Verified Trading Platform
  </title>
  <meta content="Quantum Ai is the official 2025 platform for smart investing. Start your Quantum Ai Investment journey with AI-powered tools and real-time trading precision." name="description"/>
 </head>
 <body class="{{ $forceCountry ? 'force-no-country' : '' }}">
  <div class="menu">
   <div class="menu-item scroll-btn" data-scroll=".header">
    The main page
   </div>
   <div class="menu-item scroll-btn" data-scroll=".our">
    Partners
   </div>
   <div class="menu-item scroll-btn" data-scroll=".calculator">
    Calculator
   </div>
   <div class="menu-item scroll-btn" data-scroll=".customer">
    Feedback
   </div>
   <div class="menu-item scroll-btn" data-scroll=".review">
    Reviews
   </div>
  </div>
  <div class="loader">
   <div class="loader-item">
    <img alt="image" src="img/loader.gif"/>
   </div>
  </div>
  <div class="up-icon">
   Up
  </div>
  <header class="header">
   <div class="header-object">
    <div class="header-object-item">
     <img alt="image" src="img/header-object-one.png"/>
    </div>
    <div class="header-object-item">
     <img alt="image" src="img/header-object-two.png"/>
    </div>
   </div>
   <div class="container">
    <div class="row">
     <div class="col-12">
      <div class="header-row">
       <div class="head-logo">
        <a class="logo" href="{{ route('home') }}">
         <div class="logo-icon">
          <img alt="image" src="img/logo.png"/>
         </div>
        </a>
       </div>
       <div class="header-btn scroll-btn" data-scroll=".calculator">
        <span>
         Create an account
        </span>
       </div>
      </div>
     </div>
    </div>
   </div>
  </header>
  <section class="info">
   <div class="container">
    <h1 class="title">
     Quantum Ai UK: Official AI Investment Platform for 2025
    </h1>
    <div class="">
     Quantum Ai UK is the next-generation AI-powered investment platform tailored to British traders.

                Built with cutting-edge technology, it empowers users to maximize profits-over 200% ROI possible-across

                crypto, Forex, stocks, and CFDs. This Quantum Ai review explores how the platform uses intelligent

                predictions, secure brokerage access, and global market integration to deliver smart, automated trading.
     <br/>
     <br/>
    </div>
    <div class="row">
     <div class="col-xl-8 col-12">
      <div class="info-video video-block">
       <video autoplay="" controls="" loop="" muted="" playsline="" poster="img/rew1.jpg">
        <source src="video/QuantumAI.mp4" type="video/mp4"/>
       </video>
      </div>
     </div>
     <div class="col-xl-4 col-12">
      <div class="info-feedback feedback">
       <form action="{{ route('leads.store') }}" class="form-registration" data-id="form-registration" method="post" style="display: '';">
        @csrf
        <div class="feedback-mob-row">
         <div class="feedback-input">
          <input name="first_name" placeholder="Enter your firstname" required="" type="text" value=""/>
          <div data-error-status="inactive" data-for-error="first_name">Your first name is too short (at least 2 characters)</div>
          <span data-check-icon="inactive" data-check-icon-for="first_name"><img alt="✔" loading="lazy" src="img/done-icon.png"/></span>
         </div>
         <div class="feedback-input">
          <input name="last_name" placeholder="Enter your lastname" required="" type="text" value=""/>
          <div data-error-status="inactive" data-for-error="last_name">Your last name is too short (at least 2 characters)</div>
          <span data-check-icon="inactive" data-check-icon-for="last_name"><img alt="✔" loading="lazy" src="img/done-icon.png"/></span>
         </div>
        </div>
        <div class="feedback-mob-row">
         <div class="feedback-input">
          <input name="email" placeholder="Enter email address" required="" type="email" value=""/>
          <div data-error-status="inactive" data-for-error="email">Please enter a valid email address.</div>
          <span data-check-icon="inactive" data-check-icon-for="email"><img alt="✔" loading="lazy" src="img/done-icon.png"/></span>
         </div>
         <div class="feedback-input feedback-phone">
          <input class="area_code" name="phone_prefix" required="" type="hidden" value="{{ $preDial }}"/>
          <input name="country" type="hidden" value="{{ $computedIso }}"/>
          <input class="phone" name="phone_number" placeholder="Your telephone number" required="" type="tel" data-force-country="{{ $forceCountry ? '1' : '0' }}"/>
          <div data-error-status="inactive" data-for-error="phone">Please enter a valid phone number.</div>
          <span data-check-icon="inactive" data-check-icon-for="phone"><img alt="✔" loading="lazy" src="img/done-icon.png"/></span>
         </div>
         <!-- Country notice -->
         <div class="mt-1 text-xs text-black flex items-center gap-1" id="country-notice">
          <span>
           Currently only 
           <span class="inline-flex items-center">
             <span class="iti__flag" id="notice-flag" style="display: none;"></span>
             <!-- UK Flag SVG Fallback -->
             @if($computedIso === 'GB')
             <svg id="uk-flag-fallback" width="20" height="15" viewBox="0 0 60 30" style="display: inline-block; vertical-align: middle; margin-right: 4px;">
               <clipPath id="a"><path d="M0 0v30h60V0z"/></clipPath>
               <clipPath id="b"><path d="M30 15h30v15zv15H0zH0V0zV0h30z"/></clipPath>
               <g clip-path="url(#a)">
                 <path d="M0 0v30h60V0z" fill="#012169"/>
                 <path d="M0 0l60 30m0-30L0 30" stroke="#fff" stroke-width="6"/>
                 <path d="M0 0l60 30m0-30L0 30" clip-path="url(#b)" stroke="#C8102E" stroke-width="4"/>
                 <path d="M30 0v30M0 15h60" stroke="#fff" stroke-width="10"/>
                 <path d="M30 0v30M0 15h60" stroke="#C8102E" stroke-width="6"/>
               </g>
             </svg>
             @endif
           </span>
           <span id="notice-country">{{ $computedIso === 'GB' ? 'United Kingdom' : $computedIso }}</span> Nationals can register.
          </span>
         </div>
        </div>
        @if(config('services.turnstile.enabled') && config('services.turnstile.site_key'))
        <div class="feedback-mob-row captcha-container-main" id="captcha-block" style="display: none;">
          <div class="form-group" style="width:100%">
            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-theme="light"></div>
            <div data-error-status="inactive" data-for-error="captcha">Please verify that you are human.</div>
          </div>
        </div>
        @endif
        <div class="feedback-mob-row js-center">
         <div class="feedback-row">
          <label class="feedback-check" for="feedback-checkbox">
           <input class="feedback-checkbox-none" id="feedback-checkbox" required="" type="checkbox"/>
           <img alt="image" src="img/done-icon.png"/>
          </label>
          <div class="feedback-row-slogan">
           <p class="feedback-row-slogan-item">
            I agree with him
            <a target="_blank" class="modal-btn" data-modal="#modal-third" href="/privacy-policy">
             Privacy policy
            </a>
           </p>
          </div>
         </div>
         <div class="feedback-row">
          <label class="feedback-check" for="feedback-checkbox1">
           <input class="feedback-checkbox-none" id="feedback-checkbox1" required="" type="checkbox"/>
           <img alt="image" src="img/done-icon.png"/>
          </label>
          <div class="feedback-row-slogan">
           <p class="feedback-row-slogan-item">
            I am more than 18 years old
           </p>
          </div>
         </div>
        </div>
        <div class="feedback-sub">
         <input type="submit" value="🟣 Open a free account"/>
        </div>
        <div class="alert alert-success font-bold hidden" id="signup-success-message" role="alert" style="margin-top:12px; text-align:center;"></div>
       </form>
      </div>
     </div>
    </div>
   </div>
  </section>
  <section class="our">
   <div class="container">
    <div class="row our-row">
     <div class="col-md-6 col-12">
      <div class="title-block">
       <h2 class="md-title">
        What Is Quantum Ai?
       </h2>
       <div class="gen-text">
        Quantum Ai is a dynamic investment platform offering full-scale brokerage services in

                            cryptocurrency, foreign exchange, stock markets, and contracts for difference (CFDs).

                            Engineered specifically for British investors, it combines financial precision with

                            AI-driven decision-making. With Quantum Ai, even new users can navigate volatile markets

                            confidently. The platform adapts in real-time, scanning thousands of data points to forecast

                            profitable trades and reduce exposure. Integrated with global trading networks, it provides

                            seamless access to high-performing assets.
       </div>
      </div>
     </div>
     <div class="col-md-6 col-12">
      <div class="our-search">
       <input placeholder="Search" type="text"/>
       <div class="our-search-icon">
        <img alt="image" src="img/search-icon.png"/>
       </div>
      </div>
     </div>
     <div class="col-12">
      <div class="our-slider-container">
       <div class="our-slider">
        <div class="our-slider-item">
         <img alt="image" name="bitcoin" src="img/bitcoin_logo.png"/>
        </div>
        <div class="our-slider-item">
         <img alt="image" name="litecoin" src="img/litecoin_logo.png"/>
        </div>
        <div class="our-slider-item">
         <img alt="image" name="dogecoin" src="img/dogecoin_logo.png"/>
        </div>
        <div class="our-slider-item">
         <img alt="image" name="ethreum" src="img/ethreum_logo.png"/>
        </div>
        <div class="our-slider-item">
         <img alt="image" name="bitcoin" src="img/bitcoin_logo.png"/>
        </div>
        <div class="our-slider-item">
         <img alt="image" name="litecoin" src="img/litecoin_logo.png"/>
        </div>
        <div class="our-slider-item">
         <img alt="image" name="dogecoin" src="img/dogecoin_logo.png"/>
        </div>
        <div class="our-slider-item">
         <img alt="image" name="ethreum" src="img/ethreum_logo.png"/>
        </div>
       </div>
       <div class="our-slider-direction">
        <div class="our-slider-left-arrow">
         <img alt="image" src="img/our-left-arrow.png"/>
        </div>
        <div class="our-slider-right-arrow">
         <img alt="image" src="img/our-right-arrow.png"/>
        </div>
       </div>
      </div>
     </div>
    </div>
    <div class="row our-row">
     <div class="col-xl-6 col-12 order-xl-0 order-1">
      <div class="gen-text-block wow fadeInLeft">
       <h2 class="md-title">
        Quantum Ai Trading: Precision Powered by Artificial Intelligence
       </h2>
       <div class="gen-text">
        The backbone of the Quantum Ai platform is its predictive engine-Ai Quantum-a learning

                            algorithm that evolves with every trade. It continually refines its models using real-time

                            financial data, market trends, and historical patterns. This AI does more than follow

                            charts; it anticipates movement across digital and traditional markets. Whether you're

                            trading crypto, stocks, or Forex, Quantum Ai trading provides users with custom strategies

                            that align with their financial goals.
        <br/>
        <br/>
       </div>
      </div>
     </div>
     <div class="col-xl-6 col-12 order-xl-1 order-0">
      <div class="our-image our-img-head wow fadeInRight">
       <img alt="image" src="img/devises.png"/>
      </div>
     </div>
    </div>
    <div class="row our-row">
     <div class="col-xl-6 col-12">
      <div class="our-image wow fadeInLeft">
       <img alt="image" src="img/our-img-one.png"/>
      </div>
     </div>
     <div class="col-xl-6 col-12">
      <div class="gen-text-block wow fadeInRight">
       <h2 class="md-title">
        Quantum Ai Reviews: Trusted by British Traders
       </h2>
       <div class="gen-text">
        <p>
         Quantum Ai reviews are overwhelmingly positive. British investors commend the

                                system’s ease-of-use, responsive AI features, and real returns.
        </p>
        <h3>
         <strong>
          Ai Quantum Real User Feedback from Coast to Coast
         </strong>
        </h3>
        <p>
         From Vancouver to Halifax, Quantum Ai users highlight consistent profits, a supportive

                                community, and fast withdrawals. Whether you're scaling a side hustle or managing a

                                large portfolio, the results speak volumes.
        </p>
        <h3>
         <strong>
          Reported Investment Outcomes
         </strong>
        </h3>
        <p>
         Many investors have doubled or tripled their initial capital within 90 days. These

                                outcomes are typically achieved by using Quantum Ai’s full suite of predictive

                                tools and automated trading systems.
        </p>
       </div>
       <div class="our-show-btn">
        Show everything
       </div>
      </div>
     </div>
    </div>
    <div class="row our-row">
     <div class="col-xl-6 col-12 order-xl-0 order-1">
      <div class="gen-text-block wow fadeInLeft">
       <h2 class="md-title">
        Quantum Ai Official Website: Regulation, Leadership &amp; Transparency
       </h2>
       <div class="gen-text">
        Quantum Ai operates under a regulated British entity, in line with federal financial

                            standards. The leadership team includes AI experts, hedge fund veterans, and fintech

                            innovators with a strong track record in investment management. Transparency is central to

                            Quantum Ai's ethos. The official website features detailed reports, system audits, and

                            real-time performance dashboards.
       </div>
       <div class="our-show-btn">
        Show everything
       </div>
      </div>
     </div>
     <div class="col-xl-6 col-12 order-xl-1 order-0">
      <div class="our-image wow fadeInRight">
       <img alt="image" src="img/our-img-three.png"/>
      </div>
     </div>
    </div>
    <div class="row our-row">
     <div class="col-xl-6 col-12">
      <div class="our-image wow fadeInLeft">
       <img alt="image" src="img/our-img-two.png"/>
      </div>
     </div>
     <div class="col-xl-6 col-12">
      <div class="gen-text-block wow fadeInRight">
       <h2 class="md-title">
        How to Get Started with Quantum Ai App
       </h2>
       <div class="gen-text">
        <p>
         New to Quantum Ai UK? Getting started is risk-free and straightforward. Try the full

                                platform through a demo mode before you commit.
        </p>
        <h3>
         <strong>
          Quantum Ai Login Process
         </strong>
        </h3>
        <p>
         Registration is simple: submit your name, email, and contact number. After verification,

                                you'll gain access to a custom dashboard featuring market analytics, AI configuration

                                tools, and performance stats-all within minutes.
        </p>
        <h3>
         <strong>
          Quantum Ai Investment Simulator
         </strong>
        </h3>
        <p>
         Use the demo account to test trading strategies without risk. The AI runs in simulated

                                market environments, giving you an accurate preview of how the system works in real

                                conditions.
        </p>
       </div>
      </div>
     </div>
    </div>
    <div class="row our-row">
     <div class="">
      <div class="gen-text-block wow fadeInRight">
       <h2 class="md-title">
        Around-the-Clock Help: Quantum Ai Support in UK
       </h2>
       <div class="gen-text">
        Quantum Ai UK provides 24/7 customer support. Whether you have technical questions,

                            trading concerns, or need onboarding help, multilingual experts are ready to assist. Premium

                            clients gain exclusive access to expert sessions, live trading events, and AI webinars

                            tailored to advanced investors.
       </div>
      </div>
     </div>
    </div>
    <div class="row our-row">
     <div class="col-12">
      <div class="gen-text-block wow fadeInRight">
       <h2 class="md-title">
        Quantum Ai Trading Platform: Features &amp; Deep Dive
       </h2>
       <p>
        The Quantum Ai Trading Platform offers British investors smart tools to trade crypto, Forex,

                            CFDs, and stocks with AI precision. Its real-time analytics, customizable dashboard, and

                            automated risk controls help users optimize returns while staying secure and informed.
       </p>
       <h3>
        <strong>
         Quantum Ai Reviews from British Users
        </strong>
       </h3>
       <p>
        💬 “Quantum Ai tripled my crypto investments within three months.” - Alex M.,

                            Toronto
        <br/>
        💬 “The AI’s forecasting accuracy is a game changer.” -

                            Chloe R., Montreal
        <br/>
        💬 “Withdrawals are instant, and the interface is

                            intuitive.” - Liam F., Calgary
        <br/>
        💬 “I started with the demo and was

                            investing live in less than a week.” - Olivia T., Ottawa
        <br/>
        💬 “Great

                            experience with Forex and stock trades!” - Noah W., Vancouver
       </p>
       <h3>
        <strong>
         Quantum Ai Performance Highlights
        </strong>
       </h3>
       <p>
        Over 55,000 British trust Quantum Ai. Reported ROI ranges between 180% to 240% within three

                            to six months. Over 85% of demo users proceed to live trading after seven days.
       </p>
       <h3>
        <strong>
         Adaptive Risk Controls
        </strong>
       </h3>
       <p>
        Quantum Ai's built-in risk management engine adjusts stop-loss and take-profit parameters

                            automatically. Users can select from multiple risk profiles based on their investment

                            strategy.
       </p>
       <h3>
        <strong>
         Investor Demographics &amp; Behavior
        </strong>
       </h3>
       <p>
        Most users are between 25-45 years old and include professionals, entrepreneurs, and

                            retirees. Quantum Ai is especially popular in Toronto, Ottawa, and Edmonton.
       </p>
       <h3>
        <strong>
         Global Asset Access
        </strong>
       </h3>
       <p>
        Quantum Ai enables access to crypto, Forex, major stocks, and global indices. It supports

                            real-time tracking, portfolio balancing, and AI-led reallocation for optimal results.
       </p>
       <h3>
        <strong>
         What’s Ahead for Quantum Ai Platform
        </strong>
       </h3>
       <p>
        Q4 2025 updates will include mobile app rollout, ETF support, AI signal integration, and an

                            investor-driven social trading network.
       </p>
       <br/>
       <br/>
       <h3 style="font-weight: bold; margin-top: 25px; margin-bottom: 15px; color:#ffffff">
        Why Quantum Ai Outranks the Competition
       </h3>
       <div class="gen-text" style="margin-bottom: 15px;">
        <div style="overflow-x: auto; margin: 20px 0;">
         <table class="contents-table" style="width: 100%; min-width: 500px; border-collapse: collapse; box-shadow: 0 2px 4px rgba(0,0,0,0.1); background-color: #fff;">
          <thead>
           <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <th style="padding: 15px; text-align: left; font-weight: 600; border-bottom: 2px solid #5a67d8;">
             Feature
            </th>
            <th style="padding: 15px; text-align: center; font-weight: 600; border-bottom: 2px solid #5a67d8;">
             Quantum Ai (UK)
            </th>
            <th style="padding: 15px; text-align: center; font-weight: 600; border-bottom: 2px solid #5a67d8;">
             Legacy App
            </th>
            <th style="padding: 15px; text-align: center; font-weight: 600; border-bottom: 2px solid #5a67d8;">
             Broker B
            </th>
           </tr>
          </thead>
          <tbody>
           <tr style="background-color: #ffffff; transition: background-color 0.3s;">
            <td style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0; font-weight: 500; color: #000000;">
             AI-Powered Trading
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #10b981; font-weight: 600;">
             ✅ Yes
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ❌ No
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ⚠️ Limited
            </td>
           </tr>
           <tr style="background-color: #f9fafb; transition: background-color 0.3s;">
            <td style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0; font-weight: 500; color: #000000;">
             ROI Potential
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #10b981; font-weight: 600;">
             200%+ (3-6 months)
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             80% yearly
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             Up to 100%
            </td>
           </tr>
           <tr style="background-color: #ffffff; transition: background-color 0.3s;">
            <td style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0; font-weight: 500; color: #000000;">
             24/7 British Support
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #10b981; font-weight: 600;">
             ✅ Yes
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ⚠️ Limited
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ❌ No
            </td>
           </tr>
           <tr style="background-color: #f9fafb; transition: background-color 0.3s;">
            <td style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0; font-weight: 500; color: #000000;">
             Crypto, Stocks, Forex Access
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #10b981; font-weight: 600;">
             ✅ Yes
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ⚠️ Some
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ✅ Yes
            </td>
           </tr>
           <tr style="background-color: #f9fafb; transition: background-color 0.3s;">
            <td style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0; font-weight: 500; color: #000000;">
             Free AI Demo Mode
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #10b981; font-weight: 600;">
             ✅ Yes
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ❌ No
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ⚠️ Yes
            </td>
           </tr>
           <tr style="background-color: #f9fafb; transition: background-color 0.3s;">
            <td style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0; font-weight: 500; color: #000000;">
             Licensed in UK
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #10b981; font-weight: 600;">
             ✅ Yes
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ❌ No
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ⚠️ Unknown
            </td>
           </tr>
           <tr style="background-color: #f9fafb; transition: background-color 0.3s;">
            <td style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0; font-weight: 500; color: #000000;">
             Public Performance Logs
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #10b981; font-weight: 600;">
             ✅ Yes
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ⚠️ On Demand
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ❌ No
            </td>
           </tr>
           <tr style="background-color: #f9fafb; transition: background-color 0.3s;">
            <td style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0; font-weight: 500; color: #000000;">
             Mobile Launch
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #10b981; font-weight: 600;">
             ✅ Q4 2025
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ❌ None
            </td>
            <td style="padding: 12px 15px; text-align: center; border-bottom: 1px solid #e2e8f0; color: #000000;">
             ⚠️ Beta
            </td>
           </tr>
          </tbody>
         </table>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </section>
  <section class="calculator">
   <div class="our-object">
    <img alt="image" src="img/our-object.png"/>
   </div>
   <div class="container">
    <div class="calculator-object">
     <img alt="image" src="img/calculator-object.png"/>
    </div>
    <div class="calculator-img">
     <img alt="image" class="active" src="img/calculator-img.png"/>
     <img alt="image" src="img/calc-change-img.png"/>
    </div>
    <div class="row calculator-row">
     <div class="col-12">
      <div class="title-block">
       <div class="big-title">
        Calculator
       </div>
       <h2 class="title">
        Calculator
       </h2>
      </div>
     </div>
     <div class="col-12">
      <div class="quiz">
       <div class="quiz-one quiz-item active">
        <div class="quiz-line">
         <div class="quiz-line-item active">
          1
         </div>
         <div class="quiz-line-item">
          2
         </div>
         <div class="quiz-line-item">
          3
         </div>
        </div>
        <p class="quiz-title">
         Choose a partner:
        </p>
        <div class="quiz-row quiz-select-container">
         <div class="quiz-select">
          <div class="quiz-select-arrow">
           <img alt="image" src="img/b-w-arrow.png"/>
          </div>
          <select id="" name="">
           <option value="10">
            Bitcoin
           </option>
           <option value="20">
            Litecoin
           </option>
           <option value="30">
            Dogecoin
           </option>
           <option value="40">
            Ethreum
           </option>
          </select>
         </div>
         <div class="quiz-percent">
          <span>
           10
          </span>
          %
         </div>
        </div>
        <div class="quiz-btn">
         <div class="quiz-btn-item first deactivated">
          <div class="quiz-btn-item-icon">
           <img alt="image" src="img/quiz-left-arrow.png"/>
          </div>
          <div class="quiz-btn-item-text">
           Rug
          </div>
         </div>
         <div class="quiz-btn-item last">
          <div class="quiz-btn-item-text">
           Further
          </div>
          <div class="quiz-btn-item-icon">
           <img alt="image" src="img/quiz-right-arrow.png"/>
          </div>
         </div>
        </div>
       </div>
       <div class="quiz-two quiz-item">
        <div class="quiz-line">
         <div class="quiz-line-item">
          1
         </div>
         <div class="quiz-line-item active">
          2
         </div>
         <div class="quiz-line-item">
          3
         </div>
        </div>
        <p class="quiz-title">
         As a coating period:
        </p>
        <div class="quiz-row">
         <div class="quiz-input">
          <input type="text" value="250"/>
          <div class="quiz-input-war">
           My value 250
          </div>
         </div>
         <div class="quiz-range">
          <input id="sampleSlider" type="text"/>
         </div>
        </div>
        <div class="quiz-btn">
         <div class="quiz-btn-item first">
          <div class="quiz-btn-item-icon">
           <img alt="image" src="img/quiz-left-arrow.png"/>
          </div>
          <div class="quiz-btn-item-text">
           Rug
          </div>
         </div>
         <div class="quiz-btn-item last">
          <div class="quiz-btn-item-text">
           Further
          </div>
          <div class="quiz-btn-item-icon">
           <img alt="image" src="img/quiz-right-arrow.png"/>
          </div>
         </div>
        </div>
       </div>
       <div class="quiz-three quiz-item">
        <div class="quiz-line">
         <div class="quiz-line-item">
          1
         </div>
         <div class="quiz-line-item">
          2
         </div>
         <div class="quiz-line-item active">
          3
         </div>
        </div>
        <p class="quiz-title">
         Choose the Exit method:
        </p>
        <div class="quiz-option">
         <div class="quiz-option-item">
          <label class="quiz-option-item-radio active" for="r1">
           <input id="r1" name="output" type="radio"/>
          </label>
          <div class="quiz-option-item-text">
           <p>
            Online from the map (Visa/Mastercard/Maestro)
           </p>
          </div>
         </div>
         <div class="quiz-option-item">
          <label class="quiz-option-item-radio" for="r2">
           <input id="r2" name="output" type="radio"/>
          </label>
          <div class="quiz-option-item-text">
           <p>
            Electroni Paris (youmonney / Qii, enz.)
           </p>
          </div>
         </div>
         <div class="quiz-option-item">
          <label class="quiz-option-item-radio" for="r3">
           <input id="r3" name="output" type="radio"/>
          </label>
          <div class="quiz-option-item-text">
           <p>
            to a cryptocurrency portfolio
           </p>
          </div>
         </div>
        </div>
        <div class="quiz-btn">
         <div class="quiz-btn-item first">
          <div class="quiz-btn-item-icon">
           <img alt="image" src="img/quiz-left-arrow.png"/>
          </div>
          <div class="quiz-btn-item-text">
           Rug
          </div>
         </div>
         <div class="quiz-btn-item last">
          <div class="quiz-btn-item-text">
           Further
          </div>
          <div class="quiz-btn-item-icon">
           <img alt="image" src="img/quiz-right-arrow.png"/>
          </div>
         </div>
        </div>
       </div>
       <div class="quiz-four quiz-item">
        <div class="quiz-icon">
         <div class="quiz-icon-loader">
          <img alt="image" src="img/loader.gif"/>
         </div>
         <div class="quiz-icon-item">
          <img alt="image" src="img/calc-done-icon.png"/>
         </div>
        </div>
        <div class="quiz-rocket">
         <img alt="image" src="img/rocket.png"/>
        </div>
        <p class="quiz-slogan">
         Success
         <span>
          <i>
           30
          </i>
          %
         </span>
        </p>
        <div class="quiz-btn-item last">
         <div class="quiz-btn-item-text">
          Leave your contact details
         </div>
        </div>
       </div>
       <div class="quiz-five quiz-item">
        <div class="quiz-five-close">
         <img alt="image" src="img/modal-close.png"/>
        </div>
        <form action="{{ route('leads.store') }}" class="black-feedback" data-form-type="modal" method="post">
         @csrf
         <div class="quiz-row">
          <div class="feedback-input">
           <input name="first_name" placeholder="Enter your firstname" required="" type="text" value=""/>
           <div data-error-status="inactive" data-for-error="first_name">Your first name is too short (at least 2 characters)</div>
           <span data-check-icon="inactive" data-check-icon-for="first_name"><img alt="✔" loading="lazy" src="img/done-icon.png"/></span>
          </div>
          <div class="feedback-input">
           <input name="last_name" placeholder="Enter your lastname" required="" type="text" value=""/>
           <div data-error-status="inactive" data-for-error="last_name">Your last name is too short (at least 2 characters)</div>
           <span data-check-icon="inactive" data-check-icon-for="last_name"><img alt="✔" loading="lazy" src="img/done-icon.png"/></span>
          </div>
         </div>
         <div class="quiz-row">
          <div class="feedback-input">
           <input name="email" placeholder="Enter e-mail address" required="" type="email" value=""/>
           <div data-error-status="inactive" data-for-error="email">Please enter a valid email address.</div>
           <span data-check-icon="inactive" data-check-icon-for="email"><img alt="✔" loading="lazy" src="img/done-icon.png"/></span>
          </div>
          <div class="feedback-input feedback-phone">
           <input class="area_code" name="phone_prefix" required="" type="hidden" value="{{ $preDial }}"/>
           <input name="country" type="hidden" value="{{ $computedIso }}"/>
           <input class="phone" name="phone_number" placeholder="Your phone" required="" type="tel" data-force-country="{{ $forceCountry ? '1' : '0' }}"/>
           <div data-error-status="inactive" data-for-error="phone">Please enter a valid phone number.</div>
           <span data-check-icon="inactive" data-check-icon-for="phone"><img alt="✔" loading="lazy" src="img/done-icon.png"/></span>
          </div>
         </div>
         <!-- Country notice for modal form -->
         <div class="mt-1 text-xs text-white flex items-center gap-1" id="country-notice-modal">
          <span>
           Currently only 
           <span class="inline-flex items-center">
             <span class="iti__flag" id="notice-flag-modal" style="display: none;"></span>
             <!-- UK Flag SVG Fallback -->
             @if($computedIso === 'GB')
             <svg id="uk-flag-fallback-modal" width="20" height="15" viewBox="0 0 60 30" style="display: inline-block; vertical-align: middle; margin-right: 4px;">
               <clipPath id="a-modal"><path d="M0 0v30h60V0z"/></clipPath>
               <clipPath id="b-modal"><path d="M30 15h30v15zv15H0zH0V0zV0h30z"/></clipPath>
               <g clip-path="url(#a-modal)">
                 <path d="M0 0v30h60V0z" fill="#012169"/>
                 <path d="M0 0l60 30m0-30L0 30" stroke="#fff" stroke-width="6"/>
                 <path d="M0 0l60 30m0-30L0 30" clip-path="url(#b-modal)" stroke="#C8102E" stroke-width="4"/>
                 <path d="M30 0v30M0 15h60" stroke="#fff" stroke-width="10"/>
                 <path d="M30 0v30M0 15h60" stroke="#C8102E" stroke-width="6"/>
               </g>
             </svg>
             @endif
           </span>
           <span id="notice-country-modal">{{ $computedIso === 'GB' ? 'United Kingdom' : $computedIso }}</span> Nationals can register.
          </span>
         </div>
         @if(config('services.turnstile.enabled') && config('services.turnstile.site_key'))
         <div class="quiz-row captcha-container-modal" id="captcha-block-modal" style="display: none;">
          <div class="form-group" style="width:100%">
            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-theme="light"></div>
            <div data-error-status="inactive" data-for-error="captcha">Please verify that you are human.</div>
          </div>
         </div>
         @endif
         <div class="quiz-row">
          <div class="feedback-row">
           <label class="feedback-check" for="feedback-checkbox3">
            <input class="feedback-checkbox-none" id="feedback-checkbox3" required="" type="checkbox"/>
            <img alt="image" src="img/done-icon.png"/>
           </label>
           <div class="feedback-row-slogan">
            <p class="feedback-row-slogan-item">
             Agree
             <a class="modal-btn" data-modal="#modal-third" href="/privacy-policy">
              Privacy policy
             </a>
            </p>
           </div>
          </div>
          <div class="feedback-row">
           <label class="feedback-check" for="feedback-checkbox4">
            <input class="feedback-checkbox-none" id="feedback-checkbox4" required="" type="checkbox"/>
            <img alt="image" src="img/done-icon.png"/>
           </label>
           <div class="feedback-row-slogan">
            <p class="feedback-row-slogan-item">
             I am more than 18 years old
            </p>
           </div>
          </div>
         </div>
         <input class="quiz-btn-item last deactivated" type="submit" value="Open the free account"/>
        <div class="alert alert-success font-bold hidden" id="modal-signup-success-message" role="alert" style="margin-top:12px; text-align:center;"></div>
        </form>
       </div>
      </div>
     </div>
    </div>
   </div>
  </section>
  <section class="customer">
   <div class="customer-object">
    <img alt="image" src="img/customer-object.png"/>
   </div>
   <div class="container">
    <div class="row">
     <div class="col-xl-9 col-12">
      <div class="customer-block">
       <div class="title-block">
        <h2 class="big-title">
         new customers
        </h2>
       </div>
       <div class="customer-slider-container">
        <div class="customer-slider">
         <div class="customer-slide">
          <div class="customer-slider-row">
           <div class="customer-slider-inner">
            <div class="customer-slider-inner-icon">
             <img alt="image" src="img/cus-slider-img1.jpg"/>
            </div>
            <p class="customer-slider-inner-title">
             Logan
            </p>
           </div>
           <div class="customer-slider-text">
            <p>
             "Since I became a member of the Blazepek -Reaction Platform, my return

                                                to have

                                                consecutive

                                                Excellent expectations. AI's insights are incredibly accurate

                                                and

                                                The user interface is flexible and intuitive. It was a breakthrough

                                                for

                                                My commercial journey. "
            </p>
           </div>
           <div class="customer-slide-light">
            <img alt="image" src="img/customer-slider-light.png"/>
           </div>
          </div>
          <div class="customer-slide-object">
           <img alt="image" src="img/customer-slider-object.png"/>
          </div>
         </div>
         <div class="customer-slide">
          <div class="customer-slider-row">
           <div class="customer-slider-inner">
            <p class="customer-slider-inner-title">
             Amelia
            </p>
           </div>
           <div class="customer-slider-text">
            <p>
             “BlazePeak -reaction UK gave me confidence

                                                View crypto

                                                Investments. Real -Time -Response Signals in real time

                                                Help me act

                                                Opportunities immediately. I love the support of 24/7 - they actually

                                                Answer and help quickly! "
            </p>
           </div>
           <div class="customer-slide-light">
            <img alt="image" src="img/customer-slider-light.png"/>
           </div>
          </div>
          <div class="customer-slide-object">
           <img alt="image" src="img/customer-slider-object.png"/>
          </div>
         </div>
         <div class="customer-slide">
          <div class="customer-slider-row">
           <div class="customer-slider-inner">
            <div class="customer-slider-inner-icon">
             <img alt="image" src="img/cus-slider-img3.jpg"/>
            </div>
            <p class="customer-slider-inner-title">
             Daniel
            </p>
           </div>
           <div class="customer-slider-text">
            <p>
             "I was skeptical in the beginning, but Blazepek reaction reviews

                                                were right

                                                "That

                                                The platform is the real deal. Analytics on BlazePeak Reaction

                                                keep me

                                                Updated

                                                of

                                                Clear market data and my portfolio grew faster than at

                                                any other

                                                employ. "
            </p>
           </div>
           <div class="customer-slide-light">
            <img alt="image" src="img/customer-slider-light.png"/>
           </div>
          </div>
          <div class="customer-slide-object">
           <img alt="image" src="img/customer-slider-object.png"/>
          </div>
         </div>
        </div>
        <div class="customer-slider-direction">
         <div class="customer-slider-left-arrow">
          <img alt="image" src="img/our-left-arrow.png"/>
         </div>
         <div class="customer-slider-right-arrow">
          <img alt="image" src="img/our-right-arrow.png"/>
         </div>
        </div>
       </div>
      </div>
     </div>
     <div class="col-xl-3 col-12">
      <div class="customer-img">
       <img alt="image" src="img/customer-img.png"/>
      </div>
     </div>
    </div>
   </div>
  </section>
  <section class="our">
   <div class="container">
    <div class="row our-row">
     <div class="col-12">
      <div class="gen-text-block wow fadeInRight">
       <h2 class="md-title">
        Frequently Asked Questions
       </h2>
       <h3>
        <strong>
         Is Quantum Ai Legit in UK?
        </strong>
       </h3>
       <p>
        Yes, Quantum Ai operates under British regulatory frameworks and is backed by an experienced

                            fintech company.
       </p>
       <h3>
        <strong>
         Do I need trading experience to use Quantum Ai?
        </strong>
       </h3>
       <p>
        Not at all. The Quantum Ai App is designed for all levels, with tutorial guides, simulated

                            accounts, and automated trade functions.
       </p>
       <h3>
        <strong>
         How much can I make with Quantum Ai investing?
        </strong>
       </h3>
       <p>
        Returns vary by strategy, but average ROI is over 200% within 90 to 120 days.
       </p>
       <h3>
        <strong>
         Is Quantum Ai secure?
        </strong>
       </h3>
       <p>
        Yes. It offers encryption, 2FA, and cold wallet security to protect user data and assets.
       </p>
       <h3>
        <strong>
         Does Quantum Ai provide support for British clients?
        </strong>
       </h3>
       <p>
        Yes. Support is available 24/7 in both English and French.
       </p>
       <h3>
        <strong>
         Can I use Quantum Ai without depositing money?
        </strong>
       </h3>
       <p>
        Yes. The platform includes a no-cost demo feature for simulated investing before real funds

                            are committed.
       </p>
      </div>
     </div>
    </div>
   </div>
  </section>
  <section class="review">
   <div class="container">
    <div class="row">
     <div class="col-12">
      <div class="review-block">
       <div class="title-block">
        <h2 class="title">
         Reviews
        </h2>
       </div>
      </div>
     </div>
    </div>
   </div>
   <div class="review-slider-container">
    <div class="review-slider">
     <div class="review-slider-item">
      <div class="info-video">
       <div class="review-header">
        <div class="review-header-item">
         <div class="review-header-item-icon">
          <img alt="image" src="img/usa-icon.png"/>
         </div>
         <div class="review-header-item-title">
          Edward
         </div>
        </div>
        <div class="review-header-item">
         <div class="review-header-item-text">
          Gain:
          <span>
           $ 6000
          </span>
         </div>
        </div>
       </div>
       <div class="review-content">
        <img alt="image" src="img/rew1.jpg"/>
       </div>
      </div>
     </div>
     <div class="review-slider-item">
      <div class="info-video">
       <div class="review-header">
        <div class="review-header-item">
         <div class="review-header-item-icon">
          <img alt="image" src="img/usa-icon.png"/>
         </div>
         <div class="review-header-item-title">
          Mike
         </div>
        </div>
        <div class="review-header-item">
         <div class="review-header-item-text">
          Gain:
          <span>
           $ 3000
          </span>
         </div>
        </div>
       </div>
       <div class="review-content">
        <img alt="image" src="img/rew3.jpg"/>
       </div>
      </div>
     </div>
     <div class="review-slider-item">
      <div class="info-video">
       <div class="review-header">
        <div class="review-header-item">
         <div class="review-header-item-icon">
          <img alt="image" src="img/usa-icon.png"/>
         </div>
         <div class="review-header-item-title">
          Volume
         </div>
        </div>
        <div class="review-header-item">
         <div class="review-header-item-text">
          Gain:
          <span>
           $ 9000
          </span>
         </div>
        </div>
       </div>
       <div class="review-content">
        <img alt="image" src="img/rew2.jpg"/>
       </div>
      </div>
     </div>
     <div class="review-slider-item">
      <div class="info-video">
       <div class="review-header">
        <div class="review-header-item">
         <div class="review-header-item-icon">
          <img alt="image" src="img/usa-icon.png"/>
         </div>
         <div class="review-header-item-title">
          Account
         </div>
        </div>
        <div class="review-header-item">
         <div class="review-header-item-text">
          Gain:
          <span>
           $ 7000
          </span>
         </div>
        </div>
       </div>
       <div class="review-content">
        <img alt="image" src="img/rew4.jpg"/>
       </div>
      </div>
     </div>
    </div>
    <div class="review-slider-direction">
     <div class="review-slider-left-arrow">
      <img alt="image" src="img/our-left-arrow.png"/>
     </div>
     <div class="review-slider-right-arrow">
      <img alt="image" src="img/our-right-arrow.png"/>
     </div>
    </div>
   </div>
  </section>
  <footer class="footer">
   <div class="footer-bg">
    <img alt="image" src="img/footer-bg.png"/>
   </div>
   <div class="container">
    <div class="row">
     <div class="col-md-6 col-12">
      <div class="f-one">
       <p class="f-title">
        FINOTRAZE
       </p>
       <div class="f-link-block">
        <a class="f-link" href="/privacy-policy">
         Privacy Policy
        </a>
       </div>
       <div class="f-link-block">
        <a class="f-link" href="/terms">
         Terms and Conditions
        </a>
       </div>
       <!-- <div class="f-link-block">
        <a class="f-link" href="/contacts">
         Create an account
        </a>
       </div>
       <div class="f-link-block">
        <a class="f-link" href="/about">
         About us
        </a>
       </div> -->
      </div>
     </div>
     <div class="col-md-6 col-12">
      <div class="f-two">
       <div class="f-block">
        <div class="f-icon">
         <img alt="image" src="img/location-icon.png"/>
        </div>
        <div class="f-text">
            37 Jewry Street London United Kingdon EC3N 2ER
        </div>
       </div>
       <a class="f-block" href="{{ route('home') }}">
        <div class="f-icon">
         <img alt="image" src="img/mail-icon.png"/>
        </div>
        <div class="f-text">
         <span class="__cf_email__" data-cfemail="deadabaeaeb1acaa9eafabbfb0aaabb3bfb7f0bdb1b3">
          [email protected]
         </span>
        </div>
       </a>
      </div>
     </div>
    </div>
   </div>
  </footer>
  <script data-cfasync="false" src="js/email-decode.min.js">
  </script>
  <script>
   // Geo-based default for phone country code & flag without changing existing scripts
   (function () {
     var phoneInput = document.querySelector('form.form-registration input.phone');
     var areaInput = document.querySelector('form.form-registration input.area_code');
     if (!phoneInput) { return; }

     // ISO2 -> dial code map (expanded so fallback works when geo API is blocked)
    var DIAL_MAP = {
      'US': '1', 'CA': '1', 'GB': '44', 'IE': '353', 'AU': '61', 'NZ': '64',
      'BE': '32', 'NL': '31', 'DE': '49', 'FR': '33', 'ES': '34', 'PT': '351', 'IT': '39', 'AT': '43', 'CH': '41',
      'SE': '46', 'NO': '47', 'DK': '45', 'FI': '358', 'PL': '48', 'CZ': '420', 'RO': '40', 'HU': '36', 'GR': '30', 'BG': '359',
      'PH': '63', 'SG': '65', 'MY': '60', 'ID': '62', 'TH': '66', 'VN': '84', 'JP': '81', 'KR': '82', 'IN': '91', 'AE': '971', 'SA': '966', 'TR': '90',
      'MX': '52', 'BR': '55', 'AR': '54', 'CL': '56', 'CO': '57',
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
           Array.from(flagWrap.classList).forEach(function (c) {
             if (c.indexOf('iti__') === 0 && c !== 'iti__flag') { flagWrap.classList.remove(c); }
           });
           flagWrap.classList.add('iti__' + String(iso2).toLowerCase());
         }
       } catch (e) { /* no-op */ }
     }

    function updateNotice(iso2, dial) {
      try {
        var iso = iso2 ? String(iso2).toUpperCase() : null;
        var fallbackMap = { 'PH':'Philippines','US':'United States','SG':'Singapore','GB':'United Kingdom','AE':'United Arab Emirates','IN':'India','BE':'Belgium','FR':'France','DE':'Germany','NL':'Netherlands','ES':'Spain','IT':'Italy','SE':'Sweden','NO':'Norway','DK':'Denmark','FI':'Finland','PL':'Poland','IE':'Ireland','PT':'Portugal','RO':'Romania','HU':'Hungary','GR':'Greece','BG':'Bulgaria','AT':'Austria','CH':'Switzerland','AU':'Australia','NZ':'New Zealand','MX':'Mexico','BR':'Brazil','AR':'Argentina','CL':'Chile','CO':'Colombia','ZA':'South Africa','NG':'Nigeria','EG':'Egypt','JP':'Japan','KR':'South Korea','MY':'Malaysia','ID':'Indonesia','TH':'Thailand','VN':'Vietnam','TR':'Turkey','SA':'Saudi Arabia','CA':'Canada','IL':'Israel' };
        var pretty = null;
        try { if (window.Intl && typeof Intl.DisplayNames === 'function') { var dn = new Intl.DisplayNames(['en'], { type: 'region' }); pretty = dn.of(iso); } } catch (e) {}
        var countryEl = document.getElementById('notice-country'); if (countryEl && iso) { countryEl.textContent = pretty || fallbackMap[iso] || iso; }
        var flagEl = document.getElementById('notice-flag'); if (flagEl && iso) {
          Array.from(flagEl.classList).forEach(function (c) { if (c.indexOf('iti__') === 0 && c !== 'iti__flag') { flagEl.classList.remove(c); } });
          flagEl.classList.add('iti__' + iso.toLowerCase());
        }
        var countryHidden = document.querySelector('form.form-registration input[name="country"]'); if (countryHidden && iso) countryHidden.value = iso;
        var areaHidden = document.querySelector('form.form-registration input.area_code'); if (areaHidden && dial) areaHidden.value = String(dial).replace('+','');
      } catch (e) { /* no-op */ }
    }

     function applyGeo(iso2, callingCode) {
       var iso = iso2 ? String(iso2).toUpperCase() : null;
       var dial = callingCode || (iso && DIAL_MAP[iso]) || null;

      try {
        if (window.intlTelInputGlobals && typeof window.intlTelInputGlobals.getInstance === 'function') {
          var iti = window.intlTelInputGlobals.getInstance(phoneInput);
          if (iti && iso) { iti.setCountry(iso.toLowerCase()); }
        } else if (typeof window.intlTelInput === 'function') {
          var iti2; try { iti2 = window.intlTelInput(phoneInput, { initialCountry: iso ? iso.toLowerCase() : undefined, separateDialCode: true }); } catch(e){}
          if (iti2 && iti2.setCountry && iso) { iti2.setCountry(iso.toLowerCase()); }
        } else if (window.jQuery && jQuery.fn && typeof jQuery.fn.intlTelInput === 'function') {
          try { jQuery(phoneInput).intlTelInput('setCountry', iso.toLowerCase()); } catch(e){}
        } else { manualUiUpdate(iso, dial); }
      } catch (e) { manualUiUpdate(iso, dial); }

       if (areaInput && dial) { areaInput.value = String(dial).replace('+',''); }
       updateNotice(iso, dial);
     }

     function enforce(iso2, callingCode) {
       var iso = iso2 ? String(iso2).toUpperCase() : null;
       var dial = callingCode || (iso && DIAL_MAP[iso]) || null;
       var elapsed = 0; var step = 100; var max = 10000;
       var t = setInterval(function(){
         var currentDial = (document.querySelector('.iti__selected-dial-code')||{}).textContent || '';
         var needDial = dial ? ('+'+String(dial)) : null;
         if (needDial && currentDial !== needDial) { applyGeo(iso, dial); }
         elapsed += step; if (elapsed >= max) { clearInterval(t); }
       }, step);
     }

     function fetchGeoAndApply() {
      fetch('https://ipwho.is/?fields=country_code,calling_code')
        .then(function (r) { return r.json(); })
        .then(function (data) { var iso = data && data.country_code; var dial = data && data.calling_code; applyGeo(iso, dial); })
        .catch(function () { /* ignore */ });
    }

     function whenPhoneUiReady(cb) {
       var tries = 0; var maxTries = 50; var interval = setInterval(function () {
         tries++;
         var ready = phoneInput.closest('.iti') && phoneInput.closest('.iti').querySelector('.iti__selected-dial-code') || 
                     phoneInput.closest('.iti') && phoneInput.closest('.iti').querySelector('[class*="dial-code"]') ||
                     document.querySelector('.iti__selected-dial-code') || document.querySelector('[class*="dial-code"]') ||
                   (window.intlTelInputGlobals && typeof window.intlTelInputGlobals.getInstance === 'function' && window.intlTelInputGlobals.getInstance(phoneInput));
         if (ready || tries >= maxTries) { clearInterval(interval); cb(); }
       }, 50);
       try { var obs = new MutationObserver(function () { var readyNow = document.querySelector('.iti__selected-dial-code') || document.querySelector('[class*="dial-code"]'); if (readyNow) { obs.disconnect(); cb(); } }); obs.observe(document.body, { childList: true, subtree: true }); } catch (e) {}
     }

    var params = new URLSearchParams(window.location.search);
    function debugLog(){ /* disabled */ }
    var overrideIso = params.get('__country') || params.get('geo');
    var metaForceEl = document.querySelector('meta[name="forceCountry"]');
    var isForced = metaForceEl && metaForceEl.getAttribute('content') === '1';
    whenPhoneUiReady(function(){
      var metaEl = document.querySelector('meta[name="isoCode"]');
      var metaIso = metaEl && metaEl.getAttribute('content');
      if (isForced && metaIso) { applyGeo(metaIso, DIAL_MAP[String(metaIso).toUpperCase()] || null); enforce(metaIso, DIAL_MAP[String(metaIso).toUpperCase()] || null); return; }
      if (overrideIso) { var isoUp = String(overrideIso).toUpperCase(); var dial = DIAL_MAP[isoUp] || null; applyGeo(isoUp, dial); enforce(isoUp, dial); }
      else { fetchGeoAndApply(); }
    });

    window.traderaiSetGeoTest = function (iso2, callingCode) { whenPhoneUiReady(function(){ applyGeo(iso2, callingCode); enforce(iso2, callingCode); }); };
   })();
  </script>
  <script>
   // Lightweight client-side validation for Email and Phone + AJAX submit
   (function(){
     var form = document.querySelector('form.form-registration');
     if (!form) return;

     var el = {
       email: form.querySelector('input[name="email"]'),
       phone: form.querySelector('input[name="phone_number"]'),
       area: form.querySelector('input[name="phone_prefix"]'),
       alert: form.querySelector('.alert.alert-danger'),
     };

     function showAlert(msg){
       if(!el.alert){
         // Create a lightweight inline alert if not present
         var a = document.createElement('div'); a.className = 'alert alert-danger'; a.style.marginTop = '8px';
         form.insertBefore(a, form.firstChild); el.alert = a;
       }
       el.alert.textContent = msg; el.alert.classList.remove('hidden'); el.alert.setAttribute('role','alert');
     }
     function hideAlert(){ if(!el.alert) return; el.alert.textContent = ''; el.alert.classList.add('hidden'); }

     function setCheckIcon(name, active){ var c = form.querySelector('[data-check-icon-for="'+name+'"][data-check-icon]'); if (c){ c.setAttribute('data-check-icon', active ? 'active' : 'inactive'); } }
     function setError(name, message){ var eEl = form.querySelector('[data-for-error="'+name+'"][data-error-status]'); if (eEl){ eEl.setAttribute('data-error-status','active'); eEl.style.display='block'; if(message){ eEl.textContent = message; } } setCheckIcon(name, false); }
     function clearError(name){ var eEl = form.querySelector('[data-for-error="'+name+'"][data-error-status]'); if (eEl){ eEl.setAttribute('data-error-status','inactive'); eEl.style.display='none'; } setCheckIcon(name, true); }

     function debounce(fn, wait){ var t; return function(){ var args = arguments, ctx = this; clearTimeout(t); t = setTimeout(function(){ fn.apply(ctx, args); }, wait); }; }

     function validateEmail(opts){ var silent = opts && opts.silent; if(!el.email) return true; var v = (el.email.value||'').trim(); var ok = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v); if (ok) { clearError('email'); } else { if (silent) setCheckIcon('email', false); else setError('email','Please enter a valid email address.'); } return ok; }

     function getActiveIso(){ var metaEl = document.querySelector('meta[name="isoCode"]'); return (metaEl && metaEl.getAttribute('content') || '').toUpperCase(); }

     function validatePhone(opts){ var silent = opts && opts.silent; if(!el.phone) return true; var v = String(el.phone.value||''); var digits = v.replace(/\D/g,''); var iso = getActiveIso(); var ok; switch(iso){ case 'GB': ok = /^(0?7\d{9})$/.test(digits); break; case 'US': ok = /^\d{10}$/.test(digits); break; case 'IL': ok = /^(0?5\d{8})$/.test(digits); break; case 'AE': ok = /^(0?5\d{7,8})$/.test(digits); break; default: ok = digits.length >= 6 && digits.length <= 14; } if (ok) { clearError('phone'); } else { if (silent) setCheckIcon('phone', false); else setError('phone','Please enter a valid phone number.'); } return ok; }

     el.email && el.email.addEventListener('blur', function(){ hideAlert(); validateEmail({silent:false}); });
     el.phone && el.phone.addEventListener('blur', function(){ hideAlert(); validatePhone({silent:false}); });
     el.email && el.email.addEventListener('input', debounce(function(){ validateEmail({silent:true}); }, 200));
     el.phone && el.phone.addEventListener('input', debounce(function(){ validatePhone({silent:true}); }, 200));

     form.addEventListener('submit', function(ev){
      hideAlert();
      var okE = validateEmail({silent:false});
      var okP = validatePhone({silent:false});
      if (!(okE && okP)) { ev.preventDefault(); showAlert(!okE ? 'Invalid email address.' : 'Invalid phone number.'); return; }

      ev.preventDefault();
      var btn = form.querySelector('button[type="submit"], input[type="submit"]'); btn && (btn.disabled = true);
      var successEl = document.getElementById('signup-success-message'); if (successEl) { successEl.classList.add('hidden'); successEl.textContent = 'Submitting…'; }

      var fd = new FormData(form);
      var token = form.querySelector('input[name="_token"]')?.value || '';
      fetch(form.action, { method: 'POST', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': token }, body: fd, credentials: 'same-origin' })
      .then(async function(r){ if (!r.ok) { var text = ''; try { text = await r.text(); } catch(e){} try { var payload = text ? JSON.parse(text) : null; if (r.status === 422 && payload && payload.errors) { var handled = false; if (payload.errors.email) { setError('email', payload.errors.email[0] || ''); handled = true; } if (payload.errors.phone_number || payload.errors.phone) { var msg = (payload.errors.phone_number && payload.errors.phone_number[0]) || (payload.errors.phone && payload.errors.phone[0]) || ''; setError('phone', msg || 'Please enter a valid phone number.'); setCheckIcon('phone', false); handled = true; } if (payload.errors['cf-turnstile-response']) { var cmsg = payload.errors['cf-turnstile-response'][0] || 'Please verify that you are human.'; setError('captcha', cmsg); try { if (window.turnstile && typeof window.turnstile.reset === 'function') { window.turnstile.reset(); } } catch(e){} handled = true; } if (!handled) { var firstKey = Object.keys(payload.errors)[0]; var firstMsg = firstKey ? (payload.errors[firstKey][0] || '') : ''; showAlert(firstMsg || 'Please check your input and try again.'); } btn && (btn.disabled = false); if (successEl){ successEl.classList.add('hidden'); } return Promise.reject(); } if (r.status === 429) { showAlert('Too many attempts. Please wait a moment and try again.'); btn && (btn.disabled = false); if (successEl){ successEl.classList.add('hidden'); } return Promise.reject(); } showAlert('Submission failed. Please try again.'); btn && (btn.disabled = false); if (successEl){ successEl.classList.add('hidden'); } return Promise.reject(); } catch(e) { showAlert('Submission failed. Please try again.'); btn && (btn.disabled = false); if (successEl){ successEl.classList.add('hidden'); } return Promise.reject(); } } return r.json(); })
      .then(function(data){ if (successEl){ successEl.innerHTML = "Thank you for sharing your information with us!<br>Our team truly appreciates the time you took, and we’ll be reaching out within 48 hours to assist you further."; successEl.style.fontWeight = '700'; successEl.style.textAlign = 'center'; successEl.classList.remove('hidden'); }
        var target = data && data.redirect; if (target) { var splash = "{{ route('redirect') }}"; var leadId = data && data.lead_id ? String(data.lead_id) : ''; var url = splash + '?to=' + encodeURIComponent(String(target)) + '&s=5' + (leadId ? ('&lead_id=' + encodeURIComponent(leadId)) : ''); window.location.href = url; } })
      .catch(function(){ showAlert('Submission failed. Please try again.'); btn && (btn.disabled = false); if (successEl){ successEl.classList.add('hidden'); } });
    });
   })();

   // Modal form validation (identical to main form)
   (function(){
     var modalForm = document.querySelector('form.black-feedback');
     if (!modalForm) return;

     var modalEl = {
       email: modalForm.querySelector('input[name="email"]'),
       phone: modalForm.querySelector('input[name="phone_number"]'),
       area: modalForm.querySelector('input[name="phone_prefix"]'),
       alert: modalForm.querySelector('.alert.alert-danger'),
     };

     function showModalAlert(msg){
       if(!modalEl.alert){
         // Create a lightweight inline alert if not present
         var a = document.createElement('div'); a.className = 'alert alert-danger'; a.style.marginTop = '8px';
         modalForm.insertBefore(a, modalForm.firstChild); modalEl.alert = a;
       }
       modalEl.alert.textContent = msg; modalEl.alert.classList.remove('hidden'); modalEl.alert.setAttribute('role','alert');
     }
     function hideModalAlert(){ if(!modalEl.alert) return; modalEl.alert.textContent = ''; modalEl.alert.classList.add('hidden'); }

     function setModalCheckIcon(name, active){ var c = modalForm.querySelector('[data-check-icon-for="'+name+'"][data-check-icon]'); if (c){ c.setAttribute('data-check-icon', active ? 'active' : 'inactive'); } }
     function setModalError(name, message){ var eEl = modalForm.querySelector('[data-for-error="'+name+'"][data-error-status]'); if (eEl){ eEl.setAttribute('data-error-status','active'); eEl.style.display='block'; if(message){ eEl.textContent = message; } } setModalCheckIcon(name, false); }
     function clearModalError(name){ var eEl = modalForm.querySelector('[data-for-error="'+name+'"][data-error-status]'); if (eEl){ eEl.setAttribute('data-error-status','inactive'); eEl.style.display='none'; } setModalCheckIcon(name, true); }

     function modalDebounce(fn, wait){ var t; return function(){ var args = arguments, ctx = this; clearTimeout(t); t = setTimeout(function(){ fn.apply(ctx, args); }, wait); }; }

     function validateModalEmail(opts){ var silent = opts && opts.silent; if(!modalEl.email) return true; var v = (modalEl.email.value||'').trim(); var ok = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v); if (ok) { clearModalError('email'); } else { if (silent) setModalCheckIcon('email', false); else setModalError('email','Please enter a valid email address.'); } return ok; }

     function getModalActiveIso(){ var metaEl = document.querySelector('meta[name="isoCode"]'); return (metaEl && metaEl.getAttribute('content') || '').toUpperCase(); }

     function validateModalPhone(opts){ var silent = opts && opts.silent; if(!modalEl.phone) return true; var v = String(modalEl.phone.value||''); var digits = v.replace(/\D/g,''); var iso = getModalActiveIso(); var ok; switch(iso){ case 'GB': ok = /^(0?7\d{9})$/.test(digits); break; case 'US': ok = /^\d{10}$/.test(digits); break; case 'IL': ok = /^(0?5\d{8})$/.test(digits); break; case 'AE': ok = /^(0?5\d{7,8})$/.test(digits); break; default: ok = digits.length >= 6 && digits.length <= 14; } if (ok) { clearModalError('phone'); } else { if (silent) setModalCheckIcon('phone', false); else setModalError('phone','Please enter a valid phone number.'); } return ok; }

     modalEl.email && modalEl.email.addEventListener('blur', function(){ hideModalAlert(); validateModalEmail({silent:false}); });
     modalEl.phone && modalEl.phone.addEventListener('blur', function(){ hideModalAlert(); validateModalPhone({silent:false}); });
     modalEl.email && modalEl.email.addEventListener('input', modalDebounce(function(){ validateModalEmail({silent:true}); }, 200));
     modalEl.phone && modalEl.phone.addEventListener('input', modalDebounce(function(){ validateModalPhone({silent:true}); }, 200));

     modalForm.addEventListener('submit', function(ev){
      hideModalAlert();
      var okE = validateModalEmail({silent:false});
      var okP = validateModalPhone({silent:false});
      if (!(okE && okP)) { ev.preventDefault(); showModalAlert(!okE ? 'Invalid email address.' : 'Invalid phone number.'); return; }

      // Check CAPTCHA for modal form
      var captchaBlock = document.getElementById('captcha-block-modal');
      if (captchaBlock) {
        var captchaResponse = modalForm.querySelector('input[name="cf-turnstile-response"]');
        if (!captchaResponse || !captchaResponse.value) {
          ev.preventDefault();
          setModalError('captcha', 'Please verify that you are human.');
          showModalAlert('Please complete the CAPTCHA verification.');
          return;
        }
      }

      ev.preventDefault();
      var btn = modalForm.querySelector('button[type="submit"], input[type="submit"]'); btn && (btn.disabled = true);
      var successEl = document.getElementById('modal-signup-success-message'); if (successEl) { successEl.classList.add('hidden'); successEl.textContent = 'Submitting…'; }

      var fd = new FormData(modalForm);
      var token = modalForm.querySelector('input[name="_token"]')?.value || '';
      fetch(modalForm.action, { method: 'POST', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': token }, body: fd, credentials: 'same-origin' })
      .then(async function(r){ if (!r.ok) { var text = ''; try { text = await r.text(); } catch(e){} try { var payload = text ? JSON.parse(text) : null; if (r.status === 422 && payload && payload.errors) { var handled = false; if (payload.errors.email) { setModalError('email', payload.errors.email[0] || ''); handled = true; } if (payload.errors.phone_number || payload.errors.phone) { var msg = (payload.errors.phone_number && payload.errors.phone_number[0]) || (payload.errors.phone && payload.errors.phone[0]) || ''; setModalError('phone', msg || 'Please enter a valid phone number.'); setModalCheckIcon('phone', false); handled = true; } if (payload.errors['cf-turnstile-response']) { var cmsg = payload.errors['cf-turnstile-response'][0] || 'Please verify that you are human.'; setModalError('captcha', cmsg); try { if (window.turnstile && typeof window.turnstile.reset === 'function') { window.turnstile.reset(); } } catch(e){} handled = true; } if (!handled) { var firstKey = Object.keys(payload.errors)[0]; var firstMsg = firstKey ? (payload.errors[firstKey][0] || '') : ''; showModalAlert(firstMsg || 'Please check your input and try again.'); } btn && (btn.disabled = false); if (successEl){ successEl.classList.add('hidden'); } return Promise.reject(); } if (r.status === 429) { showModalAlert('Too many attempts. Please wait a moment and try again.'); btn && (btn.disabled = false); if (successEl){ successEl.classList.add('hidden'); } return Promise.reject(); } showModalAlert('Submission failed. Please try again.'); btn && (btn.disabled = false); if (successEl){ successEl.classList.add('hidden'); } return Promise.reject(); } catch(e) { showModalAlert('Submission failed. Please try again.'); btn && (btn.disabled = false); if (successEl){ successEl.classList.add('hidden'); } return Promise.reject(); } } return r.json(); })
      .then(function(data){ if (successEl){ successEl.innerHTML = "Thank you for sharing your information with us!<br>Our team truly appreciates the time you took, and we'll be reaching out within 48 hours to assist you further."; successEl.style.fontWeight = '700'; successEl.style.textAlign = 'center'; successEl.classList.remove('hidden'); }
        var target = data && data.redirect; if (target) { var splash = "{{ route('redirect') }}"; var leadId = data && data.lead_id ? String(data.lead_id) : ''; var url = splash + '?to=' + encodeURIComponent(String(target)) + '&s=5' + (leadId ? ('&lead_id=' + encodeURIComponent(leadId)) : ''); window.location.href = url; } })
      .catch(function(){ showModalAlert('Submission failed. Please try again.'); btn && (btn.disabled = false); if (successEl){ successEl.classList.add('hidden'); } });
     });
   })();
  </script>
  <script src="js/jquery-3.6.0.min.js">
  </script>
  <script src="js/slick.min.js" type="text/javascript">
  </script>
  <script src="js/rSlider.min.js">
  </script>
  <script src="js/wow.min.js">
  </script>
  @if(config('services.turnstile.enabled') && config('services.turnstile.site_key'))
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
  @endif
  <script>
   new WOW().init();
  </script>
  <script src="js/script.js">
  </script>
  <style>
   /* Hide check icon when inactive and hide error blocks when inactive */
   [data-check-icon][data-check-icon="inactive"] { display: none !important; }
   [data-for-error][data-error-status="inactive"] { display: none !important; }
   /* When Priority Country is forced, hide/disable intl-tel-input country UI (match FXD) */
   .force-no-country .iti__country-list { display: none !important; }
   .force-no-country .iti__selected-flag { pointer-events: none; cursor: default; }
   .force-no-country .iti__arrow { display: none !important; }
   .iti__selected-flag {

            z-index: 1000 !important;

        }



        .iti--separate-dial-code .iti__selected-flag {

            color: black !important;

        }

        /* Modal form specific styling - white country code text */
        .black-feedback[data-form-type="modal"] .iti--separate-dial-code .iti__selected-flag {
            color: white !important;
        }
        .black-feedback[data-form-type="modal"] .iti__country .iti__standard {
            color: white !important;
        }
        .black-feedback[data-form-type="modal"] .iti__country {
            color: white !important;
        }
        .black-feedback[data-form-type="modal"] .iti__dial-code {
            color: white !important;
        }

        /* Modal form specific styling - remove white backgrounds and make all text white */
        .black-feedback[data-form-type="modal"] input[type="text"],
        .black-feedback[data-form-type="modal"] input[type="email"],
        .black-feedback[data-form-type="modal"] input[type="tel"],
        .black-feedback[data-form-type="modal"] input[type="password"],
        .black-feedback[data-form-type="modal"] input[type="number"],
        .black-feedback[data-form-type="modal"] textarea,
        .black-feedback[data-form-type="modal"] select {
            background-color: transparent !important;
            background-image: none !important;
            color: white !important;
            border-color: rgba(255, 255, 255, 0.3) !important;
        }
        
        /* Remove autofill background colors in modal form */
        .black-feedback[data-form-type="modal"] input:-webkit-autofill,
        .black-feedback[data-form-type="modal"] input:-webkit-autofill:hover,
        .black-feedback[data-form-type="modal"] input:-webkit-autofill:focus,
        .black-feedback[data-form-type="modal"] input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px transparent inset !important;
            -webkit-text-fill-color: white !important;
            background-color: transparent !important;
            background-image: none !important;
            transition: background-color 5000s ease-in-out 0s !important;
        }
        
        /* Remove autofill background colors for Firefox */
        .black-feedback[data-form-type="modal"] input:-moz-autofill,
        .black-feedback[data-form-type="modal"] input:-moz-autofill:hover,
        .black-feedback[data-form-type="modal"] input:-moz-autofill:focus,
        .black-feedback[data-form-type="modal"] input:-moz-autofill:active {
            box-shadow: 0 0 0 30px transparent inset !important;
            -moz-text-fill-color: white !important;
            background-color: transparent !important;
            background-image: none !important;
        }
        
        /* Modal form placeholder text styling */
        .black-feedback[data-form-type="modal"] input::placeholder,
        .black-feedback[data-form-type="modal"] textarea::placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
            opacity: 1 !important;
        }
        
        /* Modal form placeholder text for Firefox */
        .black-feedback[data-form-type="modal"] input::-moz-placeholder,
        .black-feedback[data-form-type="modal"] textarea::-moz-placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
            opacity: 1 !important;
        }
        
        /* Modal form placeholder text for Internet Explorer */
        .black-feedback[data-form-type="modal"] input:-ms-input-placeholder,
        .black-feedback[data-form-type="modal"] textarea:-ms-input-placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
            opacity: 1 !important;
        }
        
        /* Modal form input focus styling */
        .black-feedback[data-form-type="modal"] input:focus,
        .black-feedback[data-form-type="modal"] textarea:focus,
        .black-feedback[data-form-type="modal"] select:focus {
            background-color: transparent !important;
            background-image: none !important;
            color: white !important;
            border-color: rgba(255, 255, 255, 0.6) !important;
            outline: none !important;
            box-shadow: none !important;
        }
        
        /* Modal form error message styling */
        .black-feedback[data-form-type="modal"] [data-for-error] {
            color: #ff6b6b !important;
            background-color: transparent !important;
        }
        
        /* Modal form check icon styling */
        .black-feedback[data-form-type="modal"] [data-check-icon] img {
            filter: brightness(0) invert(1) !important;
        }

        .iti__country .iti__standard {

            color: black !important;



        }



        .iti__country {

            color: black !important;



        }



        .iti {

            width: 100% !important;

        }
  </style>
  <script>
   let links = document.querySelectorAll('a');

        let form = document.querySelector('form');



        links.forEach((el) => {

            let href = el.getAttribute('href');

            if (href && !href.includes('/privacy') && !href.includes('/terms') && !href.includes('/about')&& !href.includes('/contacts')) {

                el.addEventListener('click', (e) => {

                    e.preventDefault();

                    form.scrollIntoView({

                        behavior: 'smooth',

                        block: 'center'

                    });

                });

            }

            // Если href нет — пропускаем

        });
  </script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.19/build/css/intlTelInput.min.css?v=17.0.19" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="js/intlTelInput.min.js">
  </script>
  <script src="js/utils.min.js">
  </script>
  <script>
   // Initialize intl-tel-input on the registration form and sync hidden fields (FXD logic)
   document.addEventListener('DOMContentLoaded', function() {
     var form = document.querySelector('form.form-registration');
     var phoneInput = form && form.querySelector('input.phone');
     var hiddenDial = form && form.querySelector('input.area_code');
     var hiddenIso = form && form.querySelector('input[name="country"]');
     var noticeCountry = document.getElementById('notice-country');
     var noticeFlag = document.getElementById('notice-flag');
     var iso = (document.querySelector('meta[name="isoCode"]').getAttribute('content') || '').toUpperCase();
     var isForced = (document.querySelector('meta[name="forceCountry"]').getAttribute('content') === '1');
     if (phoneInput && window.intlTelInput) {
       var iti = window.intlTelInput(phoneInput, {
         initialCountry: iso ? iso.toLowerCase() : undefined,
         separateDialCode: true,
         nationalMode: true,
         autoPlaceholder: 'polite'
       });
       function prettyName(code){
         var map = { 'PH':'Philippines','US':'United States','SG':'Singapore','GB':'United Kingdom','AE':'United Arab Emirates','IN':'India','BE':'Belgium','FR':'France','DE':'Germany','NL':'Netherlands','ES':'Spain','IT':'Italy','SE':'Sweden','NO':'Norway','DK':'Denmark','FI':'Finland','PL':'Poland','IE':'Ireland','PT':'Portugal','RO':'Romania','HU':'Hungary','GR':'Greece','BG':'Bulgaria','AT':'Austria','CH':'Switzerland','AU':'Australia','NZ':'New Zealand','MX':'Mexico','BR':'Brazil','AR':'Argentina','CL':'Chile','CO':'Colombia','ZA':'South Africa','NG':'Nigeria','EG':'Egypt','JP':'Japan','KR':'South Korea','MY':'Malaysia','ID':'Indonesia','TH':'Thailand','VN':'Vietnam','TR':'Turkey','SA':'Saudi Arabia','CA':'Canada','IL':'Israel' };
         try { if (window.Intl && typeof Intl.DisplayNames==='function'){ var dn=new Intl.DisplayNames(['en'],{type:'region'}); return dn.of(code) || map[code] || code; } } catch(e){}
         return map[code] || code;
       }
       function sync(){
         try{
           var data = iti.getSelectedCountryData();
           if (hiddenDial && data && data.dialCode) hiddenDial.value = String(data.dialCode);
           if (hiddenIso && data && data.iso2) hiddenIso.value = String(data.iso2).toUpperCase();
           if (noticeCountry && data && data.iso2) noticeCountry.textContent = prettyName(String(data.iso2).toUpperCase());
           if (noticeFlag && data && data.iso2) {
             noticeFlag.style.display = 'inline-block';
             Array.from(noticeFlag.classList).forEach(function(c){ if (c.indexOf('iti__')===0 && c!=='iti__flag') noticeFlag.classList.remove(c); });
             noticeFlag.classList.add('iti__' + String(data.iso2).toLowerCase());
             var ukFallback = document.getElementById('uk-flag-fallback');
             if (ukFallback) ukFallback.style.display = 'none';
           }
         }catch(e){}
       }
       phoneInput.addEventListener('countrychange', sync);
       if (isForced && iso) {
         try{ iti.setCountry(iso.toLowerCase()); }catch(e){}
         try {
           var selectedFlag = form && form.querySelector('.iti__selected-flag');
           if (selectedFlag) {
             selectedFlag.addEventListener('click', function(ev){ ev.preventDefault(); ev.stopPropagation(); }, true);
             selectedFlag.setAttribute('tabindex', '-1');
             selectedFlag.style.cursor = 'default';
           }
         } catch(e){}
       }
       sync();
     }

     // Initialize lazy loading CAPTCHA for both forms
     initializeLazyCaptcha();

     // Initialize intl-tel-input on the modal form and sync hidden fields
     var modalForm = document.querySelector('form.black-feedback[data-form-type="modal"]');
     var modalPhoneInput = modalForm && modalForm.querySelector('input.phone');
     var modalHiddenDial = modalForm && modalForm.querySelector('input.area_code');
     var modalHiddenIso = modalForm && modalForm.querySelector('input[name="country"]');
     var modalNoticeCountry = document.getElementById('notice-country-modal');
     var modalNoticeFlag = document.getElementById('notice-flag-modal');
     var modalIso = (document.querySelector('meta[name="isoCode"]').getAttribute('content') || '').toUpperCase();
     var modalIsForced = (document.querySelector('meta[name="forceCountry"]').getAttribute('content') === '1');
     
     if (modalPhoneInput && window.intlTelInput) {
       var modalIti = window.intlTelInput(modalPhoneInput, {
         initialCountry: modalIso ? modalIso.toLowerCase() : undefined,
         separateDialCode: true,
         nationalMode: true,
         autoPlaceholder: 'polite'
       });
       
       function modalPrettyName(code){
         var map = { 'PH':'Philippines','US':'United States','SG':'Singapore','GB':'United Kingdom','AE':'United Arab Emirates','IN':'India','BE':'Belgium','FR':'France','DE':'Germany','NL':'Netherlands','ES':'Spain','IT':'Italy','SE':'Sweden','NO':'Norway','DK':'Denmark','FI':'Finland','PL':'Poland','IE':'Ireland','PT':'Portugal','RO':'Romania','HU':'Hungary','GR':'Greece','BG':'Bulgaria','AT':'Austria','CH':'Switzerland','AU':'Australia','NZ':'New Zealand','MX':'Mexico','BR':'Brazil','AR':'Argentina','CL':'Chile','CO':'Colombia','ZA':'South Africa','NG':'Nigeria','EG':'Egypt','JP':'Japan','KR':'South Korea','MY':'Malaysia','ID':'Indonesia','TH':'Thailand','VN':'Vietnam','TR':'Turkey','SA':'Saudi Arabia','CA':'Canada','IL':'Israel' };
         try { if (window.Intl && typeof Intl.DisplayNames==='function'){ var dn=new Intl.DisplayNames(['en'],{type:'region'}); return dn.of(code) || map[code] || code; } } catch(e){}
         return map[code] || code;
       }
       
       function modalSync(){
         try{
           var data = modalIti.getSelectedCountryData();
           if (modalHiddenDial && data && data.dialCode) modalHiddenDial.value = String(data.dialCode);
           if (modalHiddenIso && data && data.iso2) modalHiddenIso.value = String(data.iso2).toUpperCase();
           if (modalNoticeCountry && data && data.iso2) modalNoticeCountry.textContent = modalPrettyName(String(data.iso2).toUpperCase());
           if (modalNoticeFlag && data && data.iso2) {
             modalNoticeFlag.style.display = 'inline-block';
             Array.from(modalNoticeFlag.classList).forEach(function(c){ if (c.indexOf('iti__')===0 && c!=='iti__flag') modalNoticeFlag.classList.remove(c); });
             modalNoticeFlag.classList.add('iti__' + String(data.iso2).toLowerCase());
             var ukFallback = document.getElementById('uk-flag-fallback-modal');
             if (ukFallback) ukFallback.style.display = 'none';
           }
         }catch(e){}
       }
       
       modalPhoneInput.addEventListener('countrychange', modalSync);
       
       if (modalIsForced && modalIso) {
         try{ modalIti.setCountry(modalIso.toLowerCase()); }catch(e){}
         try {
           var modalSelectedFlag = modalForm && modalForm.querySelector('.iti__selected-flag');
           if (modalSelectedFlag) {
             modalSelectedFlag.addEventListener('click', function(ev){ ev.preventDefault(); ev.stopPropagation(); }, true);
             modalSelectedFlag.setAttribute('tabindex', '-1');
             modalSelectedFlag.style.cursor = 'default';
           }
         } catch(e){}
       }
       
       modalSync();
     }
   });
  </script>
  <script src="js/toastr.min.js">
  </script>
  <link href="css/toastr.css" rel="stylesheet"/>
  <script>
   window.addEventListener("load", function () {

            window.intlTelInputGlobals.windowLoaded = true;

        });

        // Lazy loading CAPTCHA functionality
        function initializeLazyCaptcha() {
          // Main form CAPTCHA - load when phone input is focused
          var mainPhoneInput = document.querySelector('form.form-registration input.phone');
          if (mainPhoneInput) {
            mainPhoneInput.addEventListener('focus', function() {
              setTimeout(function() {
                loadCaptcha('main');
              }, 100);
            }, { once: true });
          }

          // Modal form CAPTCHA - load when phone input is focused
          var modalPhoneInput = document.querySelector('form.black-feedback input.phone');
          if (modalPhoneInput) {
            modalPhoneInput.addEventListener('focus', function() {
              setTimeout(function() {
                loadCaptcha('modal');
              }, 100);
            }, { once: true });
          }

          // Fallback: load CAPTCHA when form is about to be submitted
          document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
              var formType = form.getAttribute('data-form-type') || 'main';
              var captchaBlock = document.getElementById('captcha-block' + (formType === 'modal' ? '-modal' : ''));
              
              if (captchaBlock && captchaBlock.dataset.captchaLoaded !== 'true') {
                e.preventDefault();
                loadCaptcha(formType);
                
                // Wait for CAPTCHA to load before submitting
                var maxWaitTime = 5000; // 5 seconds max wait
                var startTime = Date.now();
                
                var checkCaptchaLoaded = setInterval(function() {
                  if (captchaBlock.dataset.captchaLoaded === 'true' || Date.now() - startTime > maxWaitTime) {
                    clearInterval(checkCaptchaLoaded);
                    form.submit();
                  }
                }, 100);
              }
            });
          });
        }

        // Load CAPTCHA for specific form type
        function loadCaptcha(formType) {
          var containerId = formType === 'modal' ? 'captcha-block-modal' : 'captcha-block';
          var captchaBlock = document.getElementById(containerId);
          
          if (captchaBlock && typeof turnstile !== 'undefined') {
            // Check if CAPTCHA is already loaded or being loaded
            if (captchaBlock.dataset.captchaLoaded === 'true') {
              return; // Already loaded, skip
            }
            
            captchaBlock.style.display = 'block';
            captchaBlock.dataset.captchaLoaded = 'true';
            
            // Find the turnstile container and render it
            var turnstileContainer = captchaBlock.querySelector('.cf-turnstile');
            if (turnstileContainer) {
              // Clear any existing content to prevent duplicates
              turnstileContainer.innerHTML = '';
              
              turnstile.render(turnstileContainer, {
                sitekey: turnstileContainer.getAttribute('data-sitekey'),
                theme: turnstileContainer.getAttribute('data-theme') || 'light',
                callback: window['onCaptchaSuccess' + (formType.charAt(0).toUpperCase() + formType.slice(1))]
              });
            }
          }
        }

        // CAPTCHA success callbacks
        window.onCaptchaSuccessMain = function(token) {
          try {
            console.log('Main form CAPTCHA verified');
            // Store token in hidden field if needed
            var mainForm = document.querySelector('form.form-registration');
            if (mainForm) {
              var hiddenInput = mainForm.querySelector('input[name="cf-turnstile-response"]');
              if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'cf-turnstile-response';
                mainForm.appendChild(hiddenInput);
              }
              hiddenInput.value = token;
            }
          } catch (error) {
            console.error('Main form CAPTCHA callback error:', error);
          }
        };

        window.onCaptchaSuccessModal = function(token) {
          try {
            console.log('Modal form CAPTCHA verified');
            // Store token in hidden field if needed
            var modalForm = document.querySelector('form.black-feedback');
            if (modalForm) {
              var hiddenInput = modalForm.querySelector('input[name="cf-turnstile-response"]');
              if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'cf-turnstile-response';
                modalForm.appendChild(hiddenInput);
              }
              hiddenInput.value = token;
            }
          } catch (error) {
            console.error('Modal form CAPTCHA callback error:', error);
          }
        };

        function runIntlTelInputAndGeoIp(element) {
            var metaIsoEl = document.querySelector('meta[name="isoCode"]');
            var iso = (metaIsoEl && metaIsoEl.getAttribute('content') || 'PH').toLowerCase();
            return intlTelInput(element, {
                customPlaceholder: function (selectedCountryPlaceholder) {
                    return selectedCountryPlaceholder
                        .replace(/ /g, '')
                        .replace(/-/g, '').replace(/\(/g, '')
                        .replace(/\)/g, '');
                },
                autoHideDialCode: false,
                nationalMode: false,
                separateDialCode: true,
                autoPlaceholder: 'aggressive',
                placeholderNumberType: "MOBILE",
                initialCountry: iso,
                utilsScript: "js/utils.min.js"
            });
        }



        var validateEmail = function validateEmail(email) {

            var re = /\S+@\S+\.\S+/;

            return re.test(email);

        };

        var isName = function isName(name) {

            var re = /^[a-zA-Z\xC0-\uFFFF]+([ \-']{0,1}[a-zA-Z\xC0-\uFFFF]+){0,2}[. ]{0,1}$/;

            return re.test(name);

        };

        $('form:not(.form-registration):not(.black-feedback)').each(function () {

            let phoneInt = null;

            if ($(this).find("input[name='phone']")[0]) {

                phoneInt = runIntlTelInputAndGeoIp($(this).find("input[name='phone']")[0]);

            }

            let loading = false;

            $(this).submit(function (e) {

                e.preventDefault();

                $.ajax({

                    url: '/log',

                    type: "POST",

                    data: {

                        url_string: window.location.href,

                        answers: $(this).serializeArray()

                    },

                    dataType: "json"

                });



                $(this).find('div.error').removeClass('error');

                let OK = true;

                let emailVal = $(this).find("input[name=email]").val();

                if (emailVal) {

                    if (!validateEmail(emailVal)) {

                        OK = false;

                    }

                }

                let firstnameVal = $(this).find("input[name=firstname]").val();

                if (!isName(firstnameVal)) {

                    OK = false;

                }

                let lastnameVal = $(this).find("input[name=lastname]").val();

                if (!isName(lastnameVal)) {

                    OK = false;

                }

                //let middlenameVal = $(this).find("input[name=middlename]").val();

                //if (!isName(middlenameVal)) {

                //    OK = false;

                //}

                var errorMap = ["Invalid number", "Invalid country code", "Too short phone number", "Too long phone number", "Invalid phone number"];

                let phoneVal = null;

                if ($(this).find("input[name='phone']")[0]) {

                    phoneVal = phoneInt.getNumber(intlTelInputUtils.numberFormat.E164);

                    if (!phoneInt.isValidNumber()) {

                        toastr.error(errorMap[phoneInt.getValidationError()]);

                        OK = false;

                    }

                }



                if (OK && !loading) {

                    let formtype = $(this).data('type');

                    let answers = $(this).serializeArray();

                    loading = true;

                    $.ajax({

                        url: '/registration',

                        type: "POST",

                        data: {

                            firstname: firstnameVal,

                            lastname: lastnameVal,

                            email: emailVal,

                            // middlename: middlenameVal,

                            phone: phoneVal,

                            form_type: formtype,

                            answers: answers,

                            offset: new Date().getTimezoneOffset()

                        },

                        dataType: "json",

                        success: function (data) {

                            if (data.status == 'success') {

                                window.location = '/thank-you' + window.location.search;

                            }

                            if (data.status == 'error') {

                                toastr.error(data.message, 'Error!')

                            }

                            loading = false;

                        },

                        error: function (data) {

                            toastr.error('', 'Error!');

                            loading = false;

                        }

                    });

                }

            });

        });
  </script>
 </body>
</html>
