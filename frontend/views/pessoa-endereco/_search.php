<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\pessoaendereco\PessoaEnderecoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pessoa-endereco-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cep') ?>

    <?= $form->field($model, 'numero') ?>

    <?= $form->field($model, 'cidade') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'logradouro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
