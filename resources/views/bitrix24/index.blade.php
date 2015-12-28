@extends('layouts.master')

@section('title', 'Bitrix24')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="title">
        Bitrix<sup>24</sup>
    </div>
    @if(!isset($access_token))
    <div class="form">
        <form method="get" action="/bitrix24/oauth">
            {{ csrf_field() }}
            <!--<input type="text" name="portal" placeholder="Адрес портала" value="oookbrenessans.bitrix24.ru">-->
            <input type="text" name="portal" placeholder="Адрес портала" value="{{ isset($domain) ? $domain : 'oookbrenessans.bitrix24.ru'}}">
            <button type="submit">oauth</button>
        </form>
    </div>
    @else
    <p>
        token:{{$access_token}}<br>

    </p>
    <a href="/bitrix24/cc">Заявка на кредитную карту</a><br>
    <hr>
    <a href="/bitrix24/install">Установить Бизнес-процесс модуль</a><br>
    <a href="/bitrix24/userinfo">User info</a><br>
    <a href="/bitrix24/methods">List of methods</a><br>
    <a href="/bitrix24/events">List of events</a><br>
    <hr>
    <a href="/bitrix24/leadfields">List of Lead's fields</a><br>
    <a href="/bitrix24/leaduserfields">List of Lead's user fields</a><br>
    <hr>
    <a href="/bitrix24/methods">List of methods</a><br>
    <a href="?test=log.blogpost.add">Опубликовать запись в Живой Ленте</a><br>
    <a href="?test=event.bind">Установить обработчик события</a><br>
    <hr>
    <a href="/bitrix24/oauth?refresh=1">Обновить данные авторизации</a><br />
    <a href="/bitrix24/oauth?clear=1">Очистить данные авторизации</a><br />
    @endif

@endsection
@section('scripts')
@endsection
