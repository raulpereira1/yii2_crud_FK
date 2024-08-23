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
<div>
    <?php
    $atleta1 = ArrayHelper::map(\app\models\pessoas\PessoaEsporte::find()->with('esporte')->asArray()->all(),'id_esporte','id_esporte');
    $atleta2 = ArrayHelper::map(\app\models\pessoas\PessoaEsporte::find()->with('pessoa')->asArray()->all(),'id_pessoa','nome');

    echo '<pre>';
    print_r($atleta1);
    print_r($atleta2);
    ?>
    <form action="PessoaEsporteController.php" method="post">
        <B>Escolha os numeros de sua preferência:</B><br>
        <input type=checkbox name="id_esporte[]" value=1> 1<br>
        <input type=checkbox name="numeros[]" value=100> 100<br>
        <input type=checkbox name="numeros[]" value=1000> 1000<br>
        <input type=checkbox name="numeros[]" value=10000> 10000<br>
        <input type=checkbox name="numeros[]" value=90> 90<br>
        <input type=checkbox name="numeros[]" value=50> 50<br>
        <input type=checkbox name="numeros[]" value=30> 30<br>
        <input type=checkbox name="numeros[]" value=15> 15<br><BR>
        <input type=checkbox name="news" value=1> <B>Receber
            Newsletter?</B><br><BR>
        <input type=submit>
    </form>
</div>