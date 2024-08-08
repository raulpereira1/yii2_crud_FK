<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\EsporteModel;
use app\models\pais\PaisModel;
use app\models\ModalidadeModel;

/** @var yii\web\View $this */
/** @var app\models\AtletasModel $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="atletas-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_modalidade')->dropDownList(ArrayHelper::map(ModalidadeModel::find()->all(),'id','tipo_esporte')) ?>

    <?= $form->field($model, 'id_esporte')->dropDownList(ArrayHelper::map(EsporteModel::find()->all(), 'id', 'nome_esporte')); ?>

    <?= $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map(PaisModel::find()->all(),'id','nome_pais')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
