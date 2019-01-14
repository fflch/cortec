@extends('laravel-comet-theme::master')

@section('header')
    <img src="/img/logo.png" alt="logo" class="align-middle img-fluid">
@endsection

@section('language')
    @if (App::isLocale('en'))
        <a href="/locale/pt_br">Português</a>
    @else
        <a href="/locale/en">English</a>
    @endif
@endsection

@section('menu-itens')
  <li class="nav-item active divider-vertical">
    <a class="nav-link" href="/">{!! __('basic.busca') !!}</a>
  </li>
  <li class="nav-item divider-vertical">
    <a class="nav-link" href="#">{!! __('basic.oquee') !!}</a>
  </li>
  <li class="nav-item divider-vertical">
    <a class="nav-link" href="/corpus/">{!! __('basic.ger_corpus') !!}</a>
  </li>
@endsection

@section('footer')
    {!! __('basic.rodape') !!}
@endsection
