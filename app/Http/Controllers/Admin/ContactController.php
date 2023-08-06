<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $message = Contact::latest()->get();
        return view('admin.public_message', compact('message'));
    }

    public function destroy(Request $request)
    {
        try {
            $message = Contact::find($request->id);
            if($message){
                $message->delete();
            }
            
            return response()->json([
                'message'=>'Data Deleted Successfully',
                'success'=> true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Something went wrong!',
                'success'=> false
            ]);
        }
        
    }

}
