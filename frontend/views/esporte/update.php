<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EsporteModel $model */

$this->title = 'Update Esporte Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Esporte Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="esporte-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
