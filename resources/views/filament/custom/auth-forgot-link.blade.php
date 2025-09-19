@php
  $forgotUrl = app('router')->has('filament.admin.auth.password-reset.request')
      ? route('filament.admin.auth.password-reset.request')
      : url('/admin/forgot-password');
@endphp
<div style="margin-top: 12px; text-align: right;">
  <a href="{{ $forgotUrl }}" style="font-size: 0.875rem; color: #6b7280; text-decoration: underline;">Forgot your password?</a>
</div>
