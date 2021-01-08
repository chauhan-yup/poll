<?php

namespace App\Http\Controllers\Admin;

use App\Poll;
use App\PollAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePollRequest;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::with('pollAnswers')
            ->paginate(config('poll.common.paginate'));
        return view('admin.poll.index', compact('polls'));
    }

    public function create()
    {
        return view('admin.poll.create');
    }

    public function store(CreatePollRequest $request)
    {
        try {
            if (is_null($request->status)) {
                $request->merge(
                    [
                        'status' => 0
                    ]
                );
            }
            $poll = Poll::create($request->only('title', 'description', 'status'));
            if (count(array_filter($request->option)) > 0) {
                foreach(array_filter($request->option) as $option) {
                    PollAnswer::create(
                        [
                            'poll_id' => $poll->id,
                            'answer' => $option
                        ]
                    );
                }
            }
            return redirect()->route('admin.poll-index')->with('success', 'Poll created successfully');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function edit(Poll $poll)
    {
        return view('admin.poll.edit', compact('poll'));
    }

    public function update(CreatePollRequest $request, Poll $poll)
    {
        try {
            if (is_null($request->status)) {
                $request->merge(
                    [
                        'status' => 0
                    ]
                );
            }
            // Poll::update($request->only('title', 'description', 'status'), $poll);

            $poll->title = $request->title;
            $poll->description = $request->description;
            $poll->status = $request->status;
            $poll->save();

            PollAnswer::where('poll_id', $poll->id)->delete();

            if (count(array_filter($request->option)) > 0) {
                foreach(array_filter($request->option) as $option) {
                    PollAnswer::create(
                        [
                            'poll_id' => $poll->id,
                            'answer' => $option
                        ]
                    );
                }
            }
            return redirect()->route('admin.poll-index')->with('success', 'Poll updated successfully');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
