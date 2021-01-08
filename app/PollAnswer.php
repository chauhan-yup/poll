<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{

    // protected $fillable = [
    //     'pole_id',
    //     'answer'
    // ];
    protected $guarded = ['id'];
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
