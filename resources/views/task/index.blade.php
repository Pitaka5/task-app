@extends('layouts.app')

@section('content')
    <div class="container">
        {!! form($exportForm) !!}
        <table class="table">
            <thead>
            <tr>
                <th>{{__('Title')}}</th>
                <th>{{__('Time spent')}}</th>
                <th>{{__('Date')}}</th>
                <th>{{__('Comment')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $item)
            <tr>
                <td>{{$item->title}}</td>
                <td>{{$item->time_spent}}</td>
                <td>{{$item->date}}</td>
                <td>{{$item->comment}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{$list->links("pagination::bootstrap-4")}}
    </div>
@endsection