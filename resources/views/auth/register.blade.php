@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('register.attempt') }}">
  @csrf
  <label class="f" for="rg-nama">Nama lengkap</label>
  <input type="text" id="rg-nama" name="nama" value="{{ old('nama') }}">
  <label class="f" for="rg-dept">Departemen</label>
  <select id="rg-dept" name="dept">
    @foreach(['Produksi','Plant / Workshop','HSE','Logistik','HRGA'] as $d)
      <option @selected(old('dept') === $d)>{{ $d }}</option>
    @endforeach
  </select>
  <label class="f" for="rg-user">Username</label>
  <input type="text" id="rg-user" name="username" value="{{ old('username') }}" autocomplete="username" autocapitalize="none">
  <label class="f" for="rg-pass">Kata sandi</label>
  <input type="password" id="rg-pass" name="password" autocomplete="new-password">

  @if ($errors->any())
    <div class="err-box">{{ $errors->first() }}</div>
  @endif

  <div style="margin-top:18px"><button class="btn btn-red" type="submit">Ajukan – menunggu persetujuan admin</button></div>
  <div class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></div>
</form>
@endsection
