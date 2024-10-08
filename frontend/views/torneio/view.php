<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\torneio\TorneioModel $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Torneio Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="torneio-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome_torneio',
            ['attribute'=> 'esporteTorneio.nome_esporte' ,'label' => 'Esporte do Torneio',],
            ['attribute'=> 'modalidadeTorneio.tipo_esporte' ,'label' => 'Modalidade do Torneio',],
            ['attribute'=> 'ativo.desc_ativo' ,'label' => 'Inscrições',],

            [
                'attribute' => 'Atletas',
                'value' => function ($model) {
                    $atletas = array_map(function($atleta) {
                        return $atleta->nome; // supondo que o atributo seja 'nome_atleta'
                    }, $model->atletas);

                    return implode(', ', $atletas); // Lista todos os atletas separados por vírgula
                },
            ],

        ],
    ]) ?>

</div>
