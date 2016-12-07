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
            'entity_id' => $this->integer(), //need to ask Charles
            //'reboot' => $this->boolean(),
            'cat_id' => $this->integer(),
            'user_id' => $this->integer()->defaultValue(0),
            'notice_mail' => $this->string(),
            's_date' => $this->date(),
            'e_date' => $this->date(),
            's_time' => $this->time(),
            'e_time' => $this->time(),
            'last_run' => $this->datetime(),
            'status' => $this->integer(),
            'recurrence' => $this->string()
        ]);

        // creates index for column `cat_id`
        $this->createIndex(
            'idx-cal_event-cat_id',
            'cal_event',
            'cat_id'
        );

        // add foreign key for table `cal_category`
        $this->addForeignKey(
            'fk-cal_event-cat_id',
            'cal_event',
            'cat_id',
            'cal_category',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-cal_event-user_id',
            'cal_event',
            'user_id'
        );

        // creates index for column `entity_id`
        $this->createIndex(
            'idx-cal_event-entity_id',
            'cal_event',
            'entity_id'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `cal_category`
        $this->dropForeignKey(
            'fk-cal_event-cat_id',
            'cal_event'
        );

        // drops index for column `cat_id`
        $this->dropIndex(
            'idx-cal_event-cat_id',
            'cal_event'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-cal_event-user_id',
            'cal_event'
        );

        // drops index for column `entity_id`
        $this->dropIndex(
            'idx-cal_event-entity_id',
            'cal_event'
        );
        $this->dropTable('cal_event');
    }
}
