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

    

    public function index($inUrl)
     {
        $ListUrl = array();
        $urlObs = "https://http-observatory.security.mozilla.org/api/v1/analyze?host=";
        $response = Http::get($urlObs.$inUrl);
        if ($response->successful()){
            //miramos si la respuesta de la api es "error"
            if (isset($response->json()["error"])){
                $array = ["grade"=> "error", "state"=>$response->json()["text"], "url"=>$urlObs.$inUrl, "api" => "Observatory Mozilla"] ;
                array_push($ListUrl, $array);
            }else{
                $array = ["grade"=> $response->json()["grade"], "state"=>$response->json()["state"], "url"=>$urlObs.$inUrl, "api" => "Observatory Mozilla"] ;
                array_push($ListUrl, $array);
            }
        }else{
            $array = ["grade"=> "error", "state"=>"en el observatory", "url"=>$inUrl, "api" => "Observatory Mozilla"] ;
            array_push($ListUrl, $array);
        }
        
        //otra api
        $array = [];
        $urlSecuri = "https://sitecheck.sucuri.net/api/v3/?scan=";
        $response = Http::get($urlSecuri.$inUrl);
        if ($response->successful()){
            //miramos si la respuesta de la api es "error"
            if (isset($response->json()["error"]) || isset($response->json()["warnings"]["scan_failed"])){
                $array = ["grade"=> "error", "state"=>$response->json()["warnings"]["scan_failed"][0]["msg"], "url"=>$urlSecuri.$inUrl, "api" => "Securi"] ;
                array_push($ListUrl, $array);
            }else{                
                $array = ["grade"=> "Total: " , "state"=>$response->json()["ratings"]["total"]["rating"], "url"=>$urlSecuri.$inUrl, "api" => "Securi"] ;
                array_push($ListUrl, $array);
                $array = ["grade"=> "TLS: ", "state"=>$response->json()["ratings"]["tls"]["rating"], "url"=>$urlSecuri.$inUrl, "api" => "Securi"] ;
                array_push($ListUrl, $array);
                $array = ["grade"=> "Domain: ", "state"=>$response->json()["ratings"]["domain"]["rating"], "url"=>$urlSecuri.$inUrl, "api" => "Securi"] ;
                array_push($ListUrl, $array);
                $array = ["grade"=> "Security: ", "state"=>$response->json()["ratings"]["security"]["rating"], "url"=>$urlSecuri.$inUrl, "api" => "Securi"] ;
                array_push($ListUrl, $array);
            }
        }else{
            $array = ["grade"=> "error", "state"=>"en Securi", "url"=>$inUrl, "api" => "Securi"] ;
            array_push($ListUrl, $array);
        }

        return $ListUrl;
     }
 } 