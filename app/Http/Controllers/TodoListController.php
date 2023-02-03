<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoListController extends Controller
{
    public function index()
    {
        $list = ["listItems" => ListItem::where('is_complete', 0)->get()];
        return view('welcome', $list);
    }

    public function SaveItem(Request $request)
    {
        Log::info(json_encode($request->all()));

        $newListItem = new ListItem();
        $newListItem->name = $request->listItem;
        $newListItem->is_complete = 1; //$request->listItem;
        $newListItem->save();

        return redirect('/');
    }
    public function MarkComplete($id)
    {
        Log::info($id);
        $listItem = ListItem::find($id);
        $listItem->is_complete = 1;
        $listItem->save();
        return redirect('/');
    }
}
