<?php

use yii\db\Migration;

/**
 * Handles the creation for table `cal_user`.
 */
class m161202_043450_create_cal_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cal_user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'email' => $this->string(),
            'status' => $this->boolean()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cal_user');
    }
}
