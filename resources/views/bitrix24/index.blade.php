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
    <p>
        token:{{$access_token}}<br>
        
    </p>
    <a href="bitrix24/install">Установить Бизнес-процесс модуль</a><br>
    <a href="bitrix24/userinfo">User info</a><br>
    <a href="bitrix24/methods">List of methods</a><br>
    <!--<a id="install-bp" href="#">Установить Бизнес-процесс модуль</a><br>-->
    <hr>
    <a href="bitrix24/methods">List of methods</a><br>
    <a href="?test=log.blogpost.add">Опубликовать запись в Живой Ленте</a><br>
    <a href="?test=event.bind">Установить обработчик события</a><br>
    <hr>
    <a href="bitrix24/oauth?refresh=1">Обновить данные авторизации</a><br />
    <a href="bitrix24/oauth?clear=1">Очистить данные авторизации</a><br />
    @endif

@endsection
@section('scripts')
<script src="/js/bitrix24.js"></script>
<script>
BX24.init();
$('#install-bp').on('click',function(e){
    console.debug('Install bp called');
    var params = {
        'CODE': 'contur-focus',
        'HANDLER': 'http://bitrix24.portal.bs2/contur-focus/test',
        //'AUTH_USER_ID': 1,
        //'USE_SUBSCRIPTION': 'Y',
        'NAME':{
            'ru': 'Проверка сервисом Контур-Фокус',
            'en': 'Contur-Focus Legacity check'
        },
        'DESCRIPTION':{
            'ru': 'Проверяет статусс юрлица',
            'en': 'Lagacity check'
        },
         'PROPERTIES': {
            'q': {
               'Name': {
                  'ru': 'Наименоваание организации',
                  'en': 'Entity name'
               },
               'Description': {
                  'ru': 'Введите Наименоваание организации',
                  'en': 'Input Entity name'
               },
               'Type': 'string',
               'Required': 'Y',
               'Multiple': 'N',
               'Default': '{=Document:NAME}'
            }
         },
         'RETURN_PROPERTIES': {
            'outputString': {
               'Name': {
                  'ru': 'MD5',
                  'en': 'MD5'
               },
               'Type': 'string',
               'Multiple': 'N',
               'Default': null
            }
         },
    };

    BX24.callMethod(
        'bizproc.activity.add',
        params,
        function(result){
            if(result.error())
                alert("Error: " + result.error());
            else
                alert("Success: " + result.data());
        }
    );
});
</script>
@endsection
