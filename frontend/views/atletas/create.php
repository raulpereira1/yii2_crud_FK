<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var app\models\AtletasModel $model */
/** @var frontend\controllers\AtletasController $esporteTipo1 */
/** @var frontend\controllers\AtletasController $esporteTipo2 */


$this->title = 'Criando um novo atleta';
$this->params['breadcrumbs'][] = ['label' => 'Atletas Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atletas-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'esporteTipo1' => $esporteTipo1,
        'esporteTipo2' => $esporteTipo2,
    ]) ?>

</div>
