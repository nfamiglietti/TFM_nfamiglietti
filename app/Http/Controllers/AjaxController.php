<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
 class AjaxController extends Controller {
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */

    

    public function index($urlNico)
     {
        $ListUrl = array();
        $response = Http::get('https://http-observatory.security.mozilla.org/api/v1/analyze?host='.$urlNico);
        if ($response->successful()){
            //miramos si la respuesta de la api es "error"
            if (isset($response->json()["error"])){
                $array = ["grade"=> "error", "state"=>$response->json()["text"], "url"=>$urlNico, "api" => "Observatory Mozilla"] ;
                array_push($ListUrl, $array);
            }else{
                $array = ["grade"=> $response->json()["grade"], "state"=>$response->json()["state"], "url"=>$urlNico, "api" => "Observatory Mozilla"] ;
                array_push($ListUrl, $array);
            }
        }else{
            $array = ["grade"=> "error", "state"=>"en el observatory", "url"=>$urlNico, "api" => "Observatory Mozilla"] ;
            array_push($ListUrl, $array);
        }
        
        return $ListUrl;
     }
 } 