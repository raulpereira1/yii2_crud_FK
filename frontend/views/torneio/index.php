<?php

use app\models\torneio\TorneioModel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\torneio\TorneioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Torneio Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="torneio-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Torneio Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome_torneio',
            'modalidade_torneio',
            'esporte_torneio',
            'ativo_torneio',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TorneioModel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
