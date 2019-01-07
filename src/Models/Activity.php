<?php

namespace Bitfumes\Activity\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['type', 'user_id', 'model_type', 'model_id'];

    public function model()
    {
        return $this->morphTo();
    }

    public static function feed($user, $take = 50)
    {
        return static::where('user_id', $user->id)
                    ->latest()
                    ->with('model')
                    ->take($take)
                    ->get()
                    ->groupBy(function ($activity) {
                        return $activity->created_at->format('Y-m-d');
                    });
    }
}
