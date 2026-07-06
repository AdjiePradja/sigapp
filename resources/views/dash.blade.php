@extends('layouts.app')

@section('content')
@php $admin = auth()->user()->isAdmin(); @endphp
<div class="sec">
  <span class="kode">A</span>
  <span class="jdl">{{ $admin ? 'Laporan masuk' : 'Riwayat laporan saya' }}</span>
  <span class="kanan">{{ now()->translatedFormat('d/m/Y') }}</span>
</div>

@if($admin)
<div class="stats" style="margin-bottom:16px">
  <div class="stat open"><div class="n">{{ $stats['open'] }}</div><div class="l">Terbuka</div></div>
  <div class="stat prog"><div class="n">{{ $stats['prog'] }}</div><div class="l">Ditangani</div></div>
  <div class="stat done"><div class="n">{{ $stats['done'] }}</div><div class="l">Selesai</div></div>
</div>
@endif

@forelse($reports as $r)
  @include('partials.report-card', ['report' => $r, 'admin' => $admin])
@empty
  <div class="empty">{{ $admin ? 'Belum ada laporan masuk.' : 'Riwayat laporanmu akan tercatat di sini.' }}</div>
@endforelse
@endsection
