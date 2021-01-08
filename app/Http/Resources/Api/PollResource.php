<?php

namespace App\Http\Resources\Api;

use App\Poll;
use Illuminate\Http\Resources\Json\JsonResource;

class PollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => Poll::STATUS[$this->status],
            'pollAnswers' => PollAnswerResource::collection($this->pollAnswers),
        ];
    }
}
