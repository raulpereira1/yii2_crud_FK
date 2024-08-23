<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\pessoas\PessoaEsporte $model */

$this->title = 'Create Pessoa Esporte';
$this->params['breadcrumbs'][] = ['label' => 'Pessoa Esportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-esporte-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
