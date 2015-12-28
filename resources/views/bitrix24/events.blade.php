@extends('layouts.master')

@section('title', 'Bitrix24')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="title">
        Bitrix<sup>24</sup>
    </div>
    @if(!isset($session['access_token']))
    <div class="form">
        <form method="get" action="/bitrix24/oauth">
            {{ csrf_field() }}
            <!--<input type="text" name="portal" placeholder="Адрес портала" value="oookbrenessans.bitrix24.ru">-->
            <input type="hidden" name="portal" placeholder="Адрес портала" value="{{ isset($domain) ? $domain : 'oookbrenessans.bitrix24.ru'}}">
            <button type="submit">Авторизоваться в b24</button>
        </form>
    </div>
    @elseif(isset($data->result)&&is_array($data->result))
        @foreach ($data->result as $event)
            <a href="/bitrix24/bindevent?event={{$event}}">{{$event}}</a><br>
        @endforeach
    @else
        {{json_encode($data)}}
    @endif

@endsection
@section('scripts')
@endsection
