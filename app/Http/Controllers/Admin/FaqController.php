<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('admin.faqs', compact('faqs'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'question' => 'required|max:60',
        ]);

        // dd($request->all());
        try {

            $faqs = new Faq();
            $faqs->name = $request->question;
            $faqs->description = $request->description;
            $faqs->ip_address = $request->ip();
            $faqs->created_by = Auth::user()->id;
            $faqs->save();

            $notification=array(
                'message'=>'Data Added Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        } catch (\Exception $e) {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function edit($id)
    {
        $faqs = Faq::latest()->get();
        $faqdata = Faq::find($id);
        return view('admin.faqs', compact('faqs', 'faqdata'));
    }

    public function update(Request $request, $id)
    {

        try {
            $faqs = Faq::find($id);



            $faqs->name = $request->question;
            $faqs->description = $request->description;
            $faqs->ip_address = $request->ip();
            $faqs->updated_by = Auth::user()->id;
            $faqs->save();

            $notification=array(
                'message'=>'Data Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('faq.index')->with($notification);

        } catch (\Exception $e) {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function delete(Request $request)
    {
        try {
            $faqs = Faq::find($request->id);
            $faqs->delete();
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