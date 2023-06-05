@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit car') }}</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('cars.update', $car->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method("put")
                            @if ($car->image!=null)
                                    <img src="{{ asset("/storage/cars/".$car->image) }}" width="200">
                                @endif
                            <div class="mb-3">
                                <label class="form-label">{{__('Reg. number')}}</label>
                                <input class="form-control" type="text" name="reg_number" value="{{$car->reg_number}}"/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__('Brand')}}</label>
                                <input class="form-control" type="text" name="brand" value="{{$car->brand}}"/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__('Model')}}</label>
                                <input class="form-control" type="text" name="model" value="{{$car->model}}"/>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label" >Image</label>
                                <input  class="form-control" type="file" name="image">
                                <a class="btn btn-danger" href={{route('cars.removeImage', $car->id)}}>Remove image</a>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__('Owner')}}</label>
                                <select class="form-select" name="owner_id">
                                    @foreach($owners as $owner)
                                        <option @if($car->owner_id == $owner->id) selected @endif value="{{$owner->id}}">{{$owner->name}} {{$owner->surname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success">{{__('Update')}}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

