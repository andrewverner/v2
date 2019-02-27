<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 22.02.2019
 * Time: 20:14
 */

namespace app\components;

use app\models\Log;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

class LogBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    public function afterInsert($event)
    {
        if (!$event->sender instanceof ActiveRecord) {
            return;
        }

        $log = new Log();
        $log->entity = get_class($event->sender);
        $log->event_type = 'insert';
        $log->user_id = \Yii::$app->user->id;
        $log->new_attributes = json_encode($event->sender->attributes);
        $log->save();
    }

    public function beforeUpdate(Event $event)
    {
        if (!$event->sender instanceof ActiveRecord) {
            return;
        }

        $oldData = array_diff_assoc($event->sender->oldAttributes, $event->sender->attributes);
        $newData = array_diff_assoc($event->sender->attributes, $event->sender->oldAttributes);

        if (!$oldData || !$newData) {
            return;
        }

        if (!$event->sender->validate()) {
            return;
        }

        $log = new Log();
        $log->entity = get_class($event->sender);
        $log->event_type = 'update';
        $log->user_id = \Yii::$app->user->id;
        $log->old_attributes = json_encode($oldData);
        $log->new_attributes = json_encode($newData);
        $log->save();
    }

    public function afterDelete($event)
    {
        if (!$event->sender instanceof ActiveRecord) {
            return;
        }

        $log = new Log();
        $log->entity = get_class($event->sender);
        $log->event_type = 'delete';
        $log->user_id = \Yii::$app->user->id;
        $log->old_attributes = json_encode($event->sender->attributes);
        $log->save();
    }
}