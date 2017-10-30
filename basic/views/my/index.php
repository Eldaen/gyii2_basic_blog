<?php
/** @var array $tasks */

use app\components\CalendarWidget;
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
        </div>
    </div>
</div>
<?php //ActiveForm::end(); ?>

    <?= CalendarWidget::widget(
            [
                    'tableClasses' => 'table table-bordered'
            ]
    ) ?>

<!--<script>
    window.onload = function () {
         var table = document.body.querySelector('.tasks-table');
         var searchForm = document.getElementById('search-form');
         var calendar = new Calendar(table, searchForm);
    }

</script>-->
<script src="../js/Container.js"></script>
<script src="../js/CalendarDay.js"></script>
<script src="../js/CalendarRow.js"></script>
<script src="../js/Calendar.js"></script>

<? /* $this->registerAssetBundle(yii\web\JqueryAsset::className(), View::EVENT_AFTER_RENDER); */ ?>

<!-- Так и не смог заставить код ниже работать, подскажите пожалуйста что тут не так
<? /* $this->registerJsFile('@web/js/SingleTask.js', View::EVENT_AFTER_RENDER) */ ?><!--
--><? /* $this->registerJsFile('@web/jsTasks.js', View::EVENT_AFTER_RENDER) */ ?>
