<?php

use app\models\EsporteModel;
use yii\helpers\Html;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;






use app\models\pais\PaisModel;
use app\models\ModalidadeModel;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\AtletasModel $model */
/** @var yii\widgets\ActiveForm $form */
/* @var \frontend\controllers\AtletasController $esporteTipo1 array */
/* @var \frontend\controllers\AtletasController $esporteTipo2 array */


?>

<div class="atletas-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true])?>




    <?=  $form->field($model, 'id_modalidade')->dropDownList
    (ArrayHelper::map(ModalidadeModel::find()->all(),'id','tipo_esporte'),
                                       ['prompt'=>'Selecione um Modalidade','id'=>'modalidade-dropdown']
    )?>


<div id="esporte-field" >

    <?=  $form->field($model, 'id_esporte')->dropDownList
    (ArrayHelper::map(EsporteModel::find()->all(), 'id', 'nome_esporte'),

                                    ['prompt'=>'Selecione um Esporte','id'=>'esporte-dropdown'])?>


</div>


    <?= $form->field($model, 'id_pais')->dropDownList
    (ArrayHelper::map(PaisModel::find()->all(),'id','nome_pais'),
                                ['prompt'=>'Selecione um Pais','id'=>'id_pais']
    )?>

    <?= $form->field($model,'foto_atleta')->fileInput()?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
// Converter as variáveis PHP para JSON
$esportesTipo1 = json_encode(ArrayHelper::map($esporteTipo1,'id','nome_esporte'),true);
$esportesTipo2 = json_encode(ArrayHelper::map($esporteTipo2,'id','nome_esporte'),true);

$script = <<< JS
    var esporteTipo1 = $esportesTipo1;
    var esporteTipo2 = $esportesTipo2;

    $('#modalidade-dropdown').change(function() {
        var modalidadeId = $(this).val();
        var esportes = modalidadeId == 1 ? esporteTipo1 : esporteTipo2;

        $('#esporte-dropdown').empty();
        $.each(esportes, function(id, nome) {
            $('#esporte-dropdown').append(new Option(nome, id));
        });
    });
JS;
$this->registerJs($script);
?>