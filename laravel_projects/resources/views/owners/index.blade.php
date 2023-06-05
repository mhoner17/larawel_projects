@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__("Owners")}}</div>
                    <div class="card-body">
                        @can('create')
                        <a class="btn btn-info" href="{{route("owners.create")}}">{{__('Add new owner')}}</a>
                        @endcan
                        {{-- [[name]]
                        <hr/> --}}
                        {{-- {{__("auth.message")}} --}}
                        @can('search')
                        <hr/>

                        <form method="post" action="{{route("owners.search")}}">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" name="name"
                                placeholder="{{__('Find owner (by name or surname)')}}" value="{{$searchOwnerName}}">
                            </div>
                            <button class="btn btn-success">{{__('Find')}}</button>
                        </form>
                        <hr/>
                        @endcan
                        <table class="table">
                            <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>{{__('Name')}}</th>
                                <th>{{__('Surname')}}</th>
                                <th>{{__('Cars owned')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($owners as $own)
                                @can('view_specific_owners', $own)

                                <tr>
                                    {{-- <td>{{$own->id}}</td> --}}
                                    <td>{{$own->name}}</td>
                                    <td>{{$own->surname}}</td>
                                    <td>
                                        @foreach($own->cars as $car)
                                        {{$car->brand}} {{$car->model}}
                                        @endforeach
                                    </td>
                                    <td style="width: 100px;">
                                        @can('update', $own)
                                        <a class="btn btn-outline-dark" href="{{ route("owners.edit",$own->id) }}">{{__('Edit')}}</a>
                                        @endcan
                                    </td>
                                    <td style="width: 100px;">
                                        @can('delete', $own)
                                        <form method="post" action="{{route('owners.destroy',$own->id)}}">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-danger">{{__('KILL')}}</button>
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



