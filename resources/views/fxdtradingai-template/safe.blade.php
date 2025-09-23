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
  <title>
   A New AI-Powered Tool for High-Profit Investing Has Just Launched!
  </title>
  <script src="js/3.4.16">
  </script>
  <script>
   tailwind.config = {

      theme: {

        extend: {

          colors: {

            primary: "#0168a6",

            secondary: "#1e40af"

          },

          borderRadius: {

            none: "0px",

            sm: "4px",

            DEFAULT: "8px",

            md: "12px",

            lg: "16px",

            xl: "20px",

            "2xl": "24px",

            "3xl": "32px",

            full: "9999px",

            button: "8px",

          },

        },

      },

    };
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
    rel="stylesheet" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
    rel="stylesheet" />
  <!-- intl-tel-input for phone flags/dial (matches TraderAI phone UX) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.19/build/css/intlTelInput.min.css?v=17.0.19" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
   :where([class^="ri-"])::before {

      content: "\f3c2";

    }

   /* When Priority Country is forced, hide/disable intl-tel-input country UI */
   .force-no-country .iti__country-list { display: none !important; }
   .force-no-country .iti__selected-flag { pointer-events: none; cursor: default; }
   .force-no-country .iti__arrow { display: none !important; }

   /* Also hide the native dropdown arrow on our #countryCode <select> when forced */
   .force-no-country #countryCode {
     -webkit-appearance: none;
     -moz-appearance: none;
     appearance: none;
     background-image: none !important;
     padding-right: 0.75rem; /* keep spacing consistent without arrow */
     cursor: default;
   }
   .force-no-country #countryCode::-ms-expand { display: none; }
   .force-no-country #countryCode:disabled { color: #111827; /* text-gray-900 for readability */ }

   /* Hide arrow in all states to match TraderAI look */
   #countryCode {
     -webkit-appearance: none;
     -moz-appearance: none;
     appearance: none;
     background-image: none !important;
   }
   #countryCode::-ms-expand { display: none; }

   /* Make phone widget stretch nicely */
  .iti { width: 100%; }
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
 <body class="bg-white text-gray-900 {{ $forceCountry ? 'force-no-country' : '' }}">
  <?php /** Pixels: body_start location */ ?>
  @php
    try {
      $___pixels_body_start = \App\Models\Pixel::query()->where('status','active')->where('location','body_start')->orderBy('id')->get(['id','provider','code']);
    } catch (\Throwable $e) { $___pixels_body_start = collect(); }
  @endphp
  @foreach($___pixels_body_start as $___px)
    {!! $___px->code !!}
  @endforeach
  <header class="bg-white shadow-sm border-b sticky top-0 z-50">
   <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
     <div class="flex items-center">
      <img alt="Logo" class="w-36 h-12 sm:w-40 sm:h-14 object-contain" src="img/logo1.png"/>
     </div>
    </div>
   </div>
  </header>
  <main class="max-w-[1440px] mx-auto px-4 py-6 sm:py-12">
   <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
    <article class="prose lg:prose-lg lg:col-span-2">
     <h1 class="text-4xl sm:text-5xl font-bold mb-6 sm:mb-8">
      A New AI-Powered Tool for High-Profit Investing Has Just Launched!
     </h1>
     <div class="flex flex-wrap items-center space-x-2 sm:space-x-4 text-sm text-gray-500 mb-6 sm:mb-8">
      <span>
       August 22, 2025
      </span>
      <span class="hidden sm:inline">
       •
      </span>
      <span>
       5 min read
      </span>
      <span class="hidden sm:inline">
       •
      </span>
      <span>
       AI Technology
      </span>
     </div>
     <img alt="AI Trading Tool" class="w-full rounded-lg mb-6 sm:mb-8" src="img/a05954f863ea29ef6ff6abc6ca125aa6.jpg"/>
     <p class="text-base sm:text-lg text-gray-700 leading-relaxed mb-4 sm:mb-6">
      A next-generation
      <a class="text-primary underline scroll-link" href="#">
       investment platform
      </a>
      combining artificial intelligence with trading strategies across

          options, futures, stocks, and more has officially entered the

          market. With an emphasis on education, in-depth analytics, and

          self-directed investing, it’s designed to help individuals build

          online income with ease.
     </p>
     <p class="text-base sm:text-lg text-gray-700 leading-relaxed mb-4 sm:mb-6">
      Breakthrough AI technologies like ChatGPT, Bard, DALL·E, and Elon

          Musk’s xAI are transforming global industries. While it may feel

          like science fiction, AI’s evolution spans decades—and only now are

          developers unlocking its full potential in finance. With Creation

          FXDTradingai, users can tap into this innovation 24/7, even while

          they sleep. Automation on the platform—via third-party tools like
      <a class="text-primary underline scroll-link" href="#">
       AgenticAI
      </a>
      and
      <a class="text-primary underline scroll-link" href="#">
       GenerativeAI
      </a>
      guided by user-defined rules, giving individuals full control over

          their strategy.
     </p>
     <img alt="AI Analytics Dashboard" class="w-full rounded-lg mb-6 sm:mb-8" src="img/crypto-1.jpg"/>
     <h2 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6">
      Why Creation FXDTradingai Is Gaining Traction
     </h2>
     <p class="text-base sm:text-lg text-gray-700 leading-relaxed mb-4">
      The platform distinguishes itself through a streamlined,

          results-driven experience that combines real-time data with

          intuitive design. Here are the top three advantages:
     </p>
     <div class="space-y-4 sm:space-y-6 mb-6 sm:mb-8">
      <div>
       <h3 class="text-lg sm:text-xl font-bold mb-1 sm:mb-2">
        1. Seamless Experience
       </h3>
       <p class="text-base sm:text-lg text-gray-700">
        <a class="text-primary underline scroll-link" href="#">
         The platform
        </a>
        simplifies trading to its core. Whether you're a beginner or a

              seasoned investor, the interface is built to help you focus on

              building strategies—not battling with outdated dashboards or

              technical barriers.
       </p>
      </div>
      <div>
       <h3 class="text-lg sm:text-xl font-bold mb-1 sm:mb-2">
        2. Beginner-Friendly Interface
       </h3>
       <p class="text-base sm:text-lg text-gray-700">
        No coding or technical know-how is required.
        <a class="text-primary underline scroll-link" href="#">
         The system
        </a>
        automatically highlights the most promising assets—including

              stocks, cryptocurrencies, and ETFs—so users can make informed

              decisions without the guesswork.
       </p>
      </div>
      <div>
       <h3 class="text-lg sm:text-xl font-bold mb-1 sm:mb-2">
        3. Fast &amp; Flexible Withdrawals
       </h3>
       <p class="text-base sm:text-lg text-gray-700">
        Payouts are processed in under 48 hours and support a wide

              variety of payment options, from digital wallets and debit cards

              to direct bank transfers.
       </p>
      </div>
     </div>
     <h2 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6">
      How it works?
     </h2>
     <p class="text-base sm:text-lg text-gray-700 leading-relaxed mb-4 sm:mb-6">
      To begin, users make a small deposit. From there, a personal account

          manager reaches out to assist with trade execution across stocks,

          crypto, or bonds—aimed at maximizing profits with minimal effort.
     </p>
     <p class="text-base sm:text-lg text-gray-700 leading-relaxed mb-4 sm:mb-6">
      <a class="text-primary underline scroll-link" href="#">
       The platform's
      </a>
      powerful algorithm analyzes everything from macroeconomic trends to

          technical indicators, delivering precise trading recommendations at

          lightning speed.
     </p>
     <p class="text-base sm:text-lg text-gray-700 leading-relaxed mb-4 sm:mb-6">
      What powers
      <a class="text-primary underline scroll-link" href="#">
       Creation FXDTradingai
      </a>
      is the same kind of AI that enables autonomous Tesla

          driving—processing millions of data points every minute to time

          trades with near-perfect accuracy, reducing risks while increasing

          profitability.
     </p>
     <a id="lead-form"></a>
     <img alt="AI Technology" class="w-full rounded-lg mb-6 sm:mb-8" src="img/d4e78132488fb3a7ecf4ecd08011d666.jpg"/>
     
     <div class="bg-white px-6 sm:px-12 py-6 sm:py-8 rounded-lg shadow-lg max-w-md w-full mx-auto mb-6 sm:mb-8" id="contact">
      <h2 class="text-2xl sm:text-3xl font-bold text-center mb-4 sm:mb-6 text-blue-800"> 

       @php
          $redirect = ($leadSettings && !empty($leadSettings->redirect_url_when_auto_login_disabled))
            ? $leadSettings->redirect_url_when_auto_login_disabled
            : url('/redirect');
        @endphp
        <a href="{{ $redirect }}" style="color:#193cb8 !important; text-decoration:none !important;">
        CHANGE YOUR LIFE TODAY!
        </a>
      </h2>
      
      <div class="space-y-3 sm:space-y-4 text-gray-800">
        <p class="text-sm sm:text-base">
          Explore our platform's educational resources and insights into modern, AI-assisted market analysis. This page provides an overview of features, security practices, and how our tools support self-directed learning.
        </p>
        <ul class="list-disc pl-5 space-y-1 text-sm sm:text-base">
          <li>Understand how data-driven insights can inform investment decisions.</li>
          <li>Discover key concepts in risk awareness, diversification, and market trends.</li>
          <li>See how intuitive dashboards make complex information easier to navigate.</li>
        </ul>
        <p class="text-xs sm:text-sm text-gray-600">
          Disclaimer: The information on this page is for educational purposes only and does not constitute financial advice. Always do your own research and consider independent professional guidance.
        </p>
      </div>

     <h3 class="text-lg sm:text-xl font-bold text-center mt-4 sm:mt-6 text-gray-600">
      As Easy As 1.2.3
     </h3>
    </div>
    <div class="space-y-8 sm:space-y-12 mb-6 sm:mb-8">
     <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-8 bg-white p-6 sm:p-8 rounded-lg shadow-md">
      <div class="w-full sm:w-1/2 text-gray-900 space-y-3 sm:space-y-4">
       <h3 class="text-sm sm:text-base font-medium uppercase text-gray-600">SIGN UP PROCESS</h3>
       <h2 class="text-xl sm:text-2xl font-bold text-gray-900">HOW TO JOIN THE PLATFORM</h2>
       <p class="text-sm sm:text-base text-gray-900">To begin, complete the registration form by providing your details, including your name, email, and phone number. After submitting this information, a personal manager will contact you to proceed further.</p>
      </div>
      <div class="w-full sm:w-1/2">
       <img src="img/1.jpg" alt="Sign Up Form" class="w-full rounded-lg" />
      </div>
     </div>
     <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-8 bg-white p-6 sm:p-8 rounded-lg shadow-md">
      <div class="w-full sm:w-1/2 text-gray-900 space-y-3 sm:space-y-4">
       <h3 class="text-sm sm:text-base font-medium uppercase text-gray-600">PROCESS OF ADDING FUNDS</h3>
       <h2 class="text-xl sm:text-2xl font-bold text-gray-900">ACCOUNT VERIFICATION NECESSITY</h2>
       <p class="text-sm sm:text-base text-gray-900">Next, you must finalize the verification of your account. This will be conducted by an authorized representative, who will provide a concise explanation of the entire process.</p>
      </div>
      <div class="w-full sm:w-1/2">
       <img src="img/2.jpg" alt="Sign Up Form" class="w-full rounded-lg" />
      </div>
     </div>
     <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-8 bg-white p-6 sm:p-8 rounded-lg shadow-md">
      <div class="w-full sm:w-1/2 text-gray-900 space-y-3 sm:space-y-4">
       <h3 class="text-sm sm:text-base font-medium uppercase text-gray-600">INTRODUCTION TO THE PLATFORM</h3>
       <h2 class="text-xl sm:text-2xl font-bold text-gray-900">INITIAL INVESTMENT REQUIREMENT: $250</h2>
       <p class="text-sm sm:text-base text-gray-900">Upon joining, your first step is to invest a minimum of $250, officially marking your entry into the platform. With this investment, you can begin trading based on the guidance provided to you.</p>
      </div>
      <div class="w-full sm:w-1/2">
       <img src="img/3.jpg" alt="Sign Up Form" class="w-full rounded-lg" />
      </div>
     </div>
     <div class="text-center">
      <a href="#lead-form" class="inline-block bg-primary text-white text-lg sm:text-xl font-bold px-8 sm:px-12 py-3 sm:py-4 !rounded-button hover:bg-primary/60 transition-colors scroll-link">CLICK TO START</a>
     </div>
    </div>
   </article>
   <!-- Sidebar -->
   <div class="lg:col-span-1 space-y-6">
    <!-- Share Article -->
    <div class="bg-white rounded-lg shadow-sm border p-4 sm:p-6">
     <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Share This Article</h3>
     <div class="flex flex-wrap space-x-2 sm:space-x-4">
      <button class="flex-1 bg-[#3b5998] text-white py-1 sm:py-2 !rounded-button hover:bg-opacity-90 transition-colors flex items-center justify-center text-sm sm:text-base mb-2 sm:mb-0">
       <i class="ri-facebook-fill mr-1 sm:mr-2"></i> Share
      </button>
      <button class="flex-1 bg-[#1da1f2] text-white py-1 sm:py-2 !rounded-button hover:bg-opacity-90 transition-colors flex items-center justify-center text-sm sm:text-base mb-2 sm:mb-0">
       <i class="ri-twitter-fill mr-1 sm:mr-2"></i> Tweet
      </button>
      <button class="flex-1 bg-[#0077b5] text-white py-1 sm:py-2 !rounded-button hover:bg-opacity-90 transition-colors flex items-center justify-center text-sm sm:text-base">
       <i class="ri-linkedin-fill mr-1 sm:mr-2"></i> Share
      </button>
     </div>
    </div>
    <!-- Related Articles -->
    <div class="bg-white rounded-lg shadow-sm border p-4 sm:p-6">
     <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Related Articles</h3>
     <div class="space-y-4 sm:space-y-6">
      <div class="flex items-start space-x-3 sm:space-x-4">
       <div class="w-16 sm:w-20 h-16 sm:h-20 flex-shrink-0">
        <img src="img/e80c470eac3f4b56816178b184027494.jpg" alt="Market Recovery" class="w-full h-full object-cover rounded" />
       </div>
       <div>
        <h4 class="font-bold text-gray-900 mb-1 line-clamp-2 text-sm sm:text-base"><a href="#lead-form" class="scroll-link text-gray-900 hover:text-blue-600 transition-colors">Fear not, the stock market still holds potential for recovery.</a></h4>
        <span class="text-sm text-gray-500">August 21, 2025</span>
       </div>
      </div>
      <div class="flex items-start space-x-3 sm:space-x-4">
       <div class="w-16 sm:w-20 h-16 sm:h-20 flex-shrink-0">
        <img src="img/904aad94395192ff364d901fa0e54aa5.jpg" alt="Investment Strategies" class="w-full h-full object-cover rounded" />
       </div>
       <div>
        <h4 class="font-bold text-gray-900 mb-1 line-clamp-2 text-sm sm:text-base"><a href="#lead-form" class="scroll-link text-gray-900 hover:text-blue-600 transition-colors">The Secret Weapon for High-Profit, Low-Risk Investment Strategies has been released</a></h4>
        <span class="text-sm text-gray-500">August 20, 2025</span>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 mt-6 sm:mt-8">
   <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
    <div class="lg:col-span-2">
     <h2 class="text-xl sm:text-2xl font-bold my-6 sm:my-8">Comments (43)</h2>
     <div class="bg-gray-50 p-4 sm:p-6 rounded-lg mb-6 sm:mb-8">
      <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4">Leave a Comment</h3>
      <form class="space-y-3 sm:space-y-4">
       <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
        <input type="text" placeholder="Your Name" class="w-full px-4 py-2 rounded border-gray-300 border focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <input type="email" placeholder="Your Email" class="w-full px-4 py-2 rounded border-gray-300 border focus:outline-none focus:ring-2 focus:ring-blue-500" />
       </div>
       <textarea rows="4" placeholder="Your Comment" class="w-full p-4 border rounded border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
       <button class="bg-[#3B82F6] text-white px-4 sm:px-6 py-2 !rounded-button text-sm sm:text-base">Post Comment</button>
      </form>
     </div>
     <div class="space-y-6 sm:space-y-8">
      <div class="flex items-start space-x-3 sm:space-x-4">
       <img src="img/6e8c6190078390db69f816c1322cf6a7.jpg" alt="Michael Chen" class="w-8 sm:w-10 h-8 sm:h-10 rounded-full" />
       <div class="flex-1">
        <div class="flex flex-wrap items-center justify-between mb-1 sm:mb-2">
         <h4 class="font-bold text-base sm:text-lg">Michael Chen</h4>
         <span class="text-gray-500 text-xs sm:text-sm">Yesterday</span>
        </div>
        <p class="text-gray-800 mb-2 sm:mb-3 text-sm sm:text-base">I was on the waitlist for ages and finally got an account. I wish I new about the direct signup link from this page that skips the waitlist. Anyways, I know others won't believe me, but I don't care.The only difference from hundreds of other software is that this one has much better technology to predict price changes, so it is really effective and you can make a profit.</p>
        <div class="flex items-center space-x-3 sm:space-x-4">
         <button class="text-gray-500 hover:text-gray-700 text-sm">Reply</button>
         <div class="flex items-center space-x-1 text-sm">
          <i class="ri-thumb-up-fill text-[#3B82F6] text-sm"></i>
          <span>12</span>
         </div>
        </div>
       </div>
      </div>
      <div class="flex items-start space-x-3 sm:space-x-4">
       <img src="img/6128dbf2f510d541b4bdc7daa5f71ea8.jpg" alt="Sarah Rodriguez" class="w-8 sm:w-10 h-8 sm:h-10 rounded-full" />
       <div class="flex-1">
        <div class="flex flex-wrap items-center justify-between mb-1 sm:mb-2">
         <h4 class="font-bold text-base sm:text-lg">Sarah Rodriguez</h4>
         <span class="text-gray-500 text-xs sm:text-sm">3 Days ago</span>
        </div>
        <p class="text-gray-800 mb-2 sm:mb-3 text-sm sm:text-base">Yes it works, just like many systems do, but unfortunately the rich keep it for themselves. This one was opened for public registration for short time, but I didn't manage to register. I tried opening a signup page, but it says its at a capacity. When will it be available again?</p>
        <div class="flex items-center space-x-3 sm:space-x-4">
         <button class="text-gray-500 hover:text-gray-700 text-sm">Reply</button>
         <div class="flex items-center space-x-1 text-sm">
          <i class="ri-thumb-up-fill text-[#3B82F6] text-sm"></i>
          <span>26</span>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </main>
 <!-- Footer -->
 <footer class="bg-white py-8 sm:py-12 mt-12 sm:mt-16 border-t">
  <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
   <div class="flex flex-wrap justify-center space-x-4 sm:space-x-8 mb-6 sm:mb-8 text-base sm:text-xl">
    <a href="/privacy-policy" target="_blank" class="text-gray-600 hover:text-primary">Privacy Policy</a>
    <a href="/terms" target="_blank" class="text-gray-600 hover:text-primary">Terms and Conditions</a>
    <a href="#" class="text-gray-600 hover:text-primary scroll-link">Contact</a>
   </div>
   <div class="text-gray-600 max-w-[1440px] mx-auto space-y-6 sm:space-y-8 text-base sm:text-xl">
    <p class="text-sm sm:text-base">All trademarks and logos belong to their respective owners and are not involved in this operation.</p>
    <p class="text-sm sm:text-base">General risk warning: Investments carry a high level of risk and may result in the total loss of the invested amount. Losses can range from 74% to 95%. For this reason, such activities may not be suitable for all types of investors. You should not invest money that you cannot afford to lose. Before deciding to make this type of investment, you should be fully informed about all the risks and seek advice from an independent and qualified financial advisor. We cannot be held responsible to any person or company for (a) any damage or total or partial loss caused as a result of or in connection with a transaction related to these investment activities, or (b) any direct, indirect, special, consequential or incidental action. After registration, the company will contact you. Authorized and regulated by the Cyprus Securities and Exchange Commission.</p>
    <p class="text-sm sm:text-base">This website does not represent a newspaper, news page, or blog. This is a website aimed at marketing publications that uses narrative techniques to illustrate the scope of the services and products offered. Therefore, the story on this page constitutes an advertisement or commercial communication with the purpose of informing and is intended to help understand the potential of what is being offered.</p>
   </div>
   <div class="text-center text-base sm:text-xl text-gray-600 mt-6 sm:mt-8">
    <p> 2025</p>
   </div>
  </div>
 </footer>

 <!-- Bottom scripts (restored from template) -->
 <script id="mobile-menu">
  document.addEventListener("DOMContentLoaded", function() {
    const menuButton = document.querySelector(".md\\:hidden button");
    const nav = document.querySelector("nav");
    if (menuButton && nav) {
      menuButton.addEventListener("click", function() { nav.classList.toggle("hidden"); });
    }
  });
 </script>
 <script id="newsletter-forms">
  document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll('input[type="email"]');
    const buttons = document.querySelectorAll("button");
    buttons.forEach((button) => {
      if (button.textContent.includes("Subscribe")) {
        button.addEventListener("click", function(e) {
          e.preventDefault();
          const email = this.previousElementSibling?.value || this.parentElement.querySelector('input[type="email"]')?.value;
          if (email && email.includes("@")) {
            alert("Thank you for subscribing! You will receive our latest updates.");
          } else {
            alert("Please enter a valid email address.");
          }
        });
      }
    });
  });
 </script>
 <script>
  // Handle transition to phone section
  document.getElementById("next-button")?.addEventListener("click", () => {
    const initialForm = document.getElementById("initial-form");
    const phoneSection = document.getElementById("phone-section");
    if (initialForm && phoneSection) {
      initialForm.classList.add("hidden");
      phoneSection.classList.remove("hidden");
    }
  });

  // Smooth scrolling to #lead-form for clickable promotional elements
  document.addEventListener("DOMContentLoaded", function() {
    const scrollLinks = document.querySelectorAll(".scroll-link");
    scrollLinks.forEach((link) => {
      link.addEventListener("click", function(e) {
        e.preventDefault();
        const leadForm = document.getElementById("lead-form");
        if (leadForm) {
          leadForm.scrollIntoView({ behavior: "smooth" });
        }
      });
    });
  });
