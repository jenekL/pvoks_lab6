<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m201201_211012_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->insert('categories', [
            'name' => 'Выпечка',
        ]);
        $this->insert('categories', [
            'name' => 'Гарниры',
        ]);
        $this->insert('categories', [
            'name' => 'Горячее',
        ]);
        $this->insert('categories', [
            'name' => 'Десерты',
        ]);
        $this->insert('categories', [
            'name' => 'Детское меню',
        ]);
        $this->insert('categories', [
            'name' => 'Завтрак',
        ]);
        $this->insert('categories', [
            'name' => 'Закуски',
        ]);
        $this->insert('categories', [
            'name' => 'Мясное',
        ]);
        $this->insert('categories', [
            'name' => 'Овощное',
        ]);
        $this->insert('categories', [
            'name' => 'Рыбное',
        ]);
        $this->insert('categories', [
            'name' => 'Салаты',
        ]);
        $this->insert('categories', [
            'name' => 'Супы',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}
