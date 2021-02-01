<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m201201_214133_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'amount' => $this->integer()->defaultValue(0),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-products-user-id',
            'products',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-products-category-id',
            'products',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');

        $this->dropForeignKey(
            'fk-products-category-id',
            'products'
        );

        $this->dropForeignKey(
            'fk-products-user-id',
            'products'
        );
    }
}
