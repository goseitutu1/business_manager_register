<?php

namespace App\Http\Controllers\Account;

use App\DataTables\Account\JournalDataTable;
use App\Http\Controllers\Controller;
use App\Models\GLAccount;
use App\Models\Journal;
use App\Tools\JournalTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JournalController extends Controller
{
    private function resources()
    {
        $accounts = GLAccount::select('id', 'name')->get()->toArray();
        return (object) [
            'accounts' => $accounts,
        ];
    }

    public function index(JournalDataTable $dataTable)
    {
        return $dataTable->render('account.gl.index', [
            "page" => (object) [
                'title' => "Accounts | General Journal", 'section' => 'General Journal'
            ],
        ]);
    }

    public function edit(Request $request)
    {
        $main = Journal::findOrFail($request->route('id', null));

        if ("POST" == request()->method()) {
            session()->put('js_grid', json_decode(request()->get('entries')), true);
            if (json_decode($request['entries']) == null)
                $this->validate($request, ['entries' => 'required']);

            $this->validate(request(), ['description' => 'required|string']);

            DB::transaction(function () use (&$main) {
                $inputs = request()->all();
                $math = JournalTool::calculateEntryTotals(json_decode($inputs['entries'], true));
                $inputs['debit_total'] = $math['debit_total'];
                $inputs['credit_total'] = $math['credit_total'];
                $inputs['credit_total'] = $math['credit_total'];
                $inputs['entries'] = $math['entries'];
                $inputs['business_id'] = session('business_id');

                // update journal & journal entries
                $main->update($inputs);
                $active = [];
                foreach ($inputs['entries'] as $item) {
                    $new = $main->entries()->updateOrCreate($item);
                    $active[] = $new->id;
                }

                // delete removed items
                $main->entries()->whereNotIn('id', $active)->delete();

                session()->remove('js_grid');
                auth()->user()->log("updated journal: " . $main->id);
            });

            Session::flash('alert-success', 'Journal Updated Successfully');
            return redirect()->route('account.journal.index');
        }

        $res = $this->resources();
        return view('account.journal.edit', [
            "page" => (object) [
                'title' => "Accounts | General Journal", 'section' => 'General Journal'
            ],
            "data" => $main,
            "entries" => json_encode($main->entries),
            "accounts" => json_encode($res->accounts)
        ]);
    }

    public function view(Request $request)
    {
        $journal = Journal::findOrFail($request->route('id', null));

        $res = $this->resources();
        return view('account.journal.view', [
            "page" => (object) [
                'title' => "Accounts | General Journal", 'section' => 'General Journal'
            ],
            "data" => $journal,
            "entries" => json_encode($journal->entries),
            "accounts" => json_encode($res->accounts)
        ]);
    }

    public function delete(Request $request)
    {
        $journal = Journal::findOrFail($request->route('id', null));
        $journal->delete();

        auth()->user()->log("deleted journal: " . $journal->id);

        Session::flash('alert-success', 'Journal Deleted Successfully');
        return redirect()->route('account.journal.index');
    }
}
