<?php

namespace App\Http\Controllers;

use App\Contact;
use Validator;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return view('contact')->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    protected function contactValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:14'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $validate = $this->contactValidator($data);
        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }
        // $contact = Contact::create($data);
        $contact = new Contact();
        $contact->name = $data['name'];
        $contact->phone = $data['phone'];
        $contact->save();

        \Session::flash('success', 'Saved Successfully!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($contact)
    {
        $showcontact = Contact::find($contact);

        return view('contact')->with('showcontact', $showcontact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Contact             $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->except('_token');
        $validate = $this->contactValidator($data);
        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $contact = Contact::whereId($data['id'])->first();
        $contact->name = $data['name'];
        $contact->phone = $data['phone'];
        $contact->save();

        \Session::flash('success', 'Update Successfully!');

        return redirect()->route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact)
    {
        Contact::find($contact)->delete();

        return redirect()->back();
    }
}
