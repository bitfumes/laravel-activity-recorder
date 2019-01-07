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
}
