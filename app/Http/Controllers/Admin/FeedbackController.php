<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FeedbackDataTable;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(FeedbackDataTable $dataTable)
    {
        return $dataTable->render('admin.feedback.index', [
            "page" => (object) [
                'title' => "Feedback/Complaints", 'section' => 'User Feedbacks/Complaints'
            ],
        ]);
    }

    /**
     * Mark feedback/complaint as closed
     *
     * @param Request $request
     * @return void
     */
    public function close(Request $request)
    {
        $data = Feedback::findOrFail($request->route('id', null));
        $data->update(['status' => 'Closed']);
        return redirect()->route('admin.customer_support.feedback.index')->with('alert-success', 'Client Feedback Closed Successfully');
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

            return redirect()->route('admin.customer_support.feedback.index')->with('alert-success', 'Feedback Updated Successfully');
        }
        return view('admin.feedback.edit', [
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

        return redirect()->route('admin.customer_support.feedback.index')->with('alert-success', 'Feedback Deleted Successfully');
    }
}
