<div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-line-chart"></span> {{$poll->title}}</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach ($poll->pollAnswers as $answer)
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="radio"
                                        name="poll_{{$answer->poll_id}}"
                                        data-poll_id="{{$answer->poll_id}}"
                                        value="{{$answer->id}}"> {{ $answer->answer }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="panel-footer text-center">
                <button type="button" class="btn btn-primary btn-block btn-sm submit-poll">
                    Vote</button>
                <a href="#" class="small">View Result</a>
            </div>
        </div>
    </div>