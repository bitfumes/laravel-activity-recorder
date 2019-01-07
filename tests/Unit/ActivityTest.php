<?php

namespace Bitfumes\Activity\Tests\Unit;

use Bitfumes\Activity\Tests\TestCase;
use Bitfumes\Activity\Tests\Dummy\Models\Item;
use Bitfumes\Activity\Models\Activity;

class ActivityTest extends TestCase
{
    /** @test */
    public function it_can_record_any_activity_on_model()
    {
        $this->authUser();
        $model = factory(Item::class)->create();
        $this->assertDatabaseHas('items', ['id'=>$model->id]);
        $this->assertDatabaseHas('activities', [
            'type'       => 'item_created',
            'model_id'   => $model->id,
            'model_type' => get_class($model)
        ]);
    }

    /** @test */
    public function activity_can_give_model_relationship()
    {
        $this->authUser();
        $model    = factory(Item::class)->create();
        $activity = Activity::first();
        $this->assertEquals($model->id, $activity->model->id);
    }

    /** @test */
    public function activity_can_be_recorded_if_static_event_variable_is_given()
    {
        $this->authUser();
        // using public variable for testing only, in real project you need to use private or protected
        Item::$eventsToRecord = ['created', 'deleted'];
        $model                = factory(Item::class)->create();
        $this->assertDatabaseHas('activities', ['model_id'=>$model->id, 'type'=>'item_created']);
        $model->delete();
        $this->assertDatabaseHas('activities', ['model_id'=>$model->id, 'type'=>'item_deleted']);
    }
}
