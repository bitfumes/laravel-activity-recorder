<?php

namespace Bitfumes\Activity\Tests\Dummy\Models;

use Illuminate\Database\Eloquent\Model;
use Bitfumes\Activity\Traits\RecordActivity;

class Item extends Model
{
    use RecordActivity;

    public static $eventsToRecord = ['created'];
}
