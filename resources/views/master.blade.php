@extends('laravel-comet-theme::master')

@section('header')
    <img src="/img/logo.png" alt="logo" class="align-middle img-fluid">
@endsection

@section('right-top-menu')
    <div class="col-1 align-self-end text-right">
        @if (App::isLocale('en'))
            <a href="/locale/pt_br">Português</a>
        @else
            <a href="/locale/en">English</a>
        @endif
    </div>
    <div class="col-1 align-self-end text-center pr-0">
        @auth
            <form method="post" action="/logout">
                @csrf
                <button class="btn btn-outline-danger" type="submit">logout</button>
            </form>
        @else
            <a href="/login" class="btn btn-outline-success">Login</a>
        @endauth
    </div>
@endsection

@section('menu-itens')
  <li class="nav-item active divider-vertical">
    <a class="nav-link" href="/">{!! __('basic.busca') !!}</a>
  </li>
  @auth
      <li class="nav-item divider-vertical">
        <a class="nav-link" href="/corpus/">{!! __('basic.ger_corpus') !!}</a>
      </li>
  @endauth
@endsection

@section('footer')
    {!! __('basic.rodape') !!}
@endsection
