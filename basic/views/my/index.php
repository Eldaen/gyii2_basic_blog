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
            <?= $form->field($date, 'sort_date')->input('month', ['value' => $current, 'id' => 'search-form']) ?>
            <?= Html::submitButton('Filter', ['class' => 'btn btn-primary col-md-3']) ?>
        </div>
    </div>
</div>
<?php //ActiveForm::end(); ?>
<table class="table table-bordered tasks-table">
    <tbody>
        <tr>
            <td class="tasks-table__day"><span class="tasks-table__date">1 Окт.</span></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
        </tr>
        <tr>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
        </tr>
        <tr>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
        </tr>
        <tr>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
        </tr>
        <tr>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
        </tr>
        <tr>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
            <td class="tasks-table__day"></td>
        </tr>
    </tbody>
</table>
<script>
    window.onload = function () {
        var table = document.body.querySelector('.tasks-table>tbody');
         var searchForm = document.getElementById('search-form');
         var tasks = new Tasks(table, searchForm);
         tasks.render();
         searchForm.onchange = function() {
         tasks.render();
         };
    }

</script>
<script src="../js/SingleTask.js"></script>
<script src="../js/Tasks.js"></script>

<? /* $this->registerAssetBundle(yii\web\JqueryAsset::className(), View::EVENT_AFTER_RENDER); */ ?>

<!-- Так и не смог заставить код ниже работать, подскажите пожалуйста что тут не так
<? /* $this->registerJsFile('@web/js/SingleTask.js', View::EVENT_AFTER_RENDER) */ ?><!--
--><? /* $this->registerJsFile('@web/jsTasks.js', View::EVENT_AFTER_RENDER) */ ?>
