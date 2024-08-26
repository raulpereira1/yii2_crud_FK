<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\pessoas\PessoasModel $model */
/* @var app\models\pessoaendereco\PessoaEndereco $modelEndereco */


$this->title = 'Create Pessoas Model';
$this->params['breadcrumbs'][] = ['label' => 'Pessoas Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoas-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelEndereco' => $modelEndereco,
    ]) ?>

</div>
