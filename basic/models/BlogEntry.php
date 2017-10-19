<?php

namespace app\models;

use Yii;
use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "blogentry".
 *
 * @property integer $id
 * @property string $title
 * @property resource $body
 * @property integer $user_id
 */
class BlogEntry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blogentry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','preview'], 'filter' ,'filter'=> function ($value) {
                return Html::encode($value);
            }],
            [['body'], 'string'],
            [['user_id', 'viewed'], 'integer'],
            [['preview'], 'string', 'max' => 200],
            [['title'], 'string', 'max' => 255],
            [['date'], 'date', 'format' => 'Y-m-d H:m:s']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер статьи',
            'title' => 'Заголовок',
            'body' => 'Текст статьи',
            'user_id' => 'Автор',
        ];
    }

    public static function getRecent()
    {
        return static::find()->orderBy(['date' => SORT_DESC])->limit(3)->all();
    }

    public static function getPopular()
    {
        return static::find()->orderBy(['viewed' => SORT_DESC])->limit(3)->all();
    }

    public function increaseViewCount()
    {
        $this->viewed =+ 1;
        return $this->save(false);
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }
    public function getArticleComments()
    {
        return $this->getComments()->where(['status' => 1])->all();
    }
    public function getArticleCommentsCount()
    {
        return $this->getComments()->where(['status' => 1])->count();
    }

    public function getUser()
    {
        return $this->hasOne(UserProfile::className(), ['id' => 'user_id']);
    }
}
