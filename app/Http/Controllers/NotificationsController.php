<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(){

        if(request()->ajax()){

            return auth()->user()->unreadNotifications;
        }

        return view('notifications.index',[
            'unreadNotifications' => auth()->user()->unreadNotifications,
            'readNotifications' => auth()->user()->readNotifications,

        ]);

    }

    public function read($id){

        DatabaseNotification::find($id)->markAsRead();

        if(request()->ajax()){
            
            return auth()->user()->unreadNotifications;
        }

        return back()->with('flash', 'Notificacion marcada como leída');
    }

    public function destroy($id){
        
        DatabaseNotification::find($id)->delete();

        return back()->with('flash', 'Notificacion eliminada');
    }
}
