<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\Pushall;

class PushServiceController extends Controller
{
    public function form()
    {
        return view('service');
    }

    public function send(Pushall $pushall)
    { 
        $data = request()->validate([
            'text' => 'required|max:80',
            'title' => 'required|max:500',
        ]);

        push_all($data['title'], $data['text']);

        flash('Успешно отправлено');

        return back();

    }
}
