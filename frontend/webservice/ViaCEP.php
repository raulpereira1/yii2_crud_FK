<?php
namespace frontend\webservice;
class ViaCEP
{
    /**
     *metodos responsavel por consulta no via cep
     * @param string $cep
     * @return array
     */
        public static function consultarCEP($cep){

            $curl = curl_init();
            curl_setopt_array($curl,[
                CURLOPT_URL => "https://viacep.com.br/ws/$cep/json/",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "GET",
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            $cepArray = json_decode($response,true);
            return isset($cepArray["cep"])?$cepArray:null;
        }

}