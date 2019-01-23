@extends('laravel-comet-theme::master')

@section('header')
    <img src="/img/logo.png" alt="logo" class="align-middle img-fluid">
@endsection

@section('right-top-menu')
    <div class="col text-right mr-3">
        @if (App::isLocale('en'))
            <a href="/locale/pt_br">Português</a>
        @else
            <a href="/locale/en">English</a>
        @endif
        @auth
            <div class="btn-group pl-4">
                <button type="button" class="btn btn-outline-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->name}}
                </button>
                <div class="dropdown-menu ml-4">
                    <form method="post" action="/logout">
                        @csrf
                        <button class="btn dropdown-item dropdown-item-danger" type="submit"  data-offset="50,20">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <a href="/login" class="btn btn-outline-success ml-4">Login</a>
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

@section('javascripts')
  @parent
  <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
@endsection
