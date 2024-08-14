<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\torneio\TorneioModel $model */

$this->title = 'Create Torneio Model';
$this->params['breadcrumbs'][] = ['label' => 'Torneio Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="torneio-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
