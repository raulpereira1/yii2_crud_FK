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
?>

<div class="pessoas-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'data_nascimento')->input('date', ['id' => 'data_nascimento']) ?>

    <?= $form->field($model, 'id_cargo')->radioList(ArrayHelper::map(Cargo::find()->all(),'id','nome_cargo'))?>
<?php $form->field($model, 'esportes') ?>
    <div class="esporte_check">
    <?= $form->field($model, 'esportes')->checkboxList(
        ArrayHelper::map(EsporteModel::find()->all(), 'id', 'nome_esporte')
    ) ?>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
