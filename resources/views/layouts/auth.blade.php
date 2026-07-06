<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="theme-color" content="#C41E17">
<title>SIGAP – Site PPA</title>
@include('partials.style')
</head>
<body>

<div class="auth-wrap">
  <div class="auth-mast">
    <div class="bar">
      <div class="b1">SIGAP</div>
      <div class="b2">Sistem Pelaporan Bahaya &amp; Tanggap Darurat – Site PPA</div>
    </div>
    <div class="auth-body">
      @yield('content')
    </div>
  </div>
  <div class="hint-cred">akun uji &nbsp;·&nbsp; admin/admin (Admin HSE) &nbsp;·&nbsp; jamal/jamal (Pekerja)</div>
</div>

@include('partials.toast')
</body>
</html>
