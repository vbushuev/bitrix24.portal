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
        $vd = [
            'session' => $this->getBitrix24Data($rq),
            'data' => []
        ];
        if(!$this->isAuthenticated($vd['session']))return $this->redirectOAuth($rq);
        return view('bitrix24.index',$vd);
    }
    public function getCc(Request $rq){
        $vd = [
            'session' => $this->getBitrix24Data($rq),
            'data' => []
        ];
        if(!$this->isAuthenticated($vd['session']))return $this->redirectOAuth($rq);
        return view('bitrix24.cc',$vd);
    }
    public function postEvent(Request $rq){}
    public function getEvents(Request $rq){
        $vd = [
            'session' => $this->getBitrix24Data($rq),
            'data' => $this->callBX([
                'action' => 'events'],$rq)
        ];
        if(!$this->isAuthenticated($vd['session']))return $this->redirectOAuth($rq);
        return view('bitrix24.events',$vd);
    }
    public function getBindevent(Request $rq){
        $vd = [
            'session' => $this->getBitrix24Data($rq),
            'data' => $this->callBX([
                'action' => 'event.bind',
                //'debug' => true,
                'method' => 'get',
                'params' => [
                    'event' => $rq->input('event')
                    ,'handler' => $rq->root().'/event?event='.$rq->input('event')
                ]
            ],$rq)
        ];
        return view('bitrix24.events',$vd);
    }
    public function postCc(Request $rq){
        $fio = $rq->input('fio');
        $uploadFile = [];
        if($rq->hasFile('passport')){
            $scan = $rq->file('passport')->move('../storage/logs/');
            $uploadFile = [
                $scan->getFilename(),
                base64_encode(file_get_contents($scan))
            ];
        }
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
            'PHONE' => $rq->input('phone','NOPHONE'),
            'UF_CRM_1451053103' => $uploadFile,
            'UF_CRM_1450769723' => 'CC',
            'UF_CRM_1448534725' => 'Кредитная карта'
        ];
        $vd = [
            'session' => $this->getBitrix24Data($rq),
            'debug' => "File path: [".($rq->hasFile('passport')?$uploadFile[1]:'nofile uploaded')."]",
            'data' => $this->callBX([
                'action' => 'crm.lead.add',
                'params' => [
                    'fields' => $fields,
            		'params' =>  [ "REGISTER_SONET_EVENT" => "Y" ]
                ]
            ],$rq)
        ];
        //unlink($scan);
        return view('bitrix24.cc',$vd);
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
        $vd = [
            'session' => $this->getBitrix24Data($rq),
            'type' => 'userfields',
            'data' => $this->callBX([
                    'action' => 'crm.lead.userfield.list',
                    'params' => [
                        'order' => [ 'SORT' => 'ASC' ]
                    ]
                ],$rq)
        ];
        if(!$this->isAuthenticated($vd['session']))return $this->redirectOAuth($rq);
        return view('bitrix24.common',$vd);
    }
    public function getLeadfields(Request $rq){
        $vd = [
            'session' => $this->getBitrix24Data($rq),
            'type' => 'fields',
            'data' => $this->callBX( [ 'action' => 'crm.lead.fields' ], $rq )
        ];
        if(!$this->isAuthenticated($vd['session']))return $this->redirectOAuth($rq);
        return view('bitrix24.common',$vd);
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
            Redirect::to($bd['current']['url']);
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
        else if(!$this->isAuthenticated($bd)) return $this->redirectOAuth($rq);
        return Redirect::to('/bitrix24');
    }
    public function getUserinfo(Request $rq){
        $rs = $this->callBX([
            'action' => 'user.current'
        ],$rq);
    }
    public function postBlacklist(Request $rq){
        file_put_contents('../storage/logs/blacklist.request.log',date('Y-m-d h:i:s').': request['.join($rq->all(),';').']\n',FILE_APPEND);
    }
    protected function isAuthenticated($bd){
        return isset($bd['access_token'])&&!empty($bd['access_token']);
    }
    protected function redirectOAuth(Request $rq){
        $bd = $this->getBitrix24Data($rq);
        $params = [
            'client_id' => $bd['client_id'],
            'response_type' => 'code',
            'redirect_uri' => urlencode($rq->url())
        ];
        $url = 'https://'.$bd['domain'].'/oauth/authorize/?'.http_build_query($params);
        return Redirect::to($url);
    }
    protected function getBitrix24Data(Request $rq){
        $bd = ($rq->session()->has('bitrix24Oauth'))
            ? $rq->session()->get('bitrix24Oauth')
            : $this->bxData;
        if(isset($bd['expires_in']) && time() >= $bd['expires_in'] ){ //expired
            $bd['access_token'] = '';
        }
        $bd['current']['url'] = (!$rq->is('oauth/*'))?$rq->fullUrl():'/bitrix24';
        $rq->session()->put('bitrix24Oauth',$bd);
        return $bd;
    }
    protected function setBitrix24Data(Request $rq,$bd){
        $rq->session()->put('bitrix24Oauth',$bd);
    }
    protected function callBX($p = [],Request $rq){
        $bd = $this->getBitrix24Data($rq);
        $method = isset($p['method'])?$p['method']:'post';
        $params = isset($p['params'])?$p['params']:[];
        $debug =  isset($p['debug'])?$p['debug']:false;
        if($this->isAuthenticated($bd)) $params['auth'] = $bd['access_token'];
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
}
