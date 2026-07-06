@extends('layouts.app')

@section('content')
@php $u = auth()->user(); @endphp
<div class="sec"><span class="kode">A</span><span class="jdl">Identitas</span></div>
<div class="card">
  <div class="kv"><span>Nama</span><b>{{ $u->name }}</b></div>
  <div class="kv"><span>Username</span><b class="mono">@{{ $u->username }}</b></div>
  <div class="kv"><span>Departemen</span><b>{{ $u->dept }}</b></div>
  <div class="kv"><span>Peran</span><b>{{ $u->isAdmin() ? 'Admin HSE' : 'Pekerja' }}</b></div>
</div>

<div class="sec"><span class="kode">B</span><span class="jdl">Kontribusi K3</span></div>
<div class="stats">
  <div class="stat"><div class="n">{{ $total }}</div><div class="l">Laporan</div></div>
  <div class="stat done"><div class="n">{{ $closed }}</div><div class="l">Selesai</div></div>
  <div class="stat"><div class="n">{{ $poin }}</div><div class="l">Poin K3</div></div>
</div>

<form method="POST" action="{{ route('logout') }}" style="margin-top:22px">
  @csrf
  <button class="btn btn-ghost" type="submit">Keluar dari akun</button>
</form>
@endsection
