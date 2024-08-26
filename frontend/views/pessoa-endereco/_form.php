<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var app\models\pessoa-endereco\PessoaEndereco $model */
?>

<div class="pessoa-endereco-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cep')->textInput(['id' => 'cep-input']) ?>

    <?= Html::button('Consultar', ['id' => 'consultar-cep-btn', 'class' => 'btn btn-primary']) ?>

    <?= $form->field($model, 'logradouro')->textInput(['maxlength' => true, 'id' => 'logradouro-input', 'disabled' => true]) ?>

    <?= $form->field($model, 'cidade')->textInput(['maxlength' => true, 'id' => 'cidade-input', 'disabled'=>true]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true, 'id' => 'estado-input', 'disabled' => true]) ?>

    <?= $form->field($model, 'numero')->textInput() ?>

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
JS;

$this->registerJs($script);
?>