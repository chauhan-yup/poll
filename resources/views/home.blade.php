@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Active polls
                                </div>
                                <div class="card-body">
                                    <div class="active-polls">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Answered polls
                                </div>
                                <div class="card-body">
                                    <div class="answered-polls">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="active_poll" id="active_poll" value="{{route('api.poll.load', 'active')}}">
<input type="hidden" name="answered_poll" id="answered_poll" value="{{route('api.poll.load', 'answered')}}">

@endsection

@push('scripts')
    <script src="{{asset('js/common.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endpush

