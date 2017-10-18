<div class="widget widget--fresh">
    <h2 class="widget__header">Новые статьи</h2>
    <? use yii\helpers\StringHelper;

    foreach ($recent as $article) { ?>
    <article class="widget__article"><a href="<?='/site/article/?id=' . $article->id?>" class="widget__article-header"><?= StringHelper::truncate($article->title,100,'...')?></a>
        <p class="widget__article-data">
            <span class="widget__article-date"><?=$article->date?> </span>
            <a  class="widget__article-author">Анонимус</a>
        </p>
    </article>
    <? } ?>
</div>