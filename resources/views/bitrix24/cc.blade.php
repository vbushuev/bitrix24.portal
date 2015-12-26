@extends('layouts.master')

@section('title', 'Кредитная карта')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="title">
        Заявка на  кредитную карту<sup>demo</sup>
    </div>
    @if(!isset($access_token))
    <div class="form">
        <form method="get" action="/bitrix24/oauth">
            {{ csrf_field() }}
            <input type="text" name="portal" placeholder="Адрес портала" value="oookbrenessans.bitrix24.ru">
            <button type="submit">oauth</button>
        </form>
    </div>
    @else
    <div class="form">
        <form method="post" action="/bitrix24/cc">
            {{ csrf_field() }}
            <fieldset><label for="fio[last]">Фамилия</label><input type="text" name="fio[last]" placeholder="Фамилия" value="Пупкин"></fieldset>
            <fieldset><label for="fio[name]">Имя</label><input type="text" name="fio[name]" placeholder="Имя" value="Виталий"></fieldset>
            <fieldset><label for="fio[sur]">Отчество</label><input type="text" name="fio[sur]" placeholder="Отчество" value="Лукьянович"></fieldset>
            <fieldset><label for="phone">Номер мобильного</label><input type="tel" name="phone[0][VALUE]" placeholder="Номер мобильного" value="+79265766710"></fieldset>
            <input type="hidden" name="phone[0][VALUE_TYPE]" value="WORK">
            <fieldset><label for="amount">Кредитный лимит</label><input type="number" name="amount" placeholder="Кредитный лимит" value="100000"></fieldset>
            <input type="hidden" name="request_type" value="CC">
            <input type="hidden" name="source" value="demo">
            <button type="submit">Оставить заявку</button>
        </form>
    </div>
    @endif

@endsection
@section('scripts')
@endsection
