<?php

namespace App\Http\Controllers;

use \App\Tickets;

class TicketsController extends Controller
{
    public function index(Tickets $tickets)
    {
        $tickets = \App\Tickets::latest()->get();
        $title = 'Админ панель -> Обращения';
        return view('admin.feedback', compact('tickets', 'title'));
    }
        
    public function create()
    {
        return view('contacts');
    }

    public function store()
    {
        $this->validate(request(),[
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Tickets::create(request()->all());
        
        return redirect('/contacts');
    }
}
