<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class AboutController extends Controller
{
    public function index()
    {
        return view('frontend.about.index');
    }

    public function sendMail()
    {
        $data = 'Thông tin đây bro';
        $name = 'khach1';
        Mail::send('frontend.mail.test-mail', compact('data'), function($email) use($name) {
            $email->subject('Demo mail bro');
            $email->to('huuan23082000@gmail.com', $name);
        });

        return redirect()->back()->with('notification', );
    }
}
