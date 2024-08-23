<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\pessoas\PessoaEsporte $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pessoa-esporte-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_esporte')->textInput() ?>

    <?= $form->field($model, 'id_pessoa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
