
@extends('layouts.demo')
@section('title', 'Кредитная карта')
@section('content')
    <section class="wrapper style1">
        <div class="container formTabs">
            <header class="major">
                <h2>Калькулятор кредитной карты</h2>
                <p style="margin-bottom: -3em;"></p>
            </header>
            <div class="row">
                <section class="8u 12u(2) calc_bars">
                    <table>
                        <tbody>
                            <tr>
                                <td><em>Кредитный лимит:<input class="inp_slider" id="ke_summ" value="100000" type="number" min="10000" step="1000" max="300000">руб.</em></td>
                            </tr>
                            <tr>
                                <td><div id="ke_summSlider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"></div><br><hr></td>
                            </tr>
                            <tr>
                                <td><br><em>Грейс период:<input style="margin-left: 15px;" class="inp_slider" id="ke_srok" value="30" type="number" min="1" max="100" step="1/">дней</em></td>
                            </tr>
                            <tr>
                                <td><div id="ke_srokSlider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"></div><br><hr></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="4u 12u(2)  payment center" style="padding-top: 179.827px;">
                    <h2 class="center">
                        <em>Минимальный ежемесячный платеж: <br></em>
                        <span id="ke_res">2 276 руб.</span>
                    </h2>
                </section>
            </div>
        </div>
    </section>
  <section class="wrapper style2">
      <div class="container">
          <header class="major">
              <h2>Заявка на кредитную карту</h2>
              <p style="margin-bottom: -3em;"></p>
          </header>
          <div class="row" id="ke_form_small">
              <section class="12u 12u(2)">
                  <div id="ke_small_form" class="formTabs">
                      <form method="post" action="/bitrix24/cc" enctype="multipart/form-data" onsubmit="ccFormValidate()">
                          {{ csrf_field() }}
                          <input type="hidden" name="request_type" id="request_type" value="CC">
                          <input type="hidden" name="source" id="source" value="demo">
                          <!--<input type="hidden" name="routeback" id="routeback" value="http://bitrix24.portal.bs2/demo/private/cc">-->
                          <input type="hidden" name="routeback" id="routeback" value="">
                          <div class="row">
                              <section class="4u 12u(2)">
                                  <label for="fio[last]">
                                      <span>Фамилия</span>
                                      <input type="text" name="fio[last]" id="fio[last]" placeholder="Фамилия" value="Пупкин">
                                  </label>
                              </section>

                              <section class="4u 12u(2)">
                                  <label for="fio[name]">
                                      <span>Имя</span>
                                      <input type="text" name="fio[name]" id="fio[name]" placeholder="Имя" value="Виталий">
                                  </label>
                              </section>
                              <section class="4u 12u(2)">
                                  <label for="fio[name]">
                                      <span>Отчество</span>
                                      <input type="text" name="fio[sur]" id="fio[sur]" placeholder="Отчество" value="Лукьянович">
                                  </label>
                              </section>
                          </div>
                          <div class="row">
                              <section class="4u 12u(2)">
                                  <label for="ke_small_phone">
                                      <span>Телефон:</span>
                                      <input type="tel" name="phone[0][VALUE]" id="ke_small_phone" mask="+7 (999) 999 99 99" value="+79265766710" tooltip="Укажите телефон для связи <hr/>✓ Например: 8 123 456 78 90">
                                      <input type="hidden" name="phone[0][VALUE_TYPE]" value="WORK">
                                  </label>
                              </section>
                              <section class="4u 12u(2)">
                                  <label for="passport">
                                      <span>Паспорт:</span>
                                      <input type="file" name="passport" id="passport" placeholder="Скан паспорта">
                                  </label>
                              </section>
                          </div>
                          <div class="row">
                              <section class="4u 12u">
                                  <label for="amount">
                                      <span>Кредитный лимит:</span>
                                      <input type="number" name="amount" id="amount" placeholder="Кредитный лимит" value="100000">
                                  </label>
                              </section>
                          </div>
                          <div class="row">
                              <section class="6u 12u(2)">
                                  <label for="ke_small_check">
                                      <input type="checkbox" id="ke_small_check" checked="true">
                                      <span>Я согласен(согласна) с <a id="personal_data_condition">условиями обработки</a> моих персональных данных</span>
                                  </label>
                              </section>
                              <section class="6u 12u(2)">
                                  <button type="submit" id="getcc_submit">Оставить заявку</button>
                              </section>
                          </div>
                          <div class="row">
                              <section class="1u 12u(2) center not-mobile">
                                  <img src="/css/demo/icon/block.png" alt="" style="width: 100%; margin-top: 0.25em; max-width: 5em;">
                              </section>
                              <section class="11u 12u(2) small">
                                  <p>Группа Компаний не передает третьим лицам информацию, полученную при заполнении заявок. <a href="#" target="_blank">Правила обработки персональных данных</a> гарантируют защиту и конфиденциальность передаваемой информации.</p>
                              </section>
                          </div>
                      </form></div>
                  </section>
              </div>
          </div>
      </section>
      <section class="wrapper style1">
          <div class="container">
              <div class="formTabs">
                  <header class="major">
                      <h2>Связаться с нами</h2>
                      <p style="margin-bottom: -3em;"></p>
                  </header>
                  <div class="row">
                      <section class="12u 12u(2)">
                          Наши специалисты проконсультируют по любому вопросу по телефону
                          <p class="phone"><a href="tel:+74999998877"> +7 (499) 999 88 77</a>  (работает круглосуточно)</p>

                          Вы можете оставить заявку на обратный звонок, мы свяжемся в указанное Вами время
                          <p class="phone"><a id="ke_call_me">Заявка на обратный звонок</a></p>

                          Также предлагаем ознакомиться со списком часто задаваемых вопросов по продукту "Капитал-экспресс"
                          <p class="phone"><a id="ke_faq">Часто задаваемые вопросы</a></p>
                      </section>
                  </div>
              </div>
          </div>
      </section>
      <!--<section class="wrapper style2">
          <div class="container">
              <header class="major">
                  <h2>Основные условия</h2>
                  <p style="margin-bottom: -3em;"></p>
              </header>
              <div class="row" id="ke_tabs_accord">
                  <section class="12u 12u(2)">
            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
              <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-1" aria-controls="ui-id-2" aria-selected="false" aria-expanded="false" tabindex="0"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>Без залога</h3>
              <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-2" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="true" style="display: none;">
                <h4>Основные условия</h4>
                <ul class="my_ul ke_tab">
                  <li>Размер лимита - 300 000 рублей</li>
                  <li>Срок договора - 36 месяцев</li>
                  <li>Обеспечение - поручительство собственников компании</li>
                </ul><hr>
                <h4>Требования к бизнесу</h4>
                <ul class="my_ul ke_tab">
                  <li>Юридический статус ИП, ООО, ЗАО, ОАО</li>
                  <li>Адрес регистрации Москва или Московская область</li>
                  <li>Наличие лицензий, если деятельность подлежит лицензированию</li>
                </ul><hr>
                <h4>Требования к поручителям</h4>
                <ul class="my_ul ke_tab">
                  <li>Гражданин Российской Федерации</li>
                  <li>Возраст от 21 до 65 лет</li>
                  <li>Постоянное проживание в Москве или Московской области</li>
                </ul><hr>
                <h4>Необходимые документы</h4>
                <div class="ke_tab">
                  <p>Для индивидуального предпринимателя:</p>
                  <ul class="my_ul">
                    <li>Копия свидетельства о регистрации физического лица в
                    качестве индивидуального предпринимателя</li>
                    <li>Копия свидетельства о постановке на учет в налоговом органе</li>
                    <li>Выписка из ЕГРИП (сроком изготовления не больше 30 рабочих дней
                    на момент подачи Заявления), если срок с момента регистрации
                    Заявителя составляет менее 6 месяцев</li>
                    <li>Справка из банков об
                    открытых расчетных счетах Заявителя</li>
                  </ul>

                  <p>Для ООО/ЗАО/ОАО:</p>
                  <ul class="my_ul">
                    <li>Копия устава</li>
                    <li>Копия решения общего собрания участников о
                    назначении единоличного исполнительного органа</li>
                    <li>Копия приказа о назначении единоличного исполнительного органа</li>
                    <li>Копия свидетельства о регистрации юридического лица</li>
                    <li>Копия свидетельства о постановке на учет в налоговом органе</li>
                    <li>Выписка из ЕГРЮЛ (сроком изготовления не больше 30 рабочих дней
                    на момент подачи Заявления), если срок с момента регистрации
                    Заявителя составляет менее 6 месяцев</li>
                    <li>Справка из банков об
                    открытых расчетных счетах Заявителя</li>
                  </ul>
                </div>
              </div>
              <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>Залог недвижимости</h3>
              <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                <h4>Основные условия</h4>
                <ul class="my_ul ke_tab">
                  <li>Размер лимита - от 300 000 до 1 000 000 рублей</li>
                  <li>Срок договора - 36 месяцев</li>
                  <li>Обеспечение - поручительство собственников компании и залог автомобиля</li>
                </ul><hr>
                <h4>Требования к бизнесу</h4>
                <ul class="my_ul ke_tab">
                  <li>Юридический статус ИП, ООО, ЗАО, ОАО</li>
                  <li>Адрес регистрации Москва или Московская область</li>
                  <li>Наличие лицензий, если деятельность подлежит лицензированию</li>
                </ul><hr>
                <h4>Требования к поручителям</h4>
                <ul class="my_ul ke_tab">
                  <li>Гражданин Российской Федерации</li>
                  <li>Возраст от 21 до 65 лет</li>
                  <li>Постоянное проживание в Москве или Московской области</li>
                </ul><hr>
                <h4>Требования к недвижимости</h4>
                <div class="ke_tab">
                  <ul class="my_ul">
                    <li>Рыночная стоимость не менее 1 000 000 рублей</li>
                    <li>Недвижимость не заложена, не арестована,  отсутствуют прочие обременения</li>
                    <li>Собственником является компания или один из собственников. Если недвижимость принадлежит третьему лицу, требуется поручительство третьего лица</li>
                    <li>Собственник недвижимости распоряжается имуществом </li>
                  </ul>
                </div>
                <hr>
                <h4>Необходимые документы</h4>
                <div class="ke_tab">
                  <p>Для индивидуального предпринимателя:</p>
                  <ul class="my_ul">
                    <li>Копия свидетельства о регистрации физического лица в
                    качестве индивидуального предпринимателя</li>
                    <li>Копия свидетельства о постановке на учет в налоговом органе</li>
                    <li>Выписка из ЕГРИП (сроком изготовления не больше 30 рабочих дней
                    на момент подачи Заявления), если срок с момента регистрации
                    Заявителя составляет менее 6 месяцев</li>
                    <li>Справка из банков об
                    открытых расчетных счетах Заявителя</li>
                    <li>Паспорт транспортного средства, свидетельство о регистрации транспортного средства</li>
                  </ul>

                  <p>Для ООО/ЗАО/ОАО:</p>
                  <ul class="my_ul">
                    <li>Копия устава</li>
                    <li>Копия решения общего собрания участников о
                    назначении единоличного исполнительного органа</li>
                    <li>Копия приказа о назначении единоличного исполнительного органа</li>
                    <li>Копия свидетельства о регистрации юридического лица</li>
                    <li>Копия свидетельства о постановке на учет в налоговом органе</li>
                    <li>Выписка из ЕГРЮЛ (сроком изготовления не больше 30 рабочих дней
                    на момент подачи Заявления), если срок с момента регистрации
                    Заявителя составляет менее 6 месяцев</li>
                    <li>Справка из банков об
                    открытых расчетных счетах Заявителя</li>
                    <li>Паспорт транспортного средства, свидетельство о регистрации транспортного средства</li>
                  </ul>
                </div>
              </div>
              <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-2"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>Залог автомобиля</h3>
              <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                <h4>Основные условия</h4>
                <ul class="my_ul ke_tab">
                  <li>Размер лимита - от 300 000 до 1 000 000 рублей</li>
                  <li>Срок договора - 36 месяцев</li>
                  <li>Обеспечение - поручительство собственников компании и залог автомобиля</li>
                </ul><hr>
                <h4>Требования к бизнесу</h4>
                <ul class="my_ul ke_tab">
                  <li>Юридический статус ИП, ООО, ЗАО, ОАО</li>
                  <li>Адрес регистрации Москва или Московская область</li>
                  <li>Наличие лицензий, если деятельность подлежит лицензированию</li>
                </ul><hr>
                <h4>Требования к поручителям</h4>
                <ul class="my_ul ke_tab">
                  <li>Гражданин Российской Федерации</li>
                  <li>Возраст от 21 до 65 лет</li>
                  <li>Постоянное проживание в Москве или Московской области</li>
                </ul><hr>
                <h4>Требования к автомобилю</h4>
                <div class="ke_tab">
                  <ul class="my_ul">
                    <li>Рыночная стоимость не менее 500 000 рублей</li>
                    <li>Автомобиль не заложен, не арестован, не в лизинге, отсутствуют прочие обременения</li>
                    <li>Собственником является компания или один из собственников. Если автомобиль принадлежит третьему лицу, требуется поручительство третьего лица</li>
                    <li>Собственник автомобиля распоряжается имуществом (не требуется оставлять автомобиль на стоянке); ПТС автомобиля передается займодавцу на время действия договора</li>
                  </ul>
                </div>
                <hr>
                <h4>Необходимые документы</h4>
                <div class="ke_tab">
                  <p>Для индивидуального предпринимателя:</p>
                  <ul class="my_ul">
                    <li>Копия свидетельства о регистрации физического лица в
                    качестве индивидуального предпринимателя</li>
                    <li>Копия свидетельства о постановке на учет в налоговом органе</li>
                    <li>Выписка из ЕГРИП (сроком изготовления не больше 30 рабочих дней
                    на момент подачи Заявления), если срок с момента регистрации
                    Заявителя составляет менее 6 месяцев</li>
                    <li>Справка из банков об
                    открытых расчетных счетах Заявителя</li>
                    <li>Паспорт транспортного средства, свидетельство о регистрации транспортного средства</li>
                  </ul>

                  <p>Для ООО/ЗАО/ОАО:</p>
                  <ul class="my_ul">
                    <li>Копия устава</li>
                    <li>Копия решения общего собрания участников о
                    назначении единоличного исполнительного органа</li>
                    <li>Копия приказа о назначении единоличного исполнительного органа</li>
                    <li>Копия свидетельства о регистрации юридического лица</li>
                    <li>Копия свидетельства о постановке на учет в налоговом органе</li>
                    <li>Выписка из ЕГРЮЛ (сроком изготовления не больше 30 рабочих дней
                    на момент подачи Заявления), если срок с момента регистрации
                    Заявителя составляет менее 6 месяцев</li>
                    <li>Справка из банков об
                    открытых расчетных счетах Заявителя</li>
                    <li>Паспорт транспортного средства, свидетельство о регистрации транспортного средства</li>
                  </ul>
                </div>
              </div>
            </div>
                  </section>
              </div>
          </div>
      </section>-->

@endsection
@section('scripts')
<script src="/js/demo/credit-card.js"></script>
@endsection
