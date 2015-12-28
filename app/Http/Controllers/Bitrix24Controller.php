<?php
namespace App\Http\Controllers;

//login renessbank
//pass 7F:pkQWJ
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;


class Bitrix24Controller extends Controller{
    protected $bxData = [];
    public function __construct(){
        $this->bxData = [
            'domain' => config('bitrix24.domain'),
            'client_id' => config('bitrix24.client_id'),
            'secret' => config('bitrix24.secret'),
            'scope' => config('bitrix24.scope')
        ];
    }
    public function getIndex(Request $rq){
        return view('bitrix24.index',$this->getBitrix24Data($rq));
    }
    public function getCc(Request $rq){
        return view('bitrix24.cc',$this->getBitrix24Data($rq));
    }
    public function getEvents(Request $rq){
        $rs = $this->callBX([
            'action' => 'events'
        ],$rq);
        $vd = [
            'session' => $this->getBitrix24Data($rq),
            'data' => $rs
        ];
        return view('bitrix24.events',$vd);
    }
    public function postCc(Request $rq){
        $fio = $rq->input('fio');
        $fields = [
            'NAME' => $fio['name'],
            'TITLE' => $fio['name'],
            'SOURCE_ID' => 'WEB',
            'SECOND_NAME' => $fio['sur'],
            'LAST_NAME' => $fio['last'],
            'STATUS_ID' => 'NEW',
            'OPENED' => 'Y',
            'ASSIGNED_BY_ID' => '28',
            'CURRENCY_ID' => $rq->input('CURRENCY_ID','RUB'),
            'OPPORTUNITY' => $rq->input('amount','0'),
            'PHONE' => $rq->input('phone','NOPHONE')
        ];
        //echo json_encode($fields); return;
        $rs = $this->callBX([
            'action' => 'crm.lead.add',
            'params' => [
                'fields' => $fields,
        		'params' =>  [ "REGISTER_SONET_EVENT" => "Y" ]
            ]
        ],$rq);
        echo json_encode($rs);
        return view('bitrix24.cc',$this->getBitrix24Data($rq));
    }
    public function getInstall(Request $rq){
        $rs = $this->callBX([
            'action' => 'bizproc.activity.add',
            'params' => [
                'CODE' =>  'contur-focus',
                'HANDLER' =>  'http://bitrix24.portal.bs2/contur-focus/search',
                //'AUTH_USER_ID' =>  1,
                //'USE_SUBSCRIPTION' =>  'Y',
                'NAME' =>  [
                    'ru' =>  'Проверка сервисом Контур-Фокус',
                    'en' =>  'Contur-Focus Legacity check'
                ],
                'DESCRIPTION' =>  [
                    'ru' =>  'Проверяет статусс юрлица',
                    'en' =>  'Lagacity check'
                ],
                 'PROPERTIES' =>  [
                    'q' =>  [
                       'Name' =>  [
                          'ru' =>  'Наименоваание организации',
                          'en' =>  'Entity name'
                       ],
                       'Description' =>  [
                          'ru' =>  'Введите Наименоваание организации',
                          'en' =>  'Input Entity name'
                       ],
                       'Type' =>  'string',
                       'Required' =>  'Y',
                       'Multiple' =>  'N',
                       'Default' =>  '{=Document:NAME}'
                    ]
                 ],
                 'RETURN_PROPERTIES' =>  [
                    'outputString' =>  [
                       'Name' =>  [
                          'ru' =>  'MD5',
                          'en' =>  'MD5'
                       ],
                       'Type' =>  'string',
                       'Multiple' =>  'N',
                       'Default' =>  null
                    ]
                 ],
                 //'DOCUMENT_TYPE' =>  ['lists', 'BizprocDocument', 'iblock_1'],
                 //'FILTER' =>  [INCLUDE => [['lists']]]
             ]
        ],$rq);
    }
    public function getLeaduserfields(Request $rq){
        $rs = $this->callBX([
            'action' => 'crm.lead.userfield.list',
            'params' => [
                'order' => [ 'SORT' => 'ASC' ]
            ]
        ],$rq);
        foreach ($rs->result as $field) {
            print_r($field);
            echo '<br>';
            /*
            [result] => Array (
                [0] => stdClass Object (
                    [ID] => 152
                    [ENTITY_ID] => CRM_LEAD
                    [FIELD_NAME] => UF_CRM_1448526372
                    [USER_TYPE_ID] => integer
                    [XML_ID] =>
                    [SORT] => 100
                    [MULTIPLE] => N
                    [MANDATORY] => N
                    [SHOW_FILTER] => E
                    [SHOW_IN_LIST] => Y
                    [EDIT_IN_LIST] => Y
                    [IS_SEARCHABLE] => N
                    [SETTINGS] => stdClass Object ( [SIZE] => 20 [MIN_VALUE] => 0 [MAX_VALUE] => 0 [DEFAULT_VALUE] => )
                )
                [1] => stdClass Object ( [ID] => 166 [ENTITY_ID] => CRM_LEAD [FIELD_NAME] => UF_CRM_1450340090 [USER_TYPE_ID] => string [XML_ID] => [SORT] => 100 [MULTIPLE] => N [MANDATORY] => N [SHOW_FILTER] => E [SHOW_IN_LIST] => Y [EDIT_IN_LIST] => Y [IS_SEARCHABLE] => N [SETTINGS] => stdClass Object ( [SIZE] => 20 [ROWS] => 1 [REGEXP] => [MIN_LENGTH] => 0 [MAX_LENGTH] => 0 [DEFAULT_VALUE] => ) )
                [2] => stdClass Object ( [ID] => 168 [ENTITY_ID] => CRM_LEAD [FIELD_NAME] => UF_CRM_1450769723 [USER_TYPE_ID] => enumeration [XML_ID] => [SORT] => 100 [MULTIPLE] => N [MANDATORY] => N [SHOW_FILTER] => N [SHOW_IN_LIST] => Y [EDIT_IN_LIST] => Y [IS_SEARCHABLE] => N [SETTINGS] => stdClass Object ( [DISPLAY] => CHECKBOX [LIST_HEIGHT] => 1 [CAPTION_NO_VALUE] => ) [LIST] => Array ( [0] => stdClass Object ( [ID] => 44 [SORT] => 10 [VALUE] => BG [DEF] => Y ) [1] => stdClass Object ( [ID] => 46 [SORT] => 20 [VALUE] => CDN [DEF] => N ) [2] => stdClass Object ( [ID] => 48 [SORT] => 30 [VALUE] => CDA [DEF] => N )
                [3] => stdClass Object ( [ID] => 50 [SORT] => 40 [VALUE] => CD [DEF] => N ) [4] => stdClass Object ( [ID] => 52 [SORT] => 50 [VALUE] => DT [DEF] => N ) ) ) [3] => stdClass Object ( [ID] => 156 [ENTITY_ID] => CRM_LEAD [FIELD_NAME] => UF_CRM_1448534725 [USER_TYPE_ID] => string [XML_ID] => [SORT] => 200 [MULTIPLE] => N [MANDATORY] => N [SHOW_FILTER] => E [SHOW_IN_LIST] => Y [EDIT_IN_LIST] => Y [IS_SEARCHABLE] => N [SETTINGS] => stdClass Object ( [SIZE] => 20 [ROWS] => 1 [REGEXP] => [MIN_LENGTH] => 0 [MAX_LENGTH] => 0 [DEFAULT_VALUE] => BG ) ) ) [total] => 4
            */
        }
    }
    public function getLeadfields(Request $rq){
        $rs = $this->callBX([
            'action' => 'crm.lead.fields',

        ],$rq);
        foreach ($rs->result as $field) {
            print_r($field);
            echo '<br>';
        }
    }
    public function getLeadadd(Request $rq){
        $rs = $this->callBX([
            'action' => 'crm.lead.add',
            'params' => [
                'fields' => [
                    'NAME' => $rq->input('NAME','NONAME'),
                    'TITLE' => $rq->input('NAME','NONAME'),
                    'SECOND_NAME' => '',
                    'LAST_NAME' => '',
                    'STATUS_ID' => 'NEW',
                    'OPENED' => 'Y',
                    'ASSIGNED_BY_ID' => '1',
                    'CURRENCY_ID' => $rq->input('CURRENCY_ID','RUB'),
                    'OPPORTUNITY' => $rq->input('OPPORTUNITY','0'),
                    'PHONE' => $rq->input('PHONE','NOPHONE')
                ],
        		'params' =>  [ "REGISTER_SONET_EVENT" => "Y" ]
            ]
        ],$rq);
        echo json_encode($rs);
    }
    public function getMethods(Request $rq){
        $rs = $this->callBX([
            'action' => 'methods'
        ],$rq);
    }
    public function getOauth(Request $rq){
        $bd = $this->getBitrix24Data($rq);
        $code = $rq->input('code',false);
        $refresh = $rq->input('refresh',false);
        $clear = $rq->input('clear',false);
        if($code!==false){
            $rs = $this->callBX([
                'action' => ''
                ,'path' => '/oauth/token/'
                ,'method' => 'get'
                ,'protocol' => ''
                ,'params' => [
                    'client_id' => $bd['client_id'],
                    'client_secret' => $bd['secret'],
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'scope' => $bd['scope'],
                    'redirect_uri' => urlencode($rq->url())
                ]
            ],$rq);
            print_r($rs);
            $bd['access_token'] = $rs->access_token;
            $bd['expires_in'] = time()+$rs->expires_in;
		    $bd['user_id'] = $rs->user_id;
			$bd['status'] = $rs->status;
			$bd['member_id'] = $rs->member_id;
			$bd['refresh_token'] = $rs->refresh_token;
            $this->setBitrix24Data($rq,$bd);
        }
        else if($refresh!==false){
            $res = $this->callBX([
                'action' => ''
                ,'path' => '/oauth/token/'
                ,'method' => 'get'
                ,'protocol' => ''
                ,'params' => [
                    'client_id' => $bd['client_id'],
                    'client_secret' => $bd['secret'],
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $bd['refresh_token'],
                    'scope' => $bd['scope'],
                    'redirect_uri' => urlencode($rq->url())
                ]
            ],$rq);
            $bd['access_token'] = $res->access_token;
            $bd['expires_in'] = time()+$res->expires_in;
			$bd['user_id'] = $res->user_id;
			$bd['member_id'] = $res->member_id;
			$bd['refresh_token'] = $res->refresh_token;
            $this->setBitrix24Data($rq,$bd);
        }
        else if($clear!==false){
            $rq->session()->flush();
        }
        else if(!$this->isAuthenticated($bd)){
            //getCode
            $params = [
                'client_id' => $bd['client_id'],
                'response_type' => 'code',
                'redirect_uri' => urlencode($rq->url())
            ];
            $url = 'https://'.$bd['domain'].'/oauth/authorize/?'.http_build_query($params);
            return Redirect::to($url);
        }
        return Redirect::to('/bitrix24');
    }
    public function getUserinfo(Request $rq){
        $rs = $this->callBX([
            'action' => 'user.current'
        ],$rq);
    }
    protected function isAuthenticated($bd){
        return isset($bd['access_token'])&&!empty($bd['access_token']);
    }
    protected function getBitrix24Data(Request $rq){
        if($rq->session()->has('bitrix24Oauth')){
            return $rq->session()->get('bitrix24Oauth');
        }
        $bd = $this->bxData;
        $rq->session()->put('bitrix24Oauth',$bd);
        return $bd;
    }
    protected function setBitrix24Data(Request $rq,$bd){
        $rq->session()->put('bitrix24Oauth',$bd);
    }
    protected function callBX($p = [],Request $rq){
        $bd = $this->getBitrix24Data($rq);
        if(!$this->isAuthenticated($bd)){
            //getCode
            $params = [
                'client_id' => $bd['client_id'],
                'response_type' => 'code',
                'redirect_uri' => urlencode($rq->url())
            ];
            $url = 'https://'.$bd['domain'].'/oauth/authorize/?'.http_build_query($params);
            //return Redirect::to($url);
        }
        $method = isset($p['method'])?$p['method']:'post';
        $params = isset($p['params'])?$p['params']:[];
        $debug =  isset($p['debug'])?$p['debug']:true;
        $params['auth'] = isset($params['auth'])?$params['auth']:(isset($bd['access_token'])?$bd['access_token']:'');
        $curl= new \Curl();
        $url = 'https://'
            .(isset($p['domain'])?$p['domain']:$bd['domain'])
            .(isset($p['path'])?$p['path']:'/rest/')
            .(isset($p['action'])?$p['action']:'')
            .(isset($p['protocol'])?$p['protocol']:'.json')
            .(($method=='get')?'?'.http_build_query($params):'');
        $curl->create($url);
        $curl->option(CURLOPT_RETURNTRANSFER, true);
        $curl->option(CURLOPT_SSL_VERIFYPEER, false);
        $curl->option(CURLOPT_FOLLOWLOCATION, true);
        $fp=fopen('../storage/logs/curl-err.'.date("Y-m-d").'.log', 'a');
        $curl->option(CURLOPT_VERBOSE,1);
        $curl->option(CURLOPT_STDERR,$fp);

        if($method=='post')$curl->post($params);
        $res = json_decode($curl->execute());
        if($debug){
            echo "<strong>Result</strong>:<p>".json_encode($res)."</p>";
            echo "<br><strong>Error code</strong>".$curl->error_code; // int
            echo "<br><strong>Error string:</strong>".$curl->error_string;
            echo "<br><strong>Curl info:</strong><p>";
            print_r($curl->info); // array
            echo "</p>";
        }
        return $res;
    }
    /*



            case 'event.bind': // bind event handler

                $data = $this->call($_SESSION["query_data"]["domain"], "event.bind", array(
                    "auth" => $_SESSION["query_data"]["access_token"],
                    "EVENT" => "ONCRMLEADADD",
                    "HANDLER" =>$this->options['EVENT_HANDLER'],
                ));

            break;

            case 'log.blogpost.add': // add livefeed entry

                $fileContent = file_get_contents(dirname(__FILE__)."/images/MM35_PG189a.jpg");

                $data = $this->call($_SESSION["query_data"]["domain"], "log.blogpost.add", array(
                    "auth" => $_SESSION["query_data"]["access_token"],
                    "POST_TITLE" => "Hello world!",
                    "POST_MESSAGE" => "Goodbye, cruel world :-(",
                    "FILES" => array(
                        array(
                            'minotaur.jpg',
                            base64_encode($fileContent)
                        )
                    ),

                ));

            break;


            default:

                $data = $_SESSION["query_data"];

            break;
        }

        echo '<pre>'; var_export($data); echo '</pre>';


    */
}
