<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use vsb\ConturFocus;

class ConturFocusController extends Controller
{
    /**
     * Search method
     *
     * @return \Illuminate\Http\Response
     */
    public function getSearch(Request $rq)
    {
        return view('contur-focus.search');
    }
    public function getTest(Request $rq){
        
    }
    public function postTest(Request $rq){}
    public function postSearch(Request $rq){
        $search = $rq->input('search','empty');
        $rs=[
            'posted' => '$search:'.$search
        ];
        if($search!=='empty'){
            $cf=new ConturFocus([
                'proxy' => [
                    /*
                    'type' => CURLPROXY_HTTP,
                    'host' => '192.168.11.7',
                    'port' => 8080,
                    'auth' => CURLAUTH_NTLM,
                    'userpwd' => 'v.bushuev:Vampire04'
                    */
                ],
				'trace' =>[
					'file' => '../storage/logs/curltrace'
				]
			]);
            print_r($cf->getOptions());
            $rs['result']=$cf->Search($search);
        }
        return response()->json($rs);
    }
    public function getIndex(Request $rq){
        return view('contur-focus.index');
    }
}
