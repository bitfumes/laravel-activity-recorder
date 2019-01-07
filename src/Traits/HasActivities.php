<?php

namespace Bitfumes\Activity\Traits;

use Bitfumes\Activity\Models\Activity;

trait HasActivities
{
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}
