<?php
/**
 * @var \app\models\BlogEntry $article
 */
use yii\helpers\Html; ?>

<div class="row">
    <div class="col-md-9 main-page">
        <h1 class="main-page__header"><?= Html::encode($article->title) ?></h1>

        <div class="article-container"><?= $article->body ?></div>
        <?= $this->render('/partials/comments',
            [
                'article' => $article,
                'commentForm' => $commentForm
            ]) ?>
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

