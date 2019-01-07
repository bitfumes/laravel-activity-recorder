<?php

namespace Bitfumes\Activity\Traits;

use Bitfumes\Activity\Models\Activity;

trait RecordActivity
{
    public static function bootRecordActivity()
    {
        foreach (static::getRecordEvents() as $event) {
            static::$event(function ($model) use ($event) {
                if (auth()->check()) {
                    $model->addActivity($event);
                }
            });
        }
    }

    protected static function getRecordEvents()
    {
        return isset(static::$eventsToRecord) ? static::$eventsToRecord : ['created'];
    }

    /**
    * @param $thread
    */
    public function addActivity($event)
    {
        $this->activity()->create([
            'type'     => $this->getActivityType($event),
            'user_id'  => auth()->id(),
        ]);
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'model');
    }

    protected function getActivityType($event)
    {
        return strtolower((new \ReflectionClass($this))->getShortName()) . '_' . $event;
    }
}
