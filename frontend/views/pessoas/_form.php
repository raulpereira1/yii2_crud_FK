<?php

use app\models\EsporteModel;
use app\models\pessoas\Cargo;
use app\models\pessoas\PessoaEsporte;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\pessoas\PessoasModel $model */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\pessoaendereco\PessoaEndereco $modelEndereco */
?>

<div class="pessoas-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_nascimento')->input('date', ['id' => 'data_nascimento']) ?>


    <?= $form->field($model, 'id_cargo')->dropDownList(ArrayHelper::map(Cargo::find()->all(),'id','nome_cargo'))?>
    <div class="esporte_check">
    <?= $form->field($model, 'esportes')->checkboxList(
        ArrayHelper::map(EsporteModel::find()->all(), 'id', 'nome_esporte')
    ) ?>
    <br>

    <?= $form->field($model,'foto_pessoa')->fileInput()?>
        <br>
</div>



    <div class="pessoa-endereco-form">



        <?= $form->field($modelEndereco, 'cep')->textInput(['id' => 'cep-input']) ?><br>

        <?= Html::button('Consultar', ['id' => 'consultar-cep-btn', 'class' => 'btn btn-primary']) ?>

        <p> <a href="https://buscacepinter.correios.com.br/app/endereco/index.php">Não sei meu CEP</a>.</p>

        <?= $form->field($modelEndereco, 'logradouro')->textInput(['maxlength' => true, 'id' => 'logradouro-input']) ?>

        <?= $form->field($modelEndereco, 'cidade')->textInput(['maxlength' => true, 'id' => 'cidade-input']) ?>

        <?= $form->field($modelEndereco, 'estado')->textInput(['maxlength' => true, 'id' => 'estado-input']) ?>


        <?= $form->field($modelEndereco, 'numero')->textInput() ?><br>
        <?= Html::button('Consultar Endereco', ['id' => 'consultar-endereco-btn', 'class' => 'btn btn-primary']) ?>
        <br>

        <div class="form-group">
            <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <?php
    $script = <<< JS
    $('#consultar-cep-btn').on('click', function() {
    var cep = $('#cep-input').val();
    var url = 'https://viacep.com.br/ws/'+cep +'/json/';
    $.ajax({
        url: url,
        method: 'GET',
        data: { cep: cep },
        success: function(data) {
            if (!data.erro) {
                $('#logradouro-input').val(data.logradouro);
                $('#cidade-input').val(data.localidade);
                $('#estado-input').val(data.uf);
            } else {
                alert('CEP não encontrado.');
            }
        },
        error: function() {
            alert('Erro ao consultar o CEP.');
        }
    });
    });

    // Lógica para consultar o endereço completo
    $('#consultar-endereco-btn').on('click', function() {
        var logradouro = $('#logradouro-input').val();
        var cidade = $('#cidade-input').val();
        var estado = $('#estado-input').val();

        if (logradouro && cidade && estado) {
            var url = 'https://viacep.com.br/ws/'+estado+'/'+cidade+'/'+logradouro+'/json/';

            $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                if (data.length > 0) {
                    $('#cep-input').val(data[0].cep); // Pega o primeiro resultado e coloca o CEP no campo
                } else {
                    alert('Endereço não encontrado.');
                }
            },
            error: function() {
                alert('Erro ao consultar o endereço.');
            }
        });
    } else {
            alert('Por favor, preencha logradouro, cidade e estado antes de consultar.');
        }
    });
    JS;

    $this->registerJs($script);
    $this->registerJs($script);
    ?>

</div>
