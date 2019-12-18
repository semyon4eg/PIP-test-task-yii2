<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%category}}`.
 */
class m190909_145259_add_slug_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category}}', 'slug', $this->string(255)->notNull()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%category}}', 'slug');
    }
}
