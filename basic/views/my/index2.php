<?php
/** @var array $tasks */
use yii\base\Request;
use yii\base\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(
    [
        'action' =>
        [
            'my/index2'
        ]
    ]
); ?>
<div class="col-md-12">
    <div class="row tasks-filter">
        <div class="date col-md-5">
            <?= $form->field($date, 'sort_date')->input('month', ['value' => $tasks['current_month']]) ?>
        <?= Html::submitButton('Filter', ['class' => 'btn btn-primary col-md-3']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<table class="table table-bordered tasks-table">
    <tr>
        <td>Дата</td>
        <td>Событие</td>
        <td>Всего событий</td>
    </tr>
    <?php foreach ($tasks as $day => $events): ?>
    <tr>
        <td class="td-date"><span class="label label-success"><?= $day; ?></span></td>
        <td>
            <?= (count($events) > 0) ?
                '<p>' . $events[0]->name . '</p><p class="small">'.
                $events[0]->description .'</p>' : '-'; ?>
        </td>
        <td class="td-event"><?= (count($events) > 0) ? Html::a(count($events),
                Url::to(['my/events', 'date' => $events[0]->date])) : '-'; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<script>
    window.onload = function() {
        var table = document.body.querySelector('.tasks-table');
        var tasks = new Tasks(table);
        tasks.render();
    }

</script>
<script src="../js/TaskDisplayer.js"></script>
<script src="../js/Tasks.js"></script>

<? $this->registerAssetBundle(yii\web\JqueryAsset::className(), View::EVENT_AFTER_RENDER); ?>

<!-- Так и не смог заставить код ниже работать, подскажите пожалуйста что тут не так
<?/* $this->registerJsFile('@web/js/TaskDisplayer.js', View::EVENT_AFTER_RENDER) */?><!--
--><?/* $this->registerJsFile('@web/jsTasks.js', View::EVENT_AFTER_RENDER) */?>
