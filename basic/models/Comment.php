<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $text
 * @property integer $article_id
 * @property string $date
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'article_id' => 'Article ID',
            'date' => 'Date',
        ];
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDatetime($this->date);
    }

    public function getUser()
    {
        return UserProfile::getUserName($this->user_id);
    }
}
