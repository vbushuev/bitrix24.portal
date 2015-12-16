<?php
//login renessbank
//pass 7F:pkQWJ

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;


class Bitrix24Controller extends Controller{
    public function getIndex(Request $rq){
        return view('bitrix24.index',$this->getBitrix24Data($rq));
    }
    public function getInstall(Request $rq){
        $bd = $this->getBitrix24Data($rq);
        $params = [
            'auth' => $bd['access_token']
        ];
        $postParams = [
            'auth' => $bd['access_token'],
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
         ];
         $curl= new \Curl();
         $url = 'https://'.$bd['domain'].'/rest/bizproc.activity.add?'.http_build_query($params);
         $curl->create($url);
         $curl->option(CURLOPT_RETURNTRANSFER, true);
         $curl->option(CURLOPT_SSL_VERIFYPEER, false);
         $curl->option(CURLOPT_FOLLOWLOCATION, true);
         print_r(http_build_query($postParams));
         $curl->post(http_build_query($postParams));
         $res = json_decode($curl->execute());
         print_r($res);
         echo "<br/>".$curl->error_code; // int
         echo "<br/>".$curl->error_string;

         // Information
         print_r($curl->info); // array
    }
    public function getMethods(Request $rq){
        $bd = $this->getBitrix24Data($rq);
        $params = [
            'auth' => $bd['access_token']
        ];
        $curl= new \Curl();
        $url = 'https://'.$bd['domain'].'/rest/methods.json?'.http_build_query($params);
        $curl->create($url);
        $curl->option(CURLOPT_RETURNTRANSFER, true);
        $curl->option(CURLOPT_SSL_VERIFYPEER, false);
        $curl->option(CURLOPT_FOLLOWLOCATION, true);
        $res = json_decode($curl->execute());
        print_r($res);
        echo "<br/>".$curl->error_code; // int
        echo "<br/>".$curl->error_string;
        // Information
        print_r($curl->info); // array
    }
    public function getOauth(Request $rq){
        $bd = $this->getBitrix24Data($rq);
        $code = $rq->input('code',false);
        $refresh = $rq->input('refresh',false);
        $clear = $rq->input('clear',false);
        if($code!==false){
            $params = [
                'client_id' => $bd['client_id'],
                'client_secret' => $bd['secret'],
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => urlencode($rq->url())
            ];
            $curl= new \Curl();
            $url = 'https://'.$bd['domain'].'/oauth/token/?'.http_build_query($params);
            $curl->create($url);
            $curl->option(CURLOPT_RETURNTRANSFER, true);
            $curl->option(CURLOPT_SSL_VERIFYPEER, false);
            $curl->option(CURLOPT_FOLLOWLOCATION, true);

            $res = json_decode($curl->execute());
            print_r($res);
            echo "<br/>".$curl->error_code; // int
            echo "<br/>".$curl->error_string;

            // Information
            print_r($curl->info); // array
            $bd['access_token'] = $res->access_token;
            $bd['expires_in'] = time()+$res->expires_in;
		    $bd['user_id'] = $res->user_id;
			$bd['status'] = $res->status;
			$bd['member_id'] = $res->member_id;
			$bd['refresh_token'] = $res->refresh_token;
            $this->setBitrix24Data($rq,$bd);
        }
        else if($refresh!==false){
            $params = [
                'client_id' => $bd['client_id'],
                'client_secret' => $bd['secret'],
                'grant_type' => 'refresh_token',
                'refresh_token' => $bd['refresh_token'],
                'scope' => $bd['scope'],
                'redirect_uri' => urlencode($rq->url())
            ];
            $curl= new \Curl();
            $url = 'https://'.$bd['domain'].'/oauth/token/?'.http_build_query($params);
            $curl->create($url);
            $curl->option(CURLOPT_RETURNTRANSFER, true);
            $curl->option(CURLOPT_SSL_VERIFYPEER, false);
            $curl->option(CURLOPT_FOLLOWLOCATION, true);

            $res = json_decode($curl->execute());
            print_r($res);
            echo "<br/>".$curl->error_code; // int
            echo "<br/>".$curl->error_string;

            // Information
            print_r($curl->info); // array
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
    protected function isAuthenticated($bd){
        return isset($bd['access_token'])&&!empty($bd['access_token']);
    }
    protected function getBitrix24Data(Request $rq){
        if($rq->session()->has('bitrix24Oauth')){
            return $rq->session()->get('bitrix24Oauth');
        }
        $bd = [
            'domain' => 'oookbrenessans.bitrix24.ru',
            'client_id' => 'local.566973a3ec7410.58002193',
            'secret' => '802232f8073927f1b07b812c4b9a4b3f',
            'scope' => [] //['disk','crm','task','user','bizproc','im','log','mailservice','department']
            //'scope' => ['bizproc']
        ];
        $rq->session()->put('bitrix24Oauth',$bd);
        return $bd;
    }
    protected function setBitrix24Data(Request $rq,$bd){
        $rq->session()->put('bitrix24Oauth',$bd);
    }
    /*
    $test = isset($_REQUEST["test"]) ? $_REQUEST["test"] : "";
        switch($test){
            case 'user.current': // test: user info

                $data = $this->call($_SESSION["query_data"]["domain"], "user.current", array(
                    "auth" => $_SESSION["query_data"]["access_token"])
                );

            break;

            case 'user.update': // test batch&files

                $fileContent = file_get_contents(dirname(__FILE__)."/images/MM35_PG189a.jpg");

                $batch = array(
                    'user' => 'user.current',
                    'user_update' => 'user.update?'
                        .http_build_$this->query(array(
                            'ID' => '$result[user][ID]',
                            'PERSONAL_PHOTO' => array(
                                'avatar.jpg',
                                base64_encode($fileContent)
                            )
                        ))
                );

                $data = $this->call($_SESSION["query_data"]["domain"], "batch", array(
                    "auth" => $_SESSION["query_data"]["access_token"],
                    "cmd" => $batch,
                ));

            break;

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
