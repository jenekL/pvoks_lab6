<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%histories}}`.
 */
class m201201_215156_create_histories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%histories}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime()->defaultExpression("NOW()")->notNull(),
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'amount' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-histories-user-id',
            'histories',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-histories-product-id',
            'histories',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%histories}}');

        $this->dropForeignKey(
            'fk-histories-product-id',
            'histories'
        );

        $this->dropForeignKey(
            'fk-histories-user-id',
            'histories'
        );
    }
}
