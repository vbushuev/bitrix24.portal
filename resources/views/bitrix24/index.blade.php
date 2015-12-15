@extends('layouts.master')

@section('title', 'Bitrix24')

@section('sidebar')

@endsection

@section('content')
    <div class="title">
        Bitrix<sup>24</sup>
    </div>
    @if(!isset($access_token))
    <div class="form">
        <form method="get" action="bitrix24/oauth">
            {{ csrf_field() }}
            <input type="text" name="portal" placeholder="Адрес портала" value="oookbrenessans.bitrix24.ru">
            <button type="submit">oauth</button>
        </form>
    </div>
    @else
    {{$access_token}}
    {{$scope}}
    <ul>
        <li><a href="bitrix24/install">Установить Бизнес-процесс модуль</a>
        <li><a href="bitrix24/methods">List of methods</a>
        <li><a href="?test=log.blogpost.add">Опубликовать запись в Живой Ленте</a>
        <li><a href="?test=event.bind">Установить обработчик события</a>
    </ul>
    <a href="bitrix24/oauth?refresh=1">Обновить данные авторизации</a><br />
    <a href="bitrix24/oauth?clear=1">Очистить данные авторизации</a><br />
    @endif

@endsection
