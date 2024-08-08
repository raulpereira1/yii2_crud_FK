<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\pais\PaisModel $model */

$this->title = 'Update Pais Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pais Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pais-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
