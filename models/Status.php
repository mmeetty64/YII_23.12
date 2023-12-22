<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $title
 *
 * @property Request[] $requests
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['status_id' => 'id']);
    }

    public static function getStatus(){
        return (new Query())
        ->select('title')
        ->from('status')
        ->indexBy('id')
        ->column();
    }
    public static function getStatusId($title){
        return self::findOne(['title' => $title])->id;
    }
}
