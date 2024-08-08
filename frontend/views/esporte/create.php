<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EsporteModel $model */

$this->title = 'Create Esporte Model';
$this->params['breadcrumbs'][] = ['label' => 'Esporte Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="esporte-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
