<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\pessoas\PessoasModel $model */
/** @var  frontend\controllers\PessoasController $esporteSelecionado */

$this->title = 'Update Pessoas Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pessoas Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pessoas-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>
