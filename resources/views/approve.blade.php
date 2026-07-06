@extends('layouts.app')

@section('content')
<div class="sec"><span class="kode">A</span><span class="jdl">Menunggu persetujuan</span></div>
<div class="card">
  @forelse($pending as $u)
    <div class="userline">
      <div style="flex:1">
        <div class="nm">{{ $u->name }}</div>
        <div class="un">@{{ $u->username }} · {{ $u->dept }}</div>
      </div>
      <form method="POST" action="{{ route('approve.approve', $u) }}">
        @csrf
        <button class="btn btn-green btn-sm" type="submit">Setujui</button>
      </form>
      <form method="POST" action="{{ route('approve.reject', $u) }}">
        @csrf
        <button class="btn btn-ghost btn-sm" type="submit">Tolak</button>
      </form>
    </div>
  @empty
    <div class="empty" style="border:none">Tidak ada pendaftaran baru.</div>
  @endforelse
</div>

<div class="sec"><span class="kode">B</span><span class="jdl">Pengguna aktif</span></div>
<div class="card">
  @foreach($active as $u)
    <div class="userline">
      <div style="flex:1">
        <div class="nm">{{ $u->name }}</div>
        <div class="un">@{{ $u->username }} · {{ $u->dept }}</div>
      </div>
      <span class="tag {{ $u->role === 'admin' ? 't-emg' : 't-done' }}">{{ $u->role }}</span>
    </div>
  @endforeach
</div>
@endsection
