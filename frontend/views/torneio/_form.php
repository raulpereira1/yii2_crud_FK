<?php

use app\models\EsporteModel;
use app\models\ModalidadeModel;
use app\models\torneio\TorneioModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\torneio\TorneioModel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="torneio-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_torneio')->textInput(['maxlength' => true]) ?>


    <?=  $form->field($model, 'modalidade_torneio')->dropDownList(ArrayHelper::map(ModalidadeModel::find()->all(),'id','tipo_esporte'),)
    //$form->field($model, 'modalidade_torneio')->textInput()
    ?>

    <?= $form->field($model, 'esporte_torneio')->dropDownList(ArrayHelper::map(EsporteModel::find()->all(),'id','nome_esporte'),)
    ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
