@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Create Poll') }}
                    <div class="card-tool">
                    </div>
                </div>

                <div class="card-body">
                    <div class="content">
                        <form method="post" action="{{route('admin.poll-store')}}">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationServer03">Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" placeholder="Enter title here" >
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationServer04">Description</label>
                                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}" placeholder="Enter description" >
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer03">Option1</label>
                                    <input type="text" name="option[]" class="form-control" value="{{old('title')}}" placeholder="Enter option 1">
                                    

                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer04">Option2</label>
                                    <input type="text" name="option[]" class="form-control" id="validationServer04" placeholder="Enter option 2">
                                    
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer04">Option3</label>
                                    <input type="text" name="option[]" class="form-control" id="validationServer04" placeholder="Enter option 3">
                                    
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer04">Option4</label>
                                    <input type="text" name="option[]" class="form-control" id="validationServer04" placeholder="Enter option 4">
                                    
                                </div>
                                @if($errors->has('option'))
                                <div class="col-md-12 red">
                                    {{ $errors->get('option')[0] }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="invalidCheck">
                                    <label class="form-check-label" for="invalidCheck">
                                        Is active?
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit poll</button>
                            <a href="{{ route('admin.poll-index') }}" class="btn btn-default">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection