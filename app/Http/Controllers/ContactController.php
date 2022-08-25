<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function contacts() {

        $contacts = Contact::latest()->paginate(2);
        return view('contacts', compact('contacts'))->render();;
    }

    public function addContact(Request $request) {

        $request->validate(
            [
                'name'=>'required|unique:contacts',
                'company'=>'required',
                'phone'=>'required',
                'email'=>'required'
            ],
            [
                'name.required'=>'Name is Required',
                'name.unique'=>'Contact Already Exists',
                'company.required'=>'Company is Required',
                'phone.required'=>'Phone is Required',
                'email.required'=>'Email is Required'
            ]
        );

        $contact = new Contact();

        $contact->name = $request->input('name');
        $contact->company = $request->input('company');
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->save();

        return response()->json([
            'status'=>'success',
        ]);
    }

    // Update Contact
    public function updateContact(Request $request) {

        $request->validate(
            [
                'up_name'=>'required|unique:contacts,name,'.$request->up_id,
                'up_company'=>'required',
                'up_phone'=>'required',
                'up_email'=>'required',
            ],
            [
                'up_name.required'=>'Name is Required',
                'up_name.unique'=>'Contact Already Exists',
                'up_company.required'=>'Company is Required',
                'up_phone.required'=>'Phone is Required',
                'up_email.required'=>'Email is Required',
            ]
        );

        Contact::where('id', $request->up_id)->update([
            'name'=>$request->up_name,
            'company'=>$request->up_company,
            'phone'=>$request->up_phone,
            'email'=>$request->up_email,
        ]);

        return response()->json([
            'status'=>'success',
        ]);
    }

    // Delete Contact
    public function deleteContact(Request $request) {
        Contact::find($request->contact_id)->delete();
        return response()->json([
            'status'=>'success',
        ]);
    }

    //Search Contact
    public function searchContact(Request $request) {
        if($request->ajax()) {
            $search_string = $request->get('search_string');
            // $search_string = str_replace(" ", "%", $search_string);
            $contacts = Contact::where('name', 'like', '%'.$search_string.'%')
                ->orWhere('company', 'like', '%'.$search_string.'%')
                ->orWhere('phone', 'like', '%'.$search_string.'%')
                ->orWhere('email', 'like', '%'.$search_string.'%')
                ->orderBy('id', 'desc')
                ->paginate(2);

            if($contacts->count() >= 1) {
                return view('pagination_contacts', compact('contacts'))->render();
            } else {
                return response()->json([
                    'status' => 'nothing_found',
                ]);
            }
        }
    }
}
