@extends('laravel-comet-theme::master')

@section('header')
    <img src="/img/logo.png" alt="logo" class="align-middle">
@endsection

@section('language')
    @if (App::isLocale('en'))
        <a href="/locale/pt_br">Português</a>
    @else
        <a href="/locale/en">English</a>
    @endif
@endsection

@section('footer')
    {!! __('basic.rodape') !!}
@endsection


