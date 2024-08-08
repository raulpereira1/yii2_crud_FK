<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ModalidadeModel;

/** @var yii\web\View $this */
/** @var app\models\EsporteModel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="esporte-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_esporte')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tipo')->dropDownList(ArrayHelper::map(ModalidadeModel::find()->all(),'id','tipo_esporte')) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
