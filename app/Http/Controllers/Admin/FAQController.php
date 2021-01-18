<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FAQDataTable;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(FAQDataTable $dataTable)
    {
        return $dataTable->render('admin.faq.index', [
            "page" => (object) [
                'title' => "FAQ", 'section' => 'Frequently Asked Questions'
            ],
        ]);
    }

    public function show()
    {
        $faq = FAQ::all();

        return view('FAQ.faq', [
            'faq' => $faq
        ]);
    }


    public function create(Request $request)
    {
        if (request()->method() == "POST") {
            $this->validate($request, [
                'question' => 'required',
                'answer' => 'required',
            ]);
            $inputs = $request->all();
            $resp = FAQ::create($inputs);

            auth()->user()->log("created new FAQ" . $resp->name);
            return redirect()->route('admin.customer_support.faq.index')->with('alert-success', 'FAQ Added Successfully');
        }

        return view('admin.faq.create', [
            "page" => (object) [
                'title' => "Add FAQ", 'section' => 'Created new frequently asked question (FAQ)'
            ],
        ]);
    }
    public function edit(Request $request)
    {
        $faq = FAQ::findOrFail($request->route('id', null));
        if (request()->method() == "POST") {
            $this->validate($request, [
                'question' => 'required',
                'answer' => 'required',
            ]);
            $inputs = $request->all();
            $faq->update([
                'answer' => $inputs['answer'],
                'question' => $inputs['question']
            ]);

            auth()->user()->log("updated FAQ" . $faq->id);
            return redirect()->route('admin.customer_support.faq.index')->with('alert-success', 'FAQ Updated Successfully');
        }

        return view('admin.faq.edit', [
            "page" => (object) [
                'title' => "Edit Feedback", 'section' => 'Edit FAQ here'
            ],
            "data" => $faq
        ]);
    }


    public function delete(Request $request)
    {
        $item = FAQ::findOrFail($request->route('id', null));

        $item->delete();
        auth()->user()->log("deleted faq: " . $item->name);

        return redirect()->route('admin.customer_support.faq.index')->with('alert-success', 'FAQ Deleted Successfully');
    }
}
