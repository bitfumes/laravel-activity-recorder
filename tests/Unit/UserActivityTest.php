<?php

namespace Bitfumes\Activity\Tests\Unit;

use Bitfumes\Activity\Tests\TestCase;
use Bitfumes\Activity\Tests\Dummy\Models\Item;
use Bitfumes\Activity\Models\Activity;
use Carbon\Carbon;

class UserActivityTest extends TestCase
{
    /** @test */
    public function user_has_many_activities()
    {
        $user                 = $this->authUser();
        Item::$eventsToRecord = ['created', 'deleted'];
        $model                = factory(Item::class)->create();
        $model->delete();
        $this->assertEquals(1, $user->activity->count());
    }

    /** @test */
    public function activity_give_user_feed_in_proper_format()
    {
        $user     = $this->authUser();
        $model    = factory(Item::class, 1)->create();
        $activity = factory(Activity::class)->create(['created_at'=>Carbon::now()->subWeek()]);
        $feeds    = Activity::feed(auth()->user());
        $this->assertTrue($feeds->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));
        $this->assertTrue($feeds->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }
}
