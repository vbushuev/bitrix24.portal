@extends('layouts.demo')

@section('title', 'Займы для малого бизнеса')


@section('content')
    <section class="wrapper style1">
          <div class="container formTabs">
              <header class="major">
                  <h2 id="paymentschedule">Калькулятор займа</h2>
                  <p style="margin-bottom: -3em;"></p>
              </header>
              <div class="row">
                  <section class="8u 12u(2) calc_bars">
                      <table>
              <tbody><tr>
                <td>
                  <em>
                    Вид займа:
                    <select id="ke_type" class="select_inp" style="margin-left: 25px;">
                      <option>Без залога</option>
                      <option>Залог недвижимости</option>
                      <option>Залог автомобиля</option>
                    </select>
                    <br> <br>
                    <hr>
                </em></td>
              </tr>
                          <tr>
                              <td><em>Сумма займа:<input class="inp_slider" id="ke_summ" value="100000" type="number" min="50000" step="10000" max="2400000">руб.</em></td>
                          </tr>
                          <tr>
                              <td>
                                  <div id="ke_summSlider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"></div><br><hr>
                              </td>
                          </tr>
                          <tr>
                              <td><br><em>Срок займа:<input style="margin-left: 15px;" class="inp_slider" id="ke_srok" value="12" type="number" min="1" max="18" step="1/">мес.</em></td>
                          </tr>
                          <tr>
                              <td>
                                  <div id="ke_srokSlider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"></div><br><hr>
                              </td>
                          </tr>
                      </tbody></table>

                  </section>
                  <section class="4u 12u(2)  payment center" style="padding-top: 179.827px;">
                      <h2 class="center">
                          <em>Ежемесячный платеж: <br></em>
                          <span id="ke_res">32 276 руб.</span>
                      </h2>
                  </section>
              </div>
              <div class="row">
                  <section class="12u 12u(2) center">
                      <a class="button center" id="ke_scheludeButton" style="display: inline-block;">Показать график платежей</a>
                      <table id="ke_scheludeTable" class="default" style="display: none;">
              <tfoot>
                <tr>
                  <td colspan="5">
                    <em>*представленный график платежей носит информационный характер и не является публичной офертой.</em>
                  </td>
                </tr>
              </tfoot>
                          <thead>
                              <tr>
                                  <td>#</td>
                                  <td>Сумма платежа</td>
                                  <td>Основной долг</td>
                                  <td>Проценты</td>
                                  <td>Остаток основного долга</td>
                              </tr>
                          </thead>
                          <tbody><tr><td>1</td><td>32 276</td><td>19 536</td><td>12 740</td><td>280 464</td></tr><tr><td>2</td><td>32 276</td><td>20 365</td><td>11 910</td><td>260 099</td></tr><tr><td>3</td><td>32 276</td><td>21 943</td><td>10 333</td><td>238 156</td></tr><tr><td>4</td><td>32 276</td><td>22 162</td><td>10 113</td><td>215 994</td></tr><tr><td>5</td><td>32 276</td><td>23 399</td><td>8 876</td><td>192 595</td></tr><tr><td>6</td><td>32 276</td><td>24 097</td><td>8 179</td><td>168 498</td></tr><tr><td>7</td><td>32 276</td><td>25 351</td><td>6 925</td><td>143 147</td></tr><tr><td>8</td><td>32 276</td><td>26 197</td><td>6 079</td><td>116 950</td></tr><tr><td>9</td><td>32 276</td><td>27 309</td><td>4 966</td><td>89 641</td></tr><tr><td>10</td><td>32 276</td><td>28 592</td><td>3 684</td><td>61 049</td></tr><tr><td>11</td><td>32 276</td><td>29 683</td><td>2 593</td><td>31 366</td></tr><tr><td>12</td><td>32 655</td><td>31 366</td><td>1 289</td><td>0</td></tr><tr class="scheludeTotal"><td>Итого</td><td>387 686</td><td>300 000</td><td>87 686</td><td> - </td></tr></tbody>
                      </table>
                      <a class="button center" id="ke_scheludeClose" style="display: none; padding-top: 0.75em; padding-bottom: 0.75em;">Скрыть график платежей</a>
                      <br><br>
                  </section>
              </div>
          </div>
      </section>
    <section class="wrapper style2">
          <div class="container">
              <header class="major">
                  <h2>Заявка на займ</h2>
                  <p style="margin-bottom: -3em;"></p>
              </header>
              <div class="row" id="ke_form_small">
                  <section class="12u 12u(2)">
                      <div id="ke_small_form" class="formTabs">
                          <div class="row">
                              <!--<section class="12u 12u(2)">
                                  <h2 class="center" style="margin-bottom: -20px;">Краткая заявка</h2>
                              </section>-->
                              <section class="4u 12u(2)">
                                  <label for="ke_small_type">
                                      <span>Вид займа:</span>
                                      <select class="inputSelect" id="ke_small_type" type="select" name="UF_CRM_1450769723">
                                          <option value="CD">Без залога</option>
                                          <option value="CDN">Залог недвижимости</option>
                                          <option value="CDA">Залог автомобиля</option>
                                      </select>
                                  </label>
                              </section>
                              <section class="4u 12u(2)">
                                  <label for="ke_small_summ">
                                      <span>Сумма займа:</span>
                                      <input type="number" name="OPPORTUNITY" class="inputNumber" id="ke_small_summ" value="400000" tooltip="Укажите необходимый размер лимита (в рублях) <hr/> ✓ Например: 400 000">
                                      <input type="hidden" name="CURRENCY_ID" value="RUB">
                                  </label>
                              </section>
                              <section class="4u 12u(2)">
                                  <label for="ke_small_auto" style="display: none;">
                                      <span>Автомобиль:</span>
                                      <input type="text" name="UF_CRM_1450772521" id="ke_small_auto" tooltip="Укажите марку, модель и год выпуска автомобиля <hr/>✓ Например: Opel Astra 2010">
                                  </label>
                                  <label for="ke_small_build" style="display: none;">
                                      <span>Недвижимость:</span>
                                      <input type="text" name="UF_CRM_1450772521" id="ke_small_build" value="Квартира ул. Милашенкова д.1, 83" tooltip="Укажите объект недвижимости <hr/>✓ Например: Квартира ул. Милашенкова д.1, 83">
                                  </label>
                              </section>
                          </div>
                          <div class="row">
                              <section class="4u 12u(2)">
                                  <label for="ke_small_phone">
                                      <span>Телефон:</span>
                                      <input type="tel" name="PHONE[0][VALUE]" id="ke_small_phone" mask="+7 (999) 999 99 99" value="+79265766710" tooltip="Укажите телефон для связи <hr/>✓ Например: 8 123 456 78 90">
                                      <input type="hidden" name="PHONE[0][VALUE_TYPE]" value="WORK">
                                  </label>
                              </section>
                              <section class="4u 12u(2)">
                                  <label for="ke_small_name">
                                      <span>Ваше имя:</span>
                                      <input type="text" name="NAME" id="ke_small_name" value="Иван" tooltip="Как к Вам обращаться? <hr/>
                               ✓ Например: Иван Иванович">
                                  </label>
                              </section>
                          </div>
                          <div class="row">
                              <section class="6u 12u(2)">
                                  <label for="ke_small_check">
                                      <input type="checkbox" id="ke_small_check" checked="true">
                                      <span>Я согласен(согласна) с <a id="personal_data_condition">условиями обработки</a>моих персональных данных</span>
                                  </label>
                              </section>
                              <section class="6u 12u(2)">
                                  <a class="button center" id="ke_small_submit">Отправить</a>
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
                      </div>
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
  <section>
  <section class="wrapper style2">
          <div class="container">
              <header class="major">
                  <h2>Основные условия</h2>
                  <p style="margin-bottom: -3em;">
          </p>
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
      </section>
    <section class="wrapper style1">
          <div class="container">
              <header class="major">
                  <h2>Документы</h2>
                  <p style="margin-bottom: -4em;"></p>
              </header>
              <div class="row" id="docs">
                  <section class="12u 12u(2)">
            <ul class="my_ul">
              <li><a href="#docs">Правила предоставления микрозаймов</a></li>
              <li><a href="#docs">Образец договора микрозайма</a></li>
              <li><a href="#docs">Образец договора поручительства</a></li>
              <li><a href="#docs">Образец договора залога</a></li>
                    <li><a href="#docs">Брошюра Банка России о работе с МФО</a></li>
            </ul>
          </section>
        </div>
      </div>
    </section>
@endsection
@section('scripts')
<script src="/js/demo/capital-express.js"></script>
@endsection
