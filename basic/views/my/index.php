<?php
/** @var array $tasks */
use yii\helpers\Html;
use yii\helpers\Url;

?>

<table class="table table-bordered">
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
