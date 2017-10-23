<?php
use \yii\helpers\Html;
?>
<div>
    <h1>События календаря на <?= Html::encode($date); ?></h1>
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_events',
    ]); ?>
</div>
