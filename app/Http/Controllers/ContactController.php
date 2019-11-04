<?php

namespace App\Http\Controllers;
use App\Http\Resources\Contact as ContactResource;
use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $contact = ContactResource::collection(Contact::paginate(10));
        return $contact;
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phonenumber' => 'required'
        ]);

        $contact = Contact::create($request->all());
        return response()->json([
            'message' => 'Contact created!',
            'contact' => ContactResource::make($contact)
        ]);
    }

    public function show(Request $request)
    {
        $contact = Contact::findOrFail($request->id);
        return response()->json([
            'message' => 'Contact Fetched!',
            'contact' => ContactResource::make($contact)
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phonenumber' => 'required'
        ]);
        $contact = Contact::findOrFail($request->id);
//        $contact->update($request->all());
        $contact->fill($request->all())->save();

        return response()->json([
            'message' => 'Contact Updated!',
            'contact' => ContactResource::make($contact)
        ]);
    }

    public function destroy(Request $request)
    {
        $contact = Contact::findOrFail($request->id);
        $contact->delete();

        return response()->json([
            'message' => 'Contact Deleted!',
            'contact' => ContactResource::make($contact)
        ]);
    }
    public function search(Request $request){

    }

}
