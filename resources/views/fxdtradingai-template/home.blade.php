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
  <style>
   :where([class^="ri-"])::before {

      content: "\f3c2";

    }
  </style>
 </head>
 <body class="bg-white text-gray-900 {{ $forceCountry ? 'force-no-country' : '' }}">
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
     <img alt="AI Technology" class="w-full rounded-lg mb-6 sm:mb-8" src="img/d4e78132488fb3a7ecf4ecd08011d666.jpg"/>
     <div class="bg-white px-6 sm:px-12 py-6 sm:py-8 rounded-lg shadow-lg max-w-md w-full mx-auto mb-6 sm:mb-8" id="contact">
      <h2 class="text-2xl sm:text-3xl font-bold text-center mb-4 sm:mb-6 text-blue-800">
       CHANGE YOUR LIFE TODAY!
      </h2>
      <form action="{{ route('leads.store') }}" class="space-y-4 sm:space-y-6" method="POST" onsubmit="return validateForm();">
       @csrf
       <input type="hidden" name="utmSource" value="" />
       <input type="hidden" name="fbclid" value="" />
       <!-- Initial Form Fields -->
       <div class="space-y-3 sm:space-y-4" id="initial-form">
        <input class="w-full px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" id="firstName" name="first_name" placeholder="First Name" type="text"/>
        <input class="w-full px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" id="lastName" name="last_name" placeholder="Last Name" type="text"/>
        <input class="w-full px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" id="email" name="email" placeholder="Email" type="email"/>
        <button class="w-full bg-blue-600 text-white py-2 sm:py-3 !rounded-button text-base sm:text-lg font-semibold hover:bg-blue-700 transition-colors" id="next-button" type="button">
         NEXT
        </button>
       </div>
       <!-- Phone Number Section -->
       <div class="space-y-3 sm:space-y-4 hidden" id="phone-section">
        <!-- Hidden fields expected by backend -->
        <input type="hidden" id="area_code_hidden" class="area_code" name="phone_prefix" value="{{ $preDial }}" />
        <input type="hidden" name="country" value="{{ $computedIso }}" />
        <div class="flex flex-col gap-2 sm:flex-row sm:gap-3">
         <select class="w-full sm:w-1/3 px-4 py-2 sm:py-3 rounded-lg border border-gray-300 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm bg-white" id="countryCode" name="countryCode">
          <option value="+7 840">
           Abkhazia +7 840
          </option>
          <option value="+93">
           Afghanistan +93
          </option>
          <option value="+355">
           Albania +355
          </option>
          <option value="+213">
           Algeria +213
          </option>
          <option value="+1 684">
           American Samoa +1 684
          </option>
          <option value="+376">
           Andorra +376
          </option>
          <option value="+244">
           Angola +244
          </option>
          <option value="+1 264">
           Anguilla +1 264
          </option>
          <option value="+1 268">
           Antigua and Barbuda +1 268
          </option>
          <option value="+54">
           Argentina +54
          </option>
          <option value="+374">
           Armenia +374
          </option>
          <option value="+297">
           Aruba +297
          </option>
          <option value="+247">
           Ascension +247
          </option>
          <option value="+61">
           Australia +61
          </option>
          <option value="+672">
           Australian External Territories +672
          </option>
          <option value="+43">
           Austria +43
          </option>
          <option value="+994">
           Azerbaijan +994
          </option>
          <option value="+1 242">
           Bahamas +1 242
          </option>
          <option value="+973">
           Bahrain +973
          </option>
          <option value="+880">
           Bangladesh +880
          </option>
          <option value="+1 246">
           Barbados +1 246
          </option>
          <option value="+1 268">
           Barbuda +1 268
          </option>
          <option value="+375">
           Belarus +375
          </option>
          <option value="+32">
           Belgium +32
          </option>
          <option value="+501">
           Belize +501
          </option>
          <option value="+229">
           Benin +229
          </option>
          <option value="+1 441">
           Bermuda +1 441
          </option>
          <option value="+975">
           Bhutan +975
          </option>
          <option value="+591">
           Bolivia +591
          </option>
          <option value="+387">
           Bosnia and Herzegovina +387
          </option>
          <option value="+267">
           Botswana +267
          </option>
          <option value="+55">
           Brazil +55
          </option>
          <option value="+246">
           British Indian Ocean Territory +246
          </option>
          <option value="+1 284">
           British Virgin Islands +1 284
          </option>
          <option value="+673">
           Brunei +673
          </option>
          <option value="+359">
           Bulgaria +359
          </option>
          <option value="+226">
           Burkina Faso +226
          </option>
          <option value="+257">
           Burundi +257
          </option>
          <option value="+855">
           Cambodia +855
          </option>
          <option value="+237">
           Cameroon +237
          </option>
          <option value="+1">
           Canada +1
          </option>
          <option value="+238">
           Cape Verde +238
          </option>
          <option value="+ 345">
           Cayman Islands + 345
          </option>
          <option value="+236">
           Central African Republic +236
          </option>
          <option value="+235">
           Chad +235
          </option>
          <option value="+56">
           Chile +56
          </option>
          <option value="+86">
           China +86
          </option>
          <option value="+61">
           Christmas Island +61
          </option>
          <option value="+61">
           Cocos-Keeling Islands +61
          </option>
          <option value="+57">
           Colombia +57
          </option>
          <option value="+269">
           Comoros +269
          </option>
          <option value="+242">
           Congo +242
          </option>
          <option value="+243">
           Congo, Dem. Rep. of (Zaire) +243
          </option>
          <option value="+682">
           Cook Islands +682
          </option>
          <option value="+506">
           Costa Rica +506
          </option>
          <option value="+385">
           Croatia +385
          </option>
          <option value="+53">
           Cuba +53
          </option>
          <option value="+599">
           Curacao +599
          </option>
          <option value="+537">
           Cyprus +537
          </option>
          <option value="+420">
           Czech Republic +420
          </option>
          <option value="+45">
           Denmark +45
          </option>
          <option value="+246">
           Diego Garcia +246
          </option>
          <option value="+253">
           Djibouti +253
          </option>
          <option value="+1 767">
           Dominica +1 767
          </option>
          <option value="+1 809">
           Dominican Republic +1 809
          </option>
          <option value="+670">
           East Timor +670
          </option>
          <option value="+56">
           Easter Island +56
          </option>
          <option value="+593">
           Ecuador +593
          </option>
          <option value="+20">
           Egypt +20
          </option>
          <option value="+503">
           El Salvador +503
          </option>
          <option value="+240">
           Equatorial Guinea +240
          </option>
          <option value="+291">
           Eritrea +291
          </option>
          <option value="+372">
           Estonia +372
          </option>
          <option value="+251">
           Ethiopia +251
          </option>
          <option value="+500">
           Falkland Islands +500
          </option>
          <option value="+298">
           Faroe Islands +298
          </option>
          <option value="+679">
           Fiji +679
          </option>
          <option value="+358">
           Finland +358
          </option>
          <option value="+33">
           France +33
          </option>
          <option value="+596">
           French Antilles +596
          </option>
          <option value="+594">
           French Guiana +594
          </option>
          <option value="+689">
           French Polynesia +689
          </option>
          <option value="+241">
           Gabon +241
          </option>
          <option value="+220">
           Gambia +220
          </option>
          <option value="+995">
           Georgia +995
          </option>
          <option value="+49">
           Germany +49
          </option>
          <option value="+233">
           Ghana +233
          </option>
          <option value="+350">
           Gibraltar +350
          </option>
          <option value="+30">
           Greece +30
          </option>
          <option value="+299">
           Greenland +299
          </option>
          <option value="+1 473">
           Grenada +1 473
          </option>
          <option value="+590">
           Guadeloupe +590
          </option>
          <option value="+1 671">
           Guam +1 671
          </option>
          <option value="+502">
           Guatemala +502
          </option>
          <option value="+224">
           Guinea +224
          </option>
          <option value="+245">
           Guinea-Bissau +245
          </option>
          <option value="+595">
           Guyana +595
          </option>
          <option value="+509">
           Haiti +509
          </option>
          <option value="+504">
           Honduras +504
          </option>
          <option value="+852">
           Hong Kong SAR China +852
          </option>
          <option value="+36">
           Hungary +36
          </option>
          <option value="+354">
           Iceland +354
          </option>
          <option value="+91">
           India +91
          </option>
          <option value="+62">
           Indonesia +62
          </option>
          <option value="+98">
           Iran +98
          </option>
          <option value="+964">
           Iraq +964
          </option>
          <option value="+353">
           Ireland +353
          </option>
          <option value="+972">
           Israel +972
          </option>
          <option value="+39">
           Italy +39
          </option>
          <option value="+225">
           Ivory Coast +225
          </option>
          <option value="+1 876">
           Jamaica +1 876
          </option>
          <option value="+81">
           Japan +81
          </option>
          <option value="+962">
           Jordan +962
          </option>
          <option value="+7 7">
           Kazakhstan +7 7
          </option>
          <option value="+254">
           Kenya +254
          </option>
          <option value="+686">
           Kiribati +686
          </option>
          <option value="+965">
           Kuwait +965
          </option>
          <option value="+996">
           Kyrgyzstan +996
          </option>
          <option value="+856">
           Laos +856
          </option>
          <option value="+371">
           Latvia +371
          </option>
          <option value="+961">
           Lebanon +961
          </option>
          <option value="+266">
           Lesotho +266
          </option>
          <option value="+231">
           Liberia +231
          </option>
          <option value="+218">
           Libya +218
          </option>
          <option value="+423">
           Liechtenstein +423
          </option>
          <option value="+370">
           Lithuania +370
          </option>
          <option value="+352">
           Luxembourg +352
          </option>
          <option value="+853">
           Macau SAR China +853
          </option>
          <option value="+389">
           Macedonia +389
          </option>
          <option value="+261">
           Madagascar +261
          </option>
          <option value="+265">
           Malawi +265
          </option>
          <option value="+60">
           Malaysia +60
          </option>
          <option value="+960">
           Maldives +960
          </option>
          <option value="+223">
           Mali +223
          </option>
          <option value="+356">
           Malta +356
          </option>
          <option value="+692">
           Marshall Islands +692
          </option>
          <option value="+596">
           Martinique +596
          </option>
          <option value="+222">
           Mauritania +222
          </option>
          <option value="+230">
           Mauritius +230
          </option>
          <option value="+262">
           Mayotte +262
          </option>
          <option value="+52">
           Mexico +52
          </option>
          <option value="+691">
           Micronesia +691
          </option>
          <option value="+1 808">
           Midway Island +1 808
          </option>
          <option value="+373">
           Moldova +373
          </option>
          <option value="+377">
           Monaco +377
          </option>
          <option value="+976">
           Mongolia +976
          </option>
          <option value="+382">
           Montenegro +382
          </option>
          <option value="+1664">
           Montserrat +1664
          </option>
          <option value="+212">
           Morocco +212
          </option>
          <option value="+95">
           Myanmar +95
          </option>
          <option value="+264">
           Namibia +264
          </option>
          <option value="+674">
           Nauru +674
          </option>
          <option value="+977">
           Nepal +977
          </option>
          <option value="+31">
           Netherlands +31
          </option>
          <option value="+599">
           Netherlands Antilles +599
          </option>
          <option value="+1 869">
           Nevis +1 869
          </option>
          <option value="+687">
           New Caledonia +687
          </option>
          <option value="+64">
           New Zealand +64
          </option>
          <option value="+505">
           Nicaragua +505
          </option>
          <option value="+227">
           Niger +227
          </option>
          <option value="+234">
           Nigeria +234
          </option>
          <option value="+683">
           Niue +683
          </option>
          <option value="+672">
           Norfolk Island +672
          </option>
          <option value="+850">
           North Korea +850
          </option>
          <option value="+1 670">
           Northern Mariana Islands +1 670
          </option>
          <option value="+47">
           Norway +47
          </option>
          <option value="+968">
           Oman +968
          </option>
          <option value="+92">
           Pakistan +92
          </option>
          <option value="+680">
           Palau +680
          </option>
          <option value="+970">
           Palestinian Territory +970
          </option>
          <option value="+507">
           Panama +507
          </option>
          <option value="+675">
           Papua New Guinea +675
          </option>
          <option value="+595">
           Paraguay +595
          </option>
          <option value="+51">
           Peru +51
          </option>
          <option value="+63">
           Philippines +63
          </option>
          <option value="+48">
           Poland +48
          </option>
          <option value="+351">
           Portugal +351
          </option>
          <option value="+1 787">
           Puerto Rico +1 787
          </option>
          <option value="+974">
           Qatar +974
          </option>
          <option value="+262">
           Reunion +262
          </option>
          <option value="+40">
           Romania +40
          </option>
          <option value="+7">
           Russia +7
          </option>
          <option value="+250">
           Rwanda +250
          </option>
          <option value="+685">
           Samoa +685
          </option>
          <option value="+378">
           San Marino +378
          </option>
          <option value="+966">
           Saudi Arabia +966
          </option>
          <option value="+221">
           Senegal +221
          </option>
          <option value="+381">
           Serbia +381
          </option>
          <option value="+248">
           Seychelles +248
          </option>
          <option value="+232">
           Sierra Leone +232
          </option>
          <option value="+65">
           Singapore +65
          </option>
          <option value="+421">
           Slovakia +421
          </option>
          <option value="+386">
           Slovenia +386
          </option>
          <option value="+677">
           Solomon Islands +677
          </option>
          <option value="+27">
           South Africa +27
          </option>
          <option value="+500">
           South Georgia and the South Sandwich Islands +500
          </option>
          <option value="+82">
           South Korea +82
          </option>
          <option value="+34">
           Spain +34
          </option>
          <option value="+94">
           Sri Lanka +94
          </option>
          <option value="+249">
           Sudan +249
          </option>
          <option value="+597">
           Suriname +597
          </option>
          <option value="+268">
           Swaziland +268
          </option>
          <option value="+46">
           Sweden +46
          </option>
          <option value="+41">
           Switzerland +41
          </option>
          <option value="+963">
           Syria +963
          </option>
          <option value="+886">
           Taiwan +886
          </option>
          <option value="+992">
           Tajikistan +992
          </option>
          <option value="+255">
           Tanzania +255
          </option>
          <option value="+66">
           Thailand +66
          </option>
          <option value="+670">
           Timor Leste +670
          </option>
          <option value="+228">
           Togo +228
          </option>
          <option value="+690">
           Tokelau +690
          </option>
          <option value="+676">
           Tonga +676
          </option>
          <option value="+1 868">
           Trinidad and Tobago +1 868
          </option>
          <option value="+216">
           Tunisia +216
          </option>
          <option value="+90">
           Turkey +90
          </option>
          <option value="+993">
           Turkmenistan +993
          </option>
          <option value="+1 649">
           Turks and Caicos Islands +1 649
          </option>
          <option value="+688">
           Tuvalu +688
          </option>
          <option value="+1 340">
           U.S. Virgin Islands +1 340
          </option>
          <option value="+256">
           Uganda +256
          </option>
          <option value="+380">
           Ukraine +380
          </option>
          <option value="+971">
           United Arab Emirates +971
          </option>
          <option selected="" value="+44">
           United Kingdom +44
          </option>
          <option value="+1">
           United States +1
          </option>
          <option value="+598">
           Uruguay +598
          </option>
          <option value="+998">
           Uzbekistan +998
          </option>
          <option value="+678">
           Vanuatu +678
          </option>
          <option value="+58">
           Venezuela +58
          </option>
          <option value="+84">
           Vietnam +84
          </option>
          <option value="+1 808">
           Wake Island +1 808
          </option>
          <option value="+681">
           Wallis and Futuna +681
          </option>
          <option value="+967">
           Yemen +967
          </option>
          <option value="+260">
           Zambia +260
          </option>
          <option value="+255">
           Zanzibar +255
          </option>
          <option value="+263">
           Zimbabwe +263
          </option>
         </select>
         <input class="flex-1 w-full px-4 py-2 sm:py-3 rounded-lg border border-gray-300 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" id="phoneNumber" name="phone_number" placeholder="Phone Number" type="tel"/>
        </div>
        <!-- captcha div -->
        <style>
         /* Container cha để ôm sát nội dung CAPTCHA và khớp với form */

                .cf-turnstile-scalable-container {

                  display: flex;

                  justify-content: center;

                  /* Căn giữa ngang */

                  width: 280px;

                  /* Chiều rộng cố định */

                  height: auto;

                  /* Chiều cao cố định */

                  margin: 0 auto;

                  /* Padding giống input (px-3 py-3) */

                  border: 1px solid #e5e7eb;

                  /* Border giống input (border-gray-200) */

                  border-radius: 0.75rem;

                  /* Nền trắng giống input */

                  box-sizing: border-box;

                  /* Đảm bảo padding không làm tăng kích thước */

                  overflow: hidden;

                  /* Ngăn nội dung tràn ra ngoài */

                }



                /* Override iframe để giữ kích thước cố định của CAPTCHA */

                .cf-turnstile iframe {

                  width: 200px !important;

                  /* Chiều rộng cố định */

                  height: 78px !important;

                  /* Chiều cao cố định */

                  max-width: none !important;

                  /* Loại bỏ giới hạn max-width */

                  border: none !important;

                  display: block !important;

                }



                /* Media queries cho các thiết bị nhỏ (dưới 414px) */

                @media (max-width: 414px) {

                  .cf-turnstile-scalable-container {

                    width: 260px;

                    /* Chiếm toàn bộ chiều rộng trên mobile */

                    height: auto;

                    /* Chiều cao tự điều chỉnh theo nội dung */

                    max-width: 280px;

                    /* Giảm padding trên mobile */

                    margin: 0 auto;

                    /* Căn giữa */

                  }



                  .cf-turnstile iframe {

                    width: 100% !important;

                    /* Chiếm toàn bộ chiều rộng container */

                    height: auto !important;

                    /* Chiều cao tự điều chỉnh */

                    max-width: 280px !important;

                    /* Giới hạn tối đa */

                  }

                }
        </style>
        <div class="cf-turnstile-scalable-container">
         <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}">
         </div>
        </div>
        <button class="w-full bg-blue-600 text-white py-2 sm:py-3 !rounded-button text-base sm:text-lg font-semibold hover:bg-blue-700 transition-colors" id="submit-button" type="submit">
         SUBMIT
        </button>
       </div>
       <!-- Feedback Message -->
       <div class="text-center mt-2 sm:mt-4 hidden text-sm sm:text-base" id="feedback-message">
       </div>
      </form>
      <h3 class="text-lg sm:text-xl font-bold text-center mt-4 sm:mt-6 text-gray-600">
       As Easy As 1.2.3
      </h3>
     </div>
     <div class="space-y-8 sm:space-y-12 mb-6 sm:mb-8">
      <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-8 bg-white p-6 sm:p-8 rounded-lg shadow-md">
       <div class="w-full sm:w-1/2 text-gray-900 space-y-3 sm:space-y-4">
        <h3 class="text-sm sm:text-base font-medium uppercase text-gray-600">
         SIGN UP PROCESS
        </h3>
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
         HOW TO JOIN THE PLATFORM
        </h2>
        <p class="text-sm sm:text-base text-gray-900">
         To begin, complete the registration form by providing your

                details, including your name, email, and phone number. After

                submitting this information, a personal manager will contact

                you to proceed further.
        </p>
       </div>
       <div class="w-full sm:w-1/2">
        <img alt="Sign Up Form" class="w-full rounded-lg" src="img/1.jpg"/>
       </div>
      </div>
      <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-8 bg-white p-6 sm:p-8 rounded-lg shadow-md">
       <div class="w-full sm:w-1/2 text-gray-900 space-y-3 sm:space-y-4">
        <h3 class="text-sm sm:text-base font-medium uppercase text-gray-600">
         PROCESS OF ADDING FUNDS
        </h3>
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
         ACCOUNT VERIFICATION NECESSITY
        </h2>
        <p class="text-sm sm:text-base text-gray-900">
         Next, you must finalize the verification of your account. This

                will be conducted by an authorized representative, who will

                provide a concise explanation of the entire process.
        </p>
       </div>
       <div class="w-full sm:w-1/2">
        <img alt="Sign Up Form" class="w-full rounded-lg" src="img/2.jpg"/>
       </div>
      </div>
      <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-8 bg-white p-6 sm:p-8 rounded-lg shadow-md">
       <div class="w-full sm:w-1/2 text-gray-900 space-y-3 sm:space-y-4">
        <h3 class="text-sm sm:text-base font-medium uppercase text-gray-600">
         INTRODUCTION TO THE PLATFORM
        </h3>
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
         INITIAL INVESTMENT REQUIREMENT: $250
        </h2>
        <p class="text-sm sm:text-base text-gray-900">
         Upon joining, your first step is to invest a minimum of $250,

                officially marking your entry into the platform. With this

                investment, you can begin trading based on the guidance

                provided to you.
        </p>
       </div>
       <div class="w-full sm:w-1/2">
        <img alt="Sign Up Form" class="w-full rounded-lg" src="img/3.jpg"/>
       </div>
      </div>
      <div class="text-center">
       <a class="inline-block bg-primary text-white text-lg sm:text-xl font-bold px-8 sm:px-12 py-3 sm:py-4 !rounded-button hover:bg-primary/60 transition-colors scroll-link" href="#">
        CLICK TO START
       </a>
      </div>
     </div>
    </article>
    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
     <!-- Share Article -->
     <div class="bg-white rounded-lg shadow-sm border p-4 sm:p-6">
      <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">
       Share This Article
      </h3>
      <div class="flex flex-wrap space-x-2 sm:space-x-4">
       <button class="flex-1 bg-[#3b5998] text-white py-1 sm:py-2 !rounded-button hover:bg-opacity-90 transition-colors flex items-center justify-center text-sm sm:text-base mb-2 sm:mb-0">
        <i class="ri-facebook-fill mr-1 sm:mr-2">
        </i>
        Share
       </button>
       <button class="flex-1 bg-[#1da1f2] text-white py-1 sm:py-2 !rounded-button hover:bg-opacity-90 transition-colors flex items-center justify-center text-sm sm:text-base mb-2 sm:mb-0">
        <i class="ri-twitter-fill mr-1 sm:mr-2">
        </i>
        Tweet
       </button>
       <button class="flex-1 bg-[#0077b5] text-white py-1 sm:py-2 !rounded-button hover:bg-opacity-90 transition-colors flex items-center justify-center text-sm sm:text-base">
        <i class="ri-linkedin-fill mr-1 sm:mr-2">
        </i>
        Share
       </button>
      </div>
     </div>
     <!-- Related Articles -->
     <div class="bg-white rounded-lg shadow-sm border p-4 sm:p-6">
      <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">
       Related Articles
      </h3>
      <div class="space-y-4 sm:space-y-6">
       <div class="flex items-start space-x-3 sm:space-x-4">
        <div class="w-16 sm:w-20 h-16 sm:h-20 flex-shrink-0">
         <img alt="Market Recovery" class="w-full h-full object-cover rounded" src="img/e80c470eac3f4b56816178b184027494.jpg"/>
        </div>
        <div>
         <h4 class="font-bold text-gray-900 mb-1 line-clamp-2 text-sm sm:text-base">
          Fear not, the stock market still holds potential for

                  recovery.
         </h4>
         <span class="text-sm text-gray-500">
          August 21, 2025
         </span>
        </div>
       </div>
       <div class="flex items-start space-x-3 sm:space-x-4">
        <div class="w-16 sm:w-20 h-16 sm:h-20 flex-shrink-0">
         <img alt="Investment Strategies" class="w-full h-full object-cover rounded" src="img/904aad94395192ff364d901fa0e54aa5.jpg"/>
        </div>
        <div>
         <h4 class="font-bold text-gray-900 mb-1 line-clamp-2 text-sm sm:text-base">
          The Secret Weapon for High-Profit, Low-Risk Investment

                  Strategies has been released
         </h4>
         <span class="text-sm text-gray-500">
          August 20, 2025
         </span>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
   <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 mt-6 sm:mt-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
     <div class="lg:col-span-2">
      <h2 class="text-xl sm:text-2xl font-bold my-6 sm:my-8">
       Comments (43)
      </h2>
      <div class="bg-gray-50 p-4 sm:p-6 rounded-lg mb-6 sm:mb-8">
       <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4">
        Leave a Comment
       </h3>
       <form class="space-y-3 sm:space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
         <input class="w-full px-4 py-2 rounded border-gray-300 border focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Name" type="text"/>
         <input class="w-full px-4 py-2 rounded border-gray-300 border focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Email" type="email"/>
        </div>
        <textarea class="w-full p-4 border rounded border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Comment" rows="4"></textarea>
        <button class="bg-[#3B82F6] text-white px-4 sm:px-6 py-2 !rounded-button text-sm sm:text-base">
         Post Comment
        </button>
       </form>
      </div>
      <div class="space-y-6 sm:space-y-8">
       <div class="flex items-start space-x-3 sm:space-x-4">
        <img alt="Michael Chen" class="w-8 sm:w-10 h-8 sm:h-10 rounded-full" src="img/6e8c6190078390db69f816c1322cf6a7.jpg"/>
        <div class="flex-1">
         <div class="flex flex-wrap items-center justify-between mb-1 sm:mb-2">
          <h4 class="font-bold text-base sm:text-lg">
           Michael Chen
          </h4>
          <span class="text-gray-500 text-xs sm:text-sm">
           Yesterday
          </span>
         </div>
         <p class="text-gray-800 mb-2 sm:mb-3 text-sm sm:text-base">
          I was on the waitlist for ages and finally got an account. I

                  wish I new about the direct signup link from this page that

                  skips the waitlist. Anyways, I know others won't believe me,

                  but I don't care.The only difference from hundreds of other

                  software is that this one has much better technology to

                  predict price changes, so it is really effective and you can

                  make a profit.
         </p>
         <div class="flex items-center space-x-3 sm:space-x-4">
          <button class="text-gray-500 hover:text-gray-700 text-sm">
           Reply
          </button>
          <div class="flex items-center space-x-1 text-sm">
           <i class="ri-thumb-up-fill text-[#3B82F6] text-sm">
           </i>
           <span>
            12
           </span>
          </div>
         </div>
        </div>
       </div>
       <div class="flex items-start space-x-3 sm:space-x-4">
        <img alt="Sarah Rodriguez" class="w-8 sm:w-10 h-8 sm:h-10 rounded-full" src="img/6128dbf2f510d541b4bdc7daa5f71ea8.jpg"/>
        <div class="flex-1">
         <div class="flex flex-wrap items-center justify-between mb-1 sm:mb-2">
          <h4 class="font-bold text-base sm:text-lg">
           Sarah Rodriguez
          </h4>
          <span class="text-gray-500 text-xs sm:text-sm">
           3 Days ago
          </span>
         </div>
         <p class="text-gray-800 mb-2 sm:mb-3 text-sm sm:text-base">
          Yes it works, just like many systems do, but unfortunately

                  the rich keep it for themselves. This one was opened for

                  public registration for short time, but I didn't manage to

                  register. I tried opening a signup page, but it says its at

                  a capacity. When will it be available again?
         </p>
         <div class="flex items-center space-x-3 sm:space-x-4">
          <button class="text-gray-500 hover:text-gray-700 text-sm">
           Reply
          </button>
          <div class="flex items-center space-x-1 text-sm">
           <i class="ri-thumb-up-fill text-[#3B82F6] text-sm">
           </i>
           <span>
            26
           </span>
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
     <a class="text-gray-600 hover:text-primary" href="./policy.html" target="_blank">
      Privacy Policy
     </a>
     <a class="text-gray-600 hover:text-primary" href="./term.html" target="_blank">
      Terms and Conditions
     </a>
     <a class="text-gray-600 hover:text-primary scroll-link" href="#">
      Contact
     </a>
    </div>
    <div class="text-gray-600 max-w-[1440px] mx-auto space-y-6 sm:space-y-8 text-base sm:text-xl">
     <p class="text-sm sm:text-base">
      All trademarks and logos belong to their respective owners and are

          not involved in this operation.
     </p>
     <p class="text-sm sm:text-base">
      General risk warning: Investments carry a high level of risk and may

          result in the total loss of the invested amount. Losses can range

          from 74% to 95%. For this reason, such activities may not be

          suitable for all types of investors. You should not invest money

          that you cannot afford to lose. Before deciding to make this type of

          investment, you should be fully informed about all the risks and

          seek advice from an independent and qualified financial advisor. We

          cannot be held responsible to any person or company for (a) any

          damage or total or partial loss caused as a result of or in

          connection with a transaction related to these investment

          activities, or (b) any direct, indirect, special, consequential or

          incidental action. After registration, the company will contact you.

          Authorized and regulated by the Cyprus Securities and Exchange

          Commission.
     </p>
     <p class="text-sm sm:text-base">
      This website does not represent a newspaper, news page, or blog.

          This is a website aimed at marketing publications that uses

          narrative techniques to illustrate the scope of the services and

          products offered. Therefore, the story on this page constitutes an

          advertisement or commercial communication with the purpose of

          informing and is intended to help understand the potential of what

          is being offered.
     </p>
    </div>
    <div class="text-center text-base sm:text-xl text-gray-600 mt-6 sm:mt-8">
     <p>
      © 2025
     </p>
    </div>
   </div>
  </footer>
  <script id="mobile-menu">
   document.addEventListener("DOMContentLoaded", function() {

      const menuButton = document.querySelector(".md\\:hidden button");

      const nav = document.querySelector("nav");

      if (menuButton && nav) {

        menuButton.addEventListener("click", function() {

          nav.classList.toggle("hidden");

        });

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

            const email =

              this.previousElementSibling?.value ||

              this.parentElement.querySelector('input[type="email"]')?.value;

            if (email && email.includes("@")) {

              alert(

                "Thank you for subscribing! You will receive our latest updates."

              );

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

    document.getElementById("next-button").addEventListener("click", () => {

      const initialForm = document.getElementById("initial-form");

      const phoneSection = document.getElementById("phone-section");

      if (initialForm && phoneSection) {

        initialForm.classList.add("hidden");

        phoneSection.classList.remove("hidden");

      }

    });



    // Smooth scrolling to #contact for clickable promotional elements

    document.addEventListener("DOMContentLoaded", function() {

      const scrollLinks = document.querySelectorAll(".scroll-link");

      scrollLinks.forEach((link) => {

        link.addEventListener("click", function(e) {

          e.preventDefault();

          const contactForm = document.getElementById("contact");

          if (contactForm) {

            contactForm.scrollIntoView({

              behavior: "smooth"

            });

          }

        });

      });

    });
  </script>
  <script>
   function validateForm() {

      const countryCode = document.getElementById('countryCode').value;

      const phoneNumber = document.getElementById('phoneNumber').value.trim();



      // chỉ lấy số, bỏ ký tự khác

      const cleaned = phoneNumber.replace(/\D/g, '');



      // Map regex rules cho từng quốc gia

      const rules = {

        '+44': { // UK

          regex: /^0\d{10}$/, // 11 số, bắt đầu 0

          message: 'UK phone must be 11 digits and start with 0.'

        },

        '+61': { // AU

          regex: /^04\d{8}$/, // 10 số, bắt đầu 04 (mobile)

          message: 'AU phone must be 10 digits and start with 04.'

        }

      };



      if (rules[countryCode]) {

        if (!rules[countryCode].regex.test(cleaned)) {

          alert(rules[countryCode].message);

          return false;

        }

      }



      return true;

    }
  </script>
  <script src="js/sweetalert2@11.js">
  </script>
  <script>
   document.addEventListener("DOMContentLoaded", function() {

      const urlParams = new URLSearchParams(window.location.search);

      const msg = urlParams.get("msg");



      if (msg) {

        if (msg === "success") {

          Swal.fire({

            icon: "success",

            title: "Thank you!",

            html: `

          Thank you for sharing your information with us!<br>

          Our team truly appreciates the time you took, and we’ll be reaching out within 48 hours to assist you further.

        `,

            confirmButtonColor: "#3085d6"

          });

        } else {

          Swal.fire({

            icon: "error",

            title: "Error",

            text: decodeURIComponent(msg),

            confirmButtonColor: "#d33"

          });

        }



        // Xóa param ?msg=... khỏi URL sau khi hiển thị

        window.history.replaceState({}, document.title, window.location.pathname);

      }

    });
  </script>
  <!-- captcha -->
  @if(config('services.turnstile.enabled') && config('services.turnstile.site_key'))
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
  @endif
  <script>
   // Keep hidden phone_prefix in sync with country dropdown
   document.addEventListener('DOMContentLoaded', function() {
     var select = document.getElementById('countryCode');
     var hidden = document.getElementById('area_code_hidden');
     if (!select || !hidden) return;
     function updatePrefix() {
       var match = (select.value || '').match(/\+\d+/);
       if (match) {
         hidden.value = match[0].replace('+','');
       }
     }
     updatePrefix();
     select.addEventListener('change', updatePrefix);
   });
  </script>
  <!-- get pixel -->
  <!-- Meta Pixel Code -->
  <script>
   !function(f,b,e,v,n,t,s)

{if(f.fbq)return;n=f.fbq=function(){n.callMethod?

n.callMethod.apply(n,arguments):n.queue.push(arguments)};

if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';

n.queue=[];t=b.createElement(e);t.async=!0;

t.src=v;s=b.getElementsByTagName(e)[0];

s.parentNode.insertBefore(t,s)}(window, document,'script',

'https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '809657624932867');

fbq('track', 'PageView');
  </script>
  <noscript>
   <img height="1" src="img/tr-3e01fbe2" style="display:none" width="1"/>
  </noscript>
  <!-- End Meta Pixel Code -->
 </body>
</html>
