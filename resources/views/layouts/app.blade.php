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

<div id="app" style="display:flex;flex-direction:column;min-height:100dvh">
<header>
  <div>
    <div class="t1">SIGAP</div>
    <div class="t2">{{ auth()->user()->isAdmin() ? 'Panel Admin HSE – Site PPA' : 'Site PPA' }}</div>
  </div>
  <div class="who"><b>{{ auth()->user()->name }}</b><br>{{ auth()->user()->isAdmin() ? 'ADMIN HSE' : 'PEKERJA' }}</div>
</header>
<div class="tape"></div>

<main>
  <section class="screen active">
    @yield('content')
  </section>
</main>

@include('partials.nav')
</div>

@include('partials.toast')

<script>
document.querySelectorAll('form[data-confirm]').forEach(f=>{
  f.addEventListener('submit', e=>{ if(!confirm(f.dataset.confirm)) e.preventDefault(); });
});
</script>
@yield('scripts')
</body>
</html>
