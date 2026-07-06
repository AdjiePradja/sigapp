@extends('layouts.app')

@section('content')
<div class="sec"><span class="kode">A</span><span class="jdl">Ringkasan</span><span class="kanan">{{ now()->translatedFormat('d/m/Y') }}</span></div>
<div class="stats">
  <div class="stat open"><div class="n">{{ $stats['open'] }}</div><div class="l">Terbuka</div></div>
  <div class="stat prog"><div class="n">{{ $stats['prog'] }}</div><div class="l">Ditangani</div></div>
  <div class="stat done"><div class="n">{{ $stats['done'] }}</div><div class="l">Selesai</div></div>
</div>

<div class="sec"><span class="kode">B</span><span class="jdl">Aksi cepat</span></div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:9px">
  <a class="btn btn-red" href="{{ route('lapor') }}">Lapor hazard</a>
  <a class="btn btn-ghost" href="{{ route('darurat') }}">Darurat</a>
</div>

<div class="sec"><span class="kode">C</span><span class="jdl">Laporan saya</span></div>
@forelse($recent as $r)
  @include('partials.report-card', ['report' => $r, 'admin' => false])
@empty
  <div class="empty">Belum ada laporan. Jadilah mata K3 pertama hari ini.</div>
@endforelse

<div class="note"><b>Pasang di layar utama.</b> Android: Chrome, menu, "Install aplikasi". iPhone: Safari, Bagikan, "Add to Home Screen".</div>
@endsection
