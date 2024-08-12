<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ModalidadeModel;

/** @var yii\web\View $this */
/** @var app\models\EsporteModel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="esporte-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_esporte')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tipo')->dropDownList(ArrayHelper::map(ModalidadeModel::find()->all(),'id','tipo_esporte')) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs("

$(document).ready(function (){
    let type;
    let type2;
     console.log(type);
     console.log(type2);
        $('tipo_esporte').on('change',function (){
            type = $(this).val();
            if (type != 1){
                type2 = tipo_esporte;
                console.log('to funcionando');
        }else{
                type = tipo_esporte;
         }
            console.log(type);
            console.log(type2);

        })

    })
    ")
?>
<script>



</script>