<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "histories".
 *
 * @property int $id
 * @property string $created_at
 * @property int $user_id
 * @property int $product_id
 *
 * @property UserInfo $user
 * @property Product $product
 * @property $amount
 * @property $categoryName
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'histories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['user_id', 'product_id'], 'required'],
            [['user_id', 'product_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserInfo::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserInfo::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getProductName()
    {
        return $this->product->category->name;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }
}
