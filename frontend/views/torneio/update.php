<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\torneio\TorneioModel $model */

$this->title = 'Update Torneio Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Torneio Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="torneio-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
