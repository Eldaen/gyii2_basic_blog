<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BlogEntry */

$this->title = 'Create Blog Entry';
$this->params['breadcrumbs'][] = ['label' => 'Blog Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-entry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>
