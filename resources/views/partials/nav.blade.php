@php
  $items = auth()->user()->isAdmin()
    ? [['dash','Laporan'], ['approve','Persetujuan'], ['profil','Profil']]
    : [['home','Beranda'], ['lapor','Lapor'], ['darurat','Darurat','emg'], ['dash','Riwayat'], ['profil','Profil']];
@endphp
<nav class="nav">
  @foreach($items as $item)
    <button type="button" class="{{ ($item[2] ?? null) === 'emg' ? 'emg-tab' : '' }} {{ request()->routeIs($item[0]) ? 'on' : '' }}"
      onclick="window.location='{{ route($item[0]) }}'">{{ $item[1] }}</button>
  @endforeach
</nav>
