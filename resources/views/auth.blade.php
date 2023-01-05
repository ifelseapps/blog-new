@extends('layouts.app')

@section('content')
<form method="POST" action={{ route('login') }}>
  @csrf
  <input name="password" type="password" placeholder="Введите пароль">
  @if (\Session::has('error'))
  <div>{{ \Session::get('error') }}</div>
  @endif
  <button type="submit">Войти</button>
</form>
@endsection('content')
