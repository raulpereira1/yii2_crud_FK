<?php

/** @var yii\web\View $this */

use app\models\AtletasModel;
use app\models\EsporteModel;
use frontend\controllers\AtletasController;
use frontend\models\Customer;
use yii\helpers\ArrayHelper;
use app\models\ModalidadeModel;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var \frontend\controllers\SiteController $provider*/

$this->registerCssFile(Url::to('@web/css/style.css'));
$this->title = 'Atletas';


// TAREFAS:
// Estudar o render() do php/yii e entender como funciona na view
//quando visualizar os dados do atleta, chamar a view da modalidade/pais e esporte
//salvar foto do atleta e carregar as fotos, estudar como o yii faz para salvar e qual recurso ele utiliza
// criar um banco para os torneios com FK para mostrar os atletas que estão cadastrados no torneio
// para começar vamos fazer o seguinte!
// criar um card ou uma label para visualizar os atletas ( foto, nome )
// criar uma view com os dados completos dos atletas( nome, idade, cidade, esporte, modalidade, vitorias e MVPS, torneios recentes e melhores
// criar uma view para exibir os torneios que estão acontecendo em tempo real
// criar uma view que vai exibir os atletas registrados nos esportes exibidos
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
<?php \yii\widgets\LinkPager::widget([
        'pagination' => $provider->getPagination(),
])?>
</div>
<div>
    <h2>competições</h2>
    <card>
        <label>competições que vão começar</label><br>
        <label>competições iniciadas</label><br>
        <label>competições recem finalizadas
        <h5>vencedor</h5></label><br>

<img src="<?= Url::to("@web/files/".$atleta->foto_atleta)?>" alt="foto_atleta" style="max-width: 200px">

    </card>
</div>