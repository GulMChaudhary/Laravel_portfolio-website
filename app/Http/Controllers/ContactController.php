<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function create ()
    {
        return view('admin.contact.create');
    }

    public function store(Request $request)
    {
        Contact::insert([
            'address'   => $request->address,
            'city'      => $request->city,
            'country'   => $request->country,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'created_at'=>  Carbon::now(),

        ]);

        return redirect()->route('contact')->with('success', 'Contact details added.');
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.edit', compact('contact'));

    }

    public function update(Request $request, $id)
    {
        Contact::findOrFail($id)->update([
            'address'   => $request->address,
            'city'      => $request->city,
            'country'   => $request->country,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'updated_at'=>  Carbon::now(),

        ]);

        return redirect()->route('contact')->with('success', 'Contact details updated.');

    }

    public function destroy ($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('contact')->with('success', 'Contact details updated.');
    }

    public function contactForm (Request $request)
    {
        ContactForm::insert([
            'name'   => $request->name,
            'email'      => $request->email,
            'subject'   => $request->subject,
            'message'     => $request->message,
            'created_at'=>  Carbon::now(),

        ]);

        return redirect()->back()->with('success', 'Your message is received.');
    }

    public function displayMessages ()
    {
        $messages = ContactForm::all();
        return view('admin.contact.message', compact('messages'));
    }

    public function destroyMessages($id)
    {
        ContactForm::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Message deleted.');
    }

}
