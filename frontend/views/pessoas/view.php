<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\pessoas\PessoasModel $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pessoas Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pessoas-model-view">

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
            'id',
            [
                'attribute' => 'foto_pessoa',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img(Yii::getAlias('@web') . '/files/' . $model->foto_pessoa, [
                        'width' => '100px'
                    ]);
                },
            ],
            'nome',
            [
                'label' => 'Idade',
                'value' => function ($model) {
                    return $model->getIdade() . ' anos';
                }
            ],
            'data_nascimento',
            [ // o codigo abaixo faz o seguinte:  diz que o atributo é id_cargo, o valor é uma função que retorna o $model->cargo,
                // para isso acontecer tem que haver relacionamento entre o model pessoas e a tabela cargo,
                // caso exista ele vai buscar dentro de cargo o nome_cargo e retornar, se não existir ele imprime "sem cargo".
                // e para os outros codigos abaixo funciona da mesma forma.
                'attribute' => 'id_cargo',
                'value' => function ($model) {
                    return $model->cargo ? $model->cargo->nome_cargo : 'Sem cargo';
                },
            ],
            [ // aqui ele vai buscar o relacionamento na tabela esporte e vai fazer um map  para puxar todos os esportes,
                // já que uma pessoa pode ter mais de um esporte associado a ela. feito isso ele vai retornar os esportes separados por uma  virgula.
                // o implode é uma função do php que junta elementos de um array em uma string.
                'attribute' => 'esportes',
                'value' => function ($model) {
                    $esportes = array_map(function($esporte) {
                        return $esporte->nome_esporte;
                    }, $model->esportes);
                    return implode(', ', $esportes);
                },
            ],
            [
                'attribute' => 'cep',
                'value' => function ($model) {
                    return $model->pessoaEndereco ? $model->pessoaEndereco->cep : 'Sem CEP';
                },
            ],
            [
                'attribute' => 'logradouro',
                'value' => function ($model) {
                    return $model->pessoaEndereco ? $model->pessoaEndereco->logradouro : 'Sem logradouro';
                },
            ],
            [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return $model->pessoaEndereco ? $model->pessoaEndereco->estado : 'Sem estado';
                },
            ],
            [
                'attribute' => 'cidade',
                'value' => function ($model) {
                    return $model->pessoaEndereco ? $model->pessoaEndereco->cidade : 'Sem cidade';
                },
            ],
            [
                'attribute' => 'numero',
                'value' => function ($model) {
                    return $model->pessoaEndereco ? $model->pessoaEndereco->numero : 'Sem número';
                },
            ],
        ],
    ]) ?>


</div>
