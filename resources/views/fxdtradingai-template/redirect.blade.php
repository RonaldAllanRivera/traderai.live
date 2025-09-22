<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="robots" content="noindex, nofollow" />
  <title>Redirecting…</title>
  @php
    $raw = (string) request()->query('to', '/');
    $target = filter_var($raw, FILTER_VALIDATE_URL) ? $raw : url('/');
    $seconds = (int) (request()->query('s', 5));
    if ($seconds < 1 || $seconds > 30) { $seconds = 5; }
    $leadId = request()->query('lead_id');
  @endphp
  <meta http-equiv="refresh" content="{{ $seconds }};url={{ e($target) }}">
  <style>
    :root{--fg:#222;--muted:#6b7280}
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;color:var(--fg);background:#fff;display:flex;align-items:center;justify-content:center}
    .wrap{max-width:800px;padding:32px;text-align:center}
    h1{font-size:26px;font-weight:700;margin:0 0 18px}
    p{margin:0 0 14px}
    .muted{color:var(--muted)}
    .spinner{margin:18px auto 18px;width:46px;height:46px;border:4px solid #e5e7eb;border-top-color:#3b82f6;border-radius:50%;animation:spin 1s linear infinite}
    @keyframes spin{to{transform:rotate(360deg)}}
    a{color:#2563eb;text-decoration:underline}
  </style>
</head>
<body>
  <div class="wrap">
    <h1>Thank you for sharing your information with us! Our team truly appreciates the time you took, and we’ll be reaching out within 48 hours to assist you further. In the meantime, you’re being redirected to one of our top partner’s sites.</h1>
    <div class="spinner" aria-hidden="true"></div>
    <p class="muted">If you are not automatically redirected, <a href="{{ $target }}">click here</a>.</p>
    @if($leadId)
      <p class="muted" style="font-size:12px">Ref: #{{ (int) $leadId }}</p>
    @endif
  </div>
  <script>
    (function(){
      var target = {{ json_encode($target) }};
      var delay = {{ (int) $seconds }} * 1000;
      setTimeout(function(){ window.location.href = target; }, delay);
    })();
  </script>
</body>
</html>
