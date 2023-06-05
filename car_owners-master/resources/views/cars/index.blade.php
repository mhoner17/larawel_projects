@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Cars')}}</div>

                    <div class="card-body">
                        @can('create')
                        <a class="btn btn-info" href="{{route("cars.create")}}">{{__('Add new car')}}</a>
                        @endcan
                        @can('search')
                        <hr/>
                        <form method="POST" action="{{route("cars.search")}}">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" name="name"
                                       placeholder="{{__('Find car (by registration number, brand or model)')}}" value="{{$searchCarName}}">
                            </div>
                            <button class="btn btn-success">{{__('Find')}}</button>
                        </form>
                        <hr/>
                        @endcan
                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{{__('Model')}}</th>
                                <th>{{__('Owner')}}</th>
                                <th>{{__('Reg. number')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $car)
                                @can('view_specific_cars', $car)
                                <tr>
                                    <td>
                                        @if ($car->image!=null)
                                        <img src="{{ asset("/storage/cars/".$car->image) }}" width="100">
                                        @endif
                                    </td>
                                    <td>{{$car->brand}} {{$car->model}}</td>
                                    <td>{{$car->owner->name}} {{$car->owner->surname}}</td>
                                    <td>{{$car->reg_number}}</td>

                                    <td style="width: 100px;">
                                        @can('update_car', $car)
                                        <a class="btn btn-outline-dark" href="{{ route("cars.edit",$car->id) }}">{{__('Edit')}}</a>
                                        @endcan
                                    </td>
                                    <td style="width: 100px;">
                                        @can('delete_car', $car)
                                        <form method="post" action="{{route('cars.destroy',$car->id)}}">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-danger">{{__('Destroy')}}</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endcan
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



