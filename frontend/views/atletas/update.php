<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AtletasModel $model */

$this->title = 'Update Atletas Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Atletas Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atletas-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
