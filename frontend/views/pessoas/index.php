<?php

use app\models\pessoas\PessoaEsporte;
use app\models\pessoas\PessoasModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PessoasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pessoas Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoas-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pessoas Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'data_nascimento',
            'id_cargo',
            'esporte',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PessoasModel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<?php foreach ($pessoas as $pessoa):?>
    <div>
        <h5><?=$pessoa->nome ?>(IDADE:<?= $pessoa->data_nascimento?>)</h5>
        <p>Cargo: <?= $pessoa->cargo->nome_cargo?></p>

        <p>Esportes:</p>
        <ul>
            <?php foreach ($pessoa->esportes as $esporte): ?>
                <li><?= $esporte->nome_esporte ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>