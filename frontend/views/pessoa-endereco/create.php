<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\pessoaendereco\PessoaEndereco $model */

$this->title = 'Create Pessoa Endereco';
$this->params['breadcrumbs'][] = ['label' => 'Pessoa Enderecos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-endereco-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
