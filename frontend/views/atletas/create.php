<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AtletasModel $model */

$this->title = 'Create Atletas Model';
$this->params['breadcrumbs'][] = ['label' => 'Atletas Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atletas-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
