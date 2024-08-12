<?php
use \app\models\EsporteModel;
use yii\helpers\ArrayHelper;

$esporte = ArrayHelper::map(EsporteModel::find()->all(),'id','nome_esporte');
echo '<pre>';
print_r($esporte);

$id = 3;
if($id === 3){
    return print_r('voce escolheu o futebol');
}
?>
ola mundo

