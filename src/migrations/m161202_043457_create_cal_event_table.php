<?php

use yii\db\Migration;

/**
 * Handles the creation for table `cal_event`.
 */
class m161202_043457_create_cal_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cal_event', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            //'reboot' => $this->boolean(),
            'notice_mail' => $this->string(),
            's_date' => $this->date(),
            'e_date' => $this->date(),
            's_time' => $this->time(),
            'e_time' => $this->time(),
            'last_run' => $this->datetime(),
            'status' => $this->integer(),
            'recurrence' => $this->string()
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cal_event');
    }
}
