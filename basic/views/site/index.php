<?php

/* @var $this yii\web\View */

use yii\helpers\StringHelper;

$this->title = 'Learning yii2, GU-web';
?>
<div class="col-md-12 main-page">
    <h1 class="main-page__header">Записи из блогов наших пользователей</h1>
    <div class="row">
        <div class="col-md-9 article-container">

            <? foreach ($articles as $model) {?>

            <div class="article">
                <h2 class="article__header"><?=$model->title ?></h2>
                <p class="article__preview"><?=$model->preview ?>
                    <a href="<?='/site/article/?id=' . $model->id?>" class="article__read-more btn btn-info">Читать дальше</a></p>
            </div>

            <? } ?>
        </div>

        <div class="col-md-3 widget-container">
            <?=$this->render('/partials/popular',
                [
                    'popular' => $popular
                ])
            ?>
            <?=$this->render('/partials/recent',
                [
                    'recent' => $recent
                ])
            ?>
        </div>

    </div>
</div>
