<?php


?>



<div class="leave_comment">
    <h4>Напиште комментарий:</h4>
    <? use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    if(!Yii::$app->user->isGuest) {
            if(Yii::$app->session->getFlash('comment')) { ?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
    <?      }
        }
        $form = ActiveForm::begin(
            [
                'action' => [
                    '/site/comment',
                    'id' => $article->id
                ],
                'options' => [
                    'class' => 'form-horizontal comment-form',
                    'role' => 'form'
                ]
            ]
        )
    ?>
    <div class="comment-form__wrap">
        <div class="col-md-12">
            <?= $form->field($commentForm, 'comment')->textarea(
                [
                'class'=>'comment-form__text',
                'placeholder'=>'Напишите свой комментарий'
                ]
            )->label(false)?>
        </div>
    </div>
    <button type="submit" class="btn send-btn">Опубликовать комментарий</button>
    <?php \yii\widgets\ActiveForm::end();?>

    <?php if(!empty($comments)) { ?>

    <?php  foreach($comments as $comment) {?>
        <div class="bottom-comment"><!--bottom comment-->
            <div class="comment-text">

                <h4 class="comment-text__header"><?= $comment->getUser()?></h4>

                <p class="comment-text__date">
                    <?= $comment->getDate(); ?>
                </p>


                <p class="para"><?= $comment->text; ?></p>
            </div>
        </div>
    <?php } }?>
</div>

