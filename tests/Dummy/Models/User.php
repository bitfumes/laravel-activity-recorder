<?php

namespace Bitfumes\Activity\Tests\Dummy\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Bitfumes\Activity\Traits\HasActivities;

class User extends Authenticatable
{
    use HasActivities;
}
