<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\pessoas\PessoaEsporte $model */

$this->title = 'Update Pessoa Esporte: ' . $model->id_esporte;
$this->params['breadcrumbs'][] = ['label' => 'Pessoa Esportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_esporte, 'url' => ['view', 'id_esporte' => $model->id_esporte, 'id_pessoa' => $model->id_pessoa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pessoa-esporte-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
