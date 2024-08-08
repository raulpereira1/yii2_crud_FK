<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\pais\PaisModel $model */

$this->title = 'Create Pais Model';
$this->params['breadcrumbs'][] = ['label' => 'Pais Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pais-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
