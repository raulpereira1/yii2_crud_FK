<?php

use app\models\AtletasModel;
use app\models\pais\PaisModel;
use frontend\models\Customer;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\AtletasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Atletas Models';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="atletas-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Atletas Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            [
                    'attribute'=>'id_pais',
                'value'=>'pais.nome_pais'

            ],
            [
                'attribute'=>'id_modalidade',
                'value'=>'modalidade.tipo_esporte'

            ], [
                'attribute'=>'id_esporte',
                'value'=>'esporte.nome_esporte'

            ],


            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AtletasModel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
