@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('login.attempt') }}">
  @csrf
  <label class="f" for="li-user">Username / NIK</label>
  <input type="text" id="li-user" name="username" value="{{ old('username', session('registered_username')) }}" autocomplete="username" autocapitalize="none">
  <label class="f" for="li-pass">Kata sandi</label>
  <input type="password" id="li-pass" name="password" autocomplete="current-password">

  @if ($errors->has('login'))
    <div class="err-box">{{ $errors->first('login') }}</div>
  @endif

  <div style="margin-top:18px"><button class="btn btn-red" type="submit">Masuk</button></div>
  <div class="auth-switch">Belum punya akun? <a href="{{ route('register') }}">Ajukan pendaftaran</a></div>
</form>
@endsection
