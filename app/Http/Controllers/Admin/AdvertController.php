<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdvertDataTable;
use App\Models\Advert;
use App\Models\AdvertStatus;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    public function index(AdvertDataTable $table)
    {
        return $table->render('admin.advert.index', [
            "page" => (object) [
                'title' => "Advertisements", 'section' => 'Advertisements'
            ],
        ]);
    }

    public function setPrice(Request $request)
    {
        $this->validate($request, [
            'advert' => 'required|exists:adverts,id_hash',
            'price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
        ]);
        $ads = Advert::findByIdHash($request['advert']);

        $ads->update([
            'price' => $request['price'],
            'status_id' => AdvertStatus::where('name', 'like', 'pending payment')->first()->id,
        ]);
        return redirect()->route('admin.advert.index')->with('alert-success', 'Price successfully added to an ADVERT');
    }

    public function publish(Request $request)
    {
        $ads = Advert::findOrFail($request->route('id'));

        $ads->update([
            'status_id' => AdvertStatus::where('name', 'like', 'published')->first()->id,
            'is_published' => true,
        ]);
        return redirect()->route('admin.advert.index')->with('alert-success', 'Advert Published Successfully');
    }

    public function unpublish(Request $request)
    {
        $ads = Advert::findOrFail($request->route('id'));

        $ads->update([
            'status_id' => AdvertStatus::where('name', 'like', 'unpublished')->first()->id,
            'is_published' => false,
        ]);
        return redirect()->route('admin.advert.index')->with('alert-success', 'Advert Unpublished Successfully');
    }

    public function delete(Request $request)
    {
        $item = Advert::findOrFail($request->route('id', null));
        $item->delete();
        auth()->user()->log("deleted advert: " . $item->name);

        return redirect()->route('admin.advert.index')->with('alert-success', 'You have successfully DELETED an ADVERT');
    }

    public function view(Request $request)
    {
        $item = Advert::findOrFail($request->route('id', null));
        return view('admin.advert.view', [
            "page" => (object) [
                'title' => "Advertisements", 'section' => 'Advertisements'
            ],
            "data" => $item
        ]);
    }
}