</script>
<script>
 // Explicit Turnstile render when phone section becomes visible
 window.renderTurnstile = function() {
   try {
     var el = document.getElementById('cf-turnstile-widget');
     if (el && typeof window.turnstile !== 'undefined' && !el.dataset.rendered) {
       // Clear any existing content first
       el.innerHTML = '';
       
       window.turnstile.render(el, {
         sitekey: '{{ config('services.turnstile.site_key') }}',
         theme: 'light'
       });
       el.dataset.rendered = 'true';
     }
   } catch (e) { 
     console.log('Turnstile render error:', e);
   }
};

// Render when phone section becomes visible
window.showPhoneSection = function() {
  var phoneSection = document.getElementById('phone-section');
  var initialForm = document.getElementById('initial-form');
  
  if (phoneSection && initialForm) {
    initialForm.classList.add('hidden');
    phoneSection.classList.remove('hidden');
    
    // Render Turnstile after a short delay to ensure container is visible
    setTimeout(function() {
      if (typeof window.turnstile !== 'undefined') {
        window.renderTurnstile();
      }
    }, 100);
  }
};

// Handle Next button click
document.getElementById('next-button')?.addEventListener('click', function(e){
  e.preventDefault();
  window.showPhoneSection();
});

// Reset Turnstile on Back button
document.getElementById('back-button')?.addEventListener('click', function(){
  try { 
    if (window.turnstile && typeof window.turnstile.reset === 'function') {
      window.turnstile.reset();
    }
    // Clear rendered flag so it will re-render
    var el = document.getElementById('cf-turnstile-widget');
    if (el) {
      el.dataset.rendered = '';
    }
  } catch(e){}
});
</script>
 <script src="js/sweetalert2@11.js"></script>
 <script>
  document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get("msg");
    if (msg) {
      if (msg === "success") {
        Swal.fire({
          icon: "success",
          title: "Thank you!",
          html: `Thank you for sharing your information with us!<br>Our team truly appreciates the time you took, and we’ll be reaching out within 48 hours to assist you further.`,
          confirmButtonColor: "#3085d6"
        });
      } else {
        Swal.fire({ icon: "error", title: "Error", text: decodeURIComponent(msg), confirmButtonColor: "#d33" });
      }
      // Remove ?msg=... after showing
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  });
</script>
@if(config('services.turnstile.enabled') && config('services.turnstile.site_key'))
 <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit" async defer></script>
@endif

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
