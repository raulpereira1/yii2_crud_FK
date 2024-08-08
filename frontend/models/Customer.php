<?php

namespace frontend\models;

use app\models\EsporteModel;
use app\models\ModalidadeModel;
use yii\db\ActiveRecord;

class Customer extends ActiveRecord
{
    public function getEsporteModel(){
        return $this->hasMany(EsporteModel::className(),['id_esporte'=>'nome_esporte']);

    }
    public function getModalidadeModel(){
        return $this->hasOne(ModalidadeModel::className(),['tipo_esporte'=>'id_modalidade']);
    }
    public static function tableName(){
        return 'atletas';

    }
public function rules()
{
    return[

        [['nome'], 'nome'],
        [['id_esporte'], 'nome_esporte'],
        [['id_pais'], 'nome_pais'],
        [['id_modalidade'], 'tipo_esporte'],

    ];
}
}