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
    @elseif($type=="userfields")
    <div class="content">
        <table>
            <tr><th>ID</th><th>ENTITY_ID</th><th>FIELD_NAME</th><th>USER_TYPE_ID</th><th>MULTIPLE</th></tr>
        @foreach ($data->result as $n => $field)
            <tr>
                <td>{{$n}}-{{$field->ID}}</td>
                <td>{{$field->ENTITY_ID}}</td>
                <td>{{$field->FIELD_NAME}}</td>
                <td>{{$field->USER_TYPE_ID}}</td>
                <td>{{$field->MULTIPLE}}</td>
            </tr>
        @endforeach
        </table>
    </div>
    @elseif($type=="fields")
    <div class="content">
        <table>
            <tr><th>ID</th><th>listLabel</th><th>type</th><th>isMultiple</th></tr>
        @foreach ($data->result as $n => $field)
            <tr>
                <td>{{$n}}</td>
                <td>{{ isset($field->listLabel)?$field->listLabel:'no label' }}</td>
                <td>{{$field->type}}</td>
                <td>{{($field->isMultiple) ? 'Y' : 'N'}}</td>
            </tr>
        @endforeach
        </table>
    </div>
    @else
        {{json_encode($data)}}
    @endif

@endsection
@section('scripts')
@endsection
