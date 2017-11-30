@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Notificaciones</h1>

        <div class="row">
            <div class="col-md-6">
                <h2>No leídas</h2>
                    <ul class="list-group">
                        @foreach($unreadNotifications as $unreadNotification)
                            <li class="list-group-item">
                                <a href="{{ $unreadNotification->data['link'] }}">
                                    {{ $unreadNotification->data['text'] }}
                                </a>
                                <form method="POST" action="{{ route('notifications.read', $unreadNotification->id)}}" class ="pull-right">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger btn-xs">x</button>
                                
                                </form>
                            </li>
                        @endforeach
                    </ul>
            </div>
            <div class="col-md-6">
                <h2>Leídas</h2>
                    <ul class="list-group">
                        @foreach($readNotifications as $readNotification)
                            <li class="list-group-item">
                                <a href="{{ $readNotification->data['link'] }}">
                                    {{ $readNotification->data['text'] }}
                                </a>
                                <form  class ="pull-right" method="POST" action="{{ route('notifications.destroy', $readNotification->id)}}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger btn-xs">x</button>
                                
                                </form>
                            </li>
                        @endforeach
                    </ul>
            </div>
        </div>
    
    </div>

@stop   