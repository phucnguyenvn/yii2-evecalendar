<?php

use yii\db\Migration;

/**
 * Handles the creation for table `cal_category`.
 */
class m161202_043430_create_cal_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cal_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'color' => $this->string(),
            'bg_color' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cal_category');
    }
}
