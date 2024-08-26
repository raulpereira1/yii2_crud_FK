<?php

/** @var yii\web\View $this */

use app\models\AtletasModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var \frontend\controllers\SiteController $provider*/

$this->registerCssFile(Url::to('@web/css/style.css'));
$this->title = 'Atletas';

?>


<div class="Atleta_box">
    <h2>ATLETAS</h2><br>
   <?php
    $atletas = ArrayHelper::map(AtletasModel::find()->all(),'id', function ($atletas){return $atletas;});
    foreach ($atletas as $atleta){

        echo
                    "<img src='" . Url::to('@web/files/' . $atleta->foto_atleta) . "' alt='Foto de " . Html::encode($atleta->nome) . "' style='max-width: 35px;'>".
        "<label class='Atleta_Split'>".$atleta->nome."-"."</label>"."<br>";}

    ?>
<?php
    \yii\widgets\LinkPager::widget([
        'pagination' => $provider->getPagination(),
])?>
</div>
