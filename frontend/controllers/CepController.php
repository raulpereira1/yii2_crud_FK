<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\webservice\ViaCEP;

class CepController extends Controller
{
    /**
     * Ação para consultar o CEP e retornar os dados em formato JSON.
     * @param string $cep
     * @return \yii\web\Response
     */
    public function actionConsulta($cep)
    {
        $cepData = ViaCEP::consultarCEP($cep);

        if ($cepData) {
            return $this->asJson($cepData);
        } else {
            return $this->asJson(['erro' => 'CEP não encontrado']);
        }
    }
}
