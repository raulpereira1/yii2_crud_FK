<?php

/** @var yii\web\View $this */

use app\models\AtletasModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var \frontend\controllers\SiteController $provider*/
/* @var \frontend\controllers\SiteController $pessoas*/
/* @var \frontend\controllers\SiteController $esportes*/




?>
<link rel="stylesheet" href="/css/stylesite.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<div class="site-view-all">
<div id="newsCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="news-item">
                <p></p>
                <p></p>
            </div>
        </div>


    </div>
    <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
    </a>
</div>

<div class="site-content">

    <div class="pessoas-group">
            <div>
                <h2>Equipe Tecnica</h2>
                <?php foreach ($pessoas as $pessoa): ?>

                    <p>
                <?php echo Html::encode($pessoa->nome) ?><br>
                <a href="<?= Url::to(['pessoas/view', 'id' => $pessoa->id])?>">Visualizar</a>
                </p>
                <?php endforeach; ?>
            </div>
    </div>

    <div class="esportes-disponveis">
        <h4>Esportes Disponiveis</h4>
        <ul>
            <?php foreach ($esportes as $esporte):  ?>
            <li>
            <?= Html::encode(($esporte->nome_esporte)) ?><br>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="cadastro-content">
    <div class="new-atleta">
        <p><a href="<?= Url::to(['atletas/create'])?>" >Para cadastrar um novo atleta</a></p>
    </div>

    <div class="new-pessoa">
        <p><a href="<?= Url::to(['pessoas/create'])?>" >Para cadastrar uma nova pessoa</a></p>

    </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'https://newsdata.io/api/1/news',
            method: 'GET',
            data: {
                apikey: 'pub_520848022d444d02504ca0917c45524c8b0b9',
                q: 'sport',
                country: 'br',
                language: 'pt',
                category: 'sports'
            },
            success: function(response) {
                if (response && response.results.length > 0) {
                    var newsHtml = '';
                    var activeClass = 'active';
                    response.results.forEach(function(newsItem, index) {
                        newsHtml += `
                            <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                <p><strong>${newsItem.title}</strong></p>
                                <p>${newsItem.description}</p>
                            </div>
                        `;
                    });
                    $('.carousel-inner').html(newsHtml);
                } else {
                    $('#news-container').html('Nenhuma notícia encontrada.');
                }
            },
            error: function(error) {
                console.error(error);
                $('#news-container').html('Erro ao carregar as notícias.');
            }
        });
    });
</script>


