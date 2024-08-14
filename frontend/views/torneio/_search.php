<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\torneio\TorneioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="torneio-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome_torneio') ?>

    <?= $form->field($model, 'modalidade_torneio') ?>

    <?= $form->field($model, 'esporte_torneio') ?>

    <?= $form->field($model, 'ativo_torneio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
