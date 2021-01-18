<?php

namespace App\Http\Controllers;

use App\DataTables\FeedbackDataTable;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function index(FeedbackDataTable $dataTable)
    {
        return $dataTable->render('feedback.index', [
            "page" => (object) [
                'title' => "Feedback/Support", 'section' => 'Give us your complaints and feedback'
            ],
        ]);
    }


    public function create(Request $request)
    {
        if (request()->method() == "POST") {
            $this->validate($request, [
                'message' => 'required|min:20',
                'subject' => 'required|min:5',
            ]);

            $inputs = $request->all();
            $inputs['business_id'] = session('business_id');
            $inputs['user_id'] = auth()->user()->id;
            $inputs['status'] = 'pending';


            $resp = Feedback::create($inputs);
            auth()->user()->log("created new feedback" . $resp->name);

            try {
                Mail::to('mtnbusiness.gh@mtn.com')->send(new \App\Mail\Feedback($inputs['message'], $inputs['subject']));
            } catch (\Exception $e) {
                auth()->user()->log("Error " . $e->getMessage());
            }

            return redirect()->route('customer_support.feedback.index')->with('alert-success', 'Client Feedback Added Successfully');
        }

        return view('feedback.create', [
            "page" => (object) [
                'title' => "Add Feedback", 'section' => 'Add complaints here'
            ],
        ]);
    }

    public function edit(Request $request)
    {
        $data = Feedback::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'message' => 'required|min:20',
                'subject' => 'required|min:5',
            ]);

            $data->update($request->all());
            auth()->user()->log("updated feedback: " . $data->id);

            return redirect()->route('customer_support.feedback.index')->with('alert-success', 'Feedback Updated Successfully');
        }
        return view('feedback.edit', [
            "page" => (object) [
                'title' => "Edit Feedback", 'section' => 'Edit compliant'
            ],
            "data" => $data,
        ]);
    }

    public function delete(Request $request)
    {
        $item = Feedback::findOrFail($request->route('id', null));

        $item->delete();
        auth()->user()->log("deleted feedback: " . $item->id);

        return redirect()->route('customer_support.feedback.index')->with('alert-success', 'Feedback Deleted Successfully');
    }
}
