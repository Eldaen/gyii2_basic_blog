<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $name
 * @property integer $date
 * @property string $description
 * @property integer $fk_user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $fkUser
 */
class Task extends ActiveRecord
{
    public $events = []; //События, сгруппированные по дням
    public $date_event; //Дата

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]
            ],
//            'date' => [
//                'class' => DateB::className(),
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
//                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
//                ]
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date', 'fk_user_id'], 'required'],
            [['fk_user_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['fk_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserProfile::className(), 'targetAttribute' => ['fk_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date' => 'Date',
            'description' => 'Description',
            'fk_user_id' => 'Fk User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkUser()
    {
        return $this->hasOne(UserProfile::className(), ['id' => 'fk_user_id']);
    }

    public function daysAndEvents($date = null)
    {
        if(!$date)
        {
            $daysInMonth = date('t');

           for ($i = 0; $i <= $daysInMonth; $i++)
           {
               //TODO: date('m'), $i, date('Y') заменить на данные из формы
               $time = mktime(0, 0, 0, date('m'), $i, date('Y')); //Получаем время из даты
               $this->events[$i] = self::findAll(['date' => $time]);
           }
        } else {
            $array = explode('-', $date);
            $daysInMonth = date('t', mktime(0, 0, 0, $array[1], 1, $array[0]));
            for ($i = 0; $i <= $daysInMonth; $i++)
            {
                $time = mktime(0, 0, 0, $array[1], $i, $array[0]);
                //var_dump($time); exit;
                //$time = mktime(0, 0, 0, date('m'), $i, date('Y')); //Получаем время из даты
                $this->events[$i] = self::findAll(['date' => $time]);
                //$this->events[$i] = self::find()->where(['date' => $time])->asArray()->all();
            }
        }


        return $this->events;


    }

    public function beforeSave($insert)
    {
        $array = explode('-', $this->date);
        $this->date = mktime(0, 0, 0, $array[1], $array[2], $array[0]);
        return parent::beforeSave($insert);
    }
}
