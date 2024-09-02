<?php
namespace frontend\webservice;
class ViaCEP
{
    /**
     *metodos responsavel por consulta no via cep
     * @param string $logradouro
     * @param string $uf
     * @param string $cidade
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

        public static function buscarEndereco($estado,$cidade,$logradouro){
            $curl = curl_init();
            curl_setopt_array($curl,[
                CURLOPT_URL => "https://viacep.com.br/ws/$estado/$cidade/$logradouro/json/",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "GET",
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            $cepArray = json_decode($response,true);
            return isset($cepArray["cep"])?$cepArray:null;        }
}
