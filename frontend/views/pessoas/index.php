<?php

use app\models\pessoas\Cargo;
use app\models\pessoas\PessoaEsporte;
use app\models\pessoas\PessoasModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use frontend\webservice\ViaCEP;

/** @var yii\web\View $this */
/** @var app\models\PessoasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\pessoas\PessoasModel $model */

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

            [
                'attribute' => 'foto_pessoa',
                'label' => 'Foto',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img(Url::to('@web/files/' . $model->foto_pessoa), ['alt' => $model->nome, 'style' => 'width: 80px;']);
                },
            ],

            'nome',

            [
                'label' => 'Idade',
                'value' => function ($model) {
                    return $model->getIdade() . ' anos';
                }
            ],
            ['attribute' => 'cargo.nome_cargo', 'label' => 'Cargo'],
            ['attribute' => 'esportes', 'label' => 'Esportes', 'value' => function ($model) {return implode(', ', array_column($model->esportes, 'nome_esporte'));},],
            ['attribute' => 'pessoaEndereco.logradouro', 'label' => 'Logradouro',],
            ['attribute' => 'pessoaEndereco.cidade', 'label' => 'Cidade',],
            ['attribute' => 'pessoaEndereco.estado', 'label' => 'Estado',],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PessoasModel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
<!---->
<!--    --><?php //foreach ($pessoas as $pessoa):?>
<!--        <div>-->
<!--            <h5>--><?php //=$pessoa->nome ?><!--(IDADE:--><?php //= $pessoa->data_nascimento?><!--)</h5>-->
<!--            <p>Cargo: --><?php //= $pessoa->cargo->nome_cargo?><!--</p>-->
<!---->
<!--            <p>Esportes:</p>-->
<!--            <ul>-->
<!--                --><?php //foreach ($pessoa->esportes as $esporte): ?>
<!--                    <li>--><?php //= $esporte->nome_esporte ?><!--</li>-->
<!--                --><?php //endforeach; ?>
<!--            </ul>-->
<!--        </div>-->
<!--    --><?php //endforeach; ?>
<!---->
<!---->
<?php

?>