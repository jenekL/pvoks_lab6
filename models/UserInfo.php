<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $password
 *
 * @property Fridges[] $fridges
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'password'], 'required'],
            [['name', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Fridges]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFridges()
    {
        return $this->hasMany(Fridge::className(), ['user_id' => 'id']);
    }
}
