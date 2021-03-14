@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>{{__('Tasks of yours')}}</h4>
        @if (sizeof($list))
            <table class="table">
                <thead>
                <tr>
                    <th>{{__('Title')}}</th>
                    <th>{{__('Time spent')}}</th>
                    <th>{{__('Date')}}</th>
                    <th>{{__('Comment')}}</th>
                    <th>{{__('Delete')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->time_spent }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->comment }}</td>
                    <td>
                        <form method="POST" action="{{ route('task.destroy', [$item]) }}" class="d-inline-block">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-sm">{{__('Delete')}}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        @else
            {{_('Nothing found.')}}
        @endif
        {{$list->links("pagination::bootstrap-4")}}

        <h4>{{__('Export tasks')}}</h4>
        {!! form($exportForm) !!}
    </div>
@endsection