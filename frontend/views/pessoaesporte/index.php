<?php

use app\models\pessoas\PessoaEsporte;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PessoaEsporteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pessoa Esportes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-esporte-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pessoa Esporte', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_esporte',
            'id_pessoa',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PessoaEsporte $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_esporte' => $model->id_esporte, 'id_pessoa' => $model->id_pessoa]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
