<?php

namespace frontend\controllers;

use app\models\AtletasModel;
use app\models\EsporteModel;
use yii\web\Controller;


class CustomerController extends Controller
{ public function actionIndex()
{
    $atleta = AtletasModel::find()->with(['esporte', 'modalidade'])->all();

    return $this->render('index', ['atleta' => $atleta]);

}



}