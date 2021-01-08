<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PollResource;
use App\Poll;
use App\PollAnswer;
use Illuminate\Http\Request;

class PollController extends Controller
{

    /**
     * GetActivePoll
     * 
     * Get All Active Polls
     * 
     * @return void
     */

    /**
     * @OA\Get(
     *     path="/poll/{type}",
     *     tags={"Poll"},
     *     summary="Options in active, answered",
     *     description="User Details",
     *     security={{"passport": {}}},
     *     operationId="active-poll",
     *     @OA\Parameter(
     *          parameter="type",
     *          name="type",
     *          in="path"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(response=201, description="Active Poll listing", @OA\JsonContent(ref="#/components/schemas/response")),
     * )
     */
    public function getActivePolls(string $type = null)
    {
        try {

            switch ($type) {
                case '/' :
                    $pollsResponse = Poll::whereStatus(Poll::ACTIVE)
                        ->paginate(config('poll.common.paginate'));
                break;
                case 'active' :
                    $pollsResponse = Poll::activePolls()
                        ->whereStatus(Poll::ACTIVE)
                        ->paginate(config('poll.common.paginate'));
                    break;
                case 'answered' : 
                    $pollsResponse = Poll::answeredPolls()
                        ->whereStatus(Poll::ACTIVE)
                        ->paginate(config('poll.common.paginate'));
                    break;

                default :
                    $pollsResponse = Poll::whereStatus(Poll::ACTIVE)
                        ->paginate(config('poll.common.paginate'));
                break;
            }
            return PollResource::collection($pollsResponse);

        } catch (\Throwable $e) {
            throw $e;
        }
    }


    /**
     * @OA\Get(
     *     path="/answer-poll/{poll}/{pollAnswer}",
     *     tags={"Poll"},
     *     summary="poll answer api",
     *     description="Poll Answer details",
     *     security={{"passport": {}}},
     *     operationId="answer poll",
     *     @OA\Parameter(
     *          parameter="poll",
     *          name="poll",
     *          description="poll_id",
     *          required=true,
     *          in="path"
     *     ),
     *     @OA\Parameter(
     *          parameter="pollAnswer",
     *          name="pollAnswer",
     *          description="poll_answer_id",
     *          required=true,
     *          in="path"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(response=201, description="Active Poll listing", @OA\JsonContent(ref="#/components/schemas/response")),
     * )
     */
    public function store(Poll $poll, PollAnswer $pollAnswer)
    {
        try {

            $user = \Auth::user();

            $user->poll()->attach($poll->id,[
                    'poll_answer_id' => $pollAnswer->id
                ]
            );

            return response()->json(
                [
                    'status' => true,
                    'code' => 200,
                    'message' => 'Poll Answerd Successfully',
                    'data' => []
                ]
            );

        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function home()
    {
        try {
            $polls = Poll::with('pollAnswers')->whereStatus(1)->get();
            return view('home');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Render poll blade
     * 
     * @param Poll $poll Poll Object
     * 
     * @return view
     */
    public function render(Poll $poll)
    {
        return view('render-polls', compact('poll'));
    }

    public function uiRender()
    {
        return view('ui-render');
    }
}
