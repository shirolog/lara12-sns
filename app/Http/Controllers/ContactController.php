<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{   
    //お問い合わせフォームの表示
    public function index() {

        return view('contact.index');
    }

    //確認画面の表示
    public function confirm(Request $request) {

        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        if($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $contactData = $request->all();

        return view('contact.confirm', compact('contactData'));
    }


    //お問い合わせの送信処理

    public function send(Request $request) {

        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        if($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);
        }


        $contact = new Contact();

        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->message = $request->input('message');
        $contact->save();

        session()->flash('success', 'お問い合わせが送信されました。');

        return redirect()->route('contact.complete');
    }

    public function complete() {

        return view('contact.complete');
    }
}
