<?php

namespace App\Tools;


use App\Models\Journal;
use App\Models\JournalEntry;
use Carbon\Carbon;

// journal tool helper class
class JournalTool
{


    /**
     * Create debit and credit journal entries
     *
     * @param Journal $journal
     * @param $item
     */
    public static function debitAndCreditEntries(Journal $journal, array $item)
    {
        $journal->entries()->create([
            'entry_code' => JournalTool::getNextEntryCode(),
            'journal_id' => $journal->id,
            'entry_time' => !empty($item['date']) ? Carbon::parse($item['date']) : Carbon::now(),
            'is_posted' => false,
            'amount' => $item['credit_amount'],
            'comment' => $item['credit_comment'],
            'credit_account_id' => $item['credit_account_id'],
            'debit_account_id' => 0,
        ]);
        $journal->entries()->create([
            'entry_code' => JournalTool::getNextEntryCode(),
            'journal_id' => $journal->id,
            'entry_time' => !empty($item['date']) ? Carbon::parse($item['date']) : Carbon::now(),
            'is_posted' => false,
            'amount' => $item['debit_amount'],
            'comment' => $item['debit_comment'],
            'credit_account_id' => 0,
            'debit_account_id' => $item['debit_account_id'],
        ]);
    }

    // calculate
    public static function calculateEntryTotals(array $items)
    {
        $data   = ['debit_total' => 0, 'credit_total' => 0, 'entries' => []];
        foreach ($items as $item) {
            // debit
            if ($item['debit_account_id'] > 0)
                $data['debit_total'] += $item['amount'];

            // credit
            if ($item['credit_account_id'] > 0)
                $data['credit_total'] += $item['amount'];

            $data['entries'][] = $item;
        }
        return $data;
    }
    // JOURNAL BATCH
    //    public function journal($item, $reverse = false) {
    //        $journal = null;
    //        if ($this->isValid($item, 'JOURNAL')) {
    //            $journal = Journal::create([
    //                'batch_no' => isset($item['batch_no']) ? $item['batch_no'] : $this->getNextBatchNo($reverse),
    //                'is_posted' => false,
    //                'description' => $item['description'],
    //                'name' => @$item['name'] ?? "",
    //                'transaction_date' => Carbon::parse($item['date']),
    //                'debit_total' => $item['debit_total'],
    //                'credit_total' => $item['credit_total'],
    //                'branch_id' => $item['branch_id']
    //            ]);
    //        }
    //        return $journal;
    //    }
    //
    //    // DEBIT ENTRY
    //    public function debit($item, $reverse = false) {
    //        $entry = null;
    //        if ($this->isValid($item, 'ENTRY')) {
    //            $entry = JournalEntry::create([
    //                'entry_code' => $this->getNextEntryCode($reverse),
    //                'journal_id' => $item['journal_id'],
    //                'entry_time' => Carbon::parse($item['date']),
    //                'is_posted' => false,
    //                'amount' => $item['amount'],
    //                'comment' => $item['comment'],
    //                'credit_account_id' => 0,
    //                'debit_account_id' => $item['account_id'],
    //                'cost_centre_id' => $item['cost_centre_id'],
    //                'branch_id' => $item['branch_id'],
    //            ]);
    //        }
    //        return $entry;
    //    }
    //
    //    // CREDIT ENTRY
    //    public function credit($item, $reverse = false) {
    //        $entry = null;
    //        if ($this->isValid($item, 'ENTRY')) {
    //            $entry = JournalEntry::create([
    //                'entry_code' => $this->getNextEntryCode($reverse),
    //                'journal_id' => $item['journal_id'],
    //                'entry_time' => Carbon::parse($item['date']),
    //                'is_posted' => false,
    //                'amount' => $item['amount'],
    //                'comment' => $item['comment'],
    //                'credit_account_id' => $item['account_id'],
    //                'debit_account_id' => 0,
    //                'cost_centre_id' => $item['cost_centre_id'],
    //                'branch_id' => $item['branch_id'],
    //            ]);
    //        }
    //        return $entry;
    //    }
    //
    //    // validate journal entry
    //    public function isValid($data, $type) {
    //        $data = (object) $data;
    //
    //        // batch data
    //        if (strtoupper($type) == 'BATCH') {
    //
    //        }
    //
    //        // journal data
    //        if (strtoupper($type) == 'JOURNAL') {
    //            if ($data->branch_id != null && $data->branch_id > 0 && $data->date != null &&
    //                $data->debit_total > 0 && $data->credit_total > 0 && $data->description !== null) {
    //                return true;
    //            }
    //        }
    //
    //        // entry data
    //        if (strtoupper($type) == 'ENTRY') {
    //            if ($data->branch_id != null && $data->branch_id > 0 &&
    //                $data->journal_id != null & $data->journal_id > 0 &&
    //                $data->amount != null && $data->amount > 0 &&
    //                $data->account_id != null && $data->account_id > 0 &&
    //                $data->cost_centre_id != null && $data->cost_centre_id > 0 &&
    //                $data->comment != null && $data->date != null) {
    //                return true;
    //            }
    //        }
    //        return false;
    //    }
    //
    //    // validate journal entry FROM form NJE / RJE
    //    // todo: refactor this algo so we use only one validation instance
    //    // todo: if not implemented, remind adamian@npontu.com
    //    public function valid($entry) {
    //        $item = (object) $entry;
    //        if
    //        (
    //            (
    //                $item->debit_account_id == 0 && $item->credit_account_id != 0 ||
    //                $item->debit_account_id != 0 && $item->credit_account_id == 0 ||
    //                $item->debit_account_id != 0 && $item->credit_account_id != 0 &&
    //                $item->debit_account_id != $item->credit_account_id
    //            )
    //            &&
    //            (
    //                $item->comment != null && $item->amount != null && $item->amount > 0 &&
    //                $item->cost_centre_id != null && $item->cost_centre_id > 0)
    //        ) {
    //            return true;
    //        }
    //        return false;
    //    }
    //
    //    // get next batch no
    //    public function getNextBatchNo($rev = false) {
    //        $code = null;
    //        $pref = 'GJ';
    //
    //        if (!$rev) {
    //            $query = Journal::select(DB::raw('max(batch_no) as batch_no'))->where('batch_no', 'like', '%' . $pref . '%')->first();
    //            $batch = $query->batch_no;
    //            $code = $batch != null ? $pref . sprintf('%06d', (int) substr($batch, 2) + 1) : $pref . '000001';
    //        } else // reversal
    //        {
    //            $pref = "RGJ";
    //            $query = Journal::select(DB::raw('max(batch_no) as batch_no'))->where('batch_no', 'like', '%R%')->first();
    //            $batch = $query->batch_no;
    //            if ($batch != null) {
    //                preg_match("/R?GJ(\d{6,7})/", $batch, $match);
    //                $code = $pref . sprintf('%06d', $match[1] + 1);
    //            } else {
    //                $code = $pref . sprintf('%06d', 1);
    //            }
    //        }
    //        return $code;
    //    }

    // get next entry code
    public static function getNextEntryCode()
    {
        return "JE" . sprintf('%06d', JournalEntry::count() + 1);
    }
}
