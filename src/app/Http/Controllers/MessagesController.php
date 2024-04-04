<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        return Messages::where([['user_id_from','=', $request->from], ['user_id_to','=', $request->to]])
            ->orWhere([['user_id_from','=', $request->to], ['user_id_to','=', $request->from]])
            ->get();
    }


    public function store(Request $request)
    {
        $message = Messages::create($request->all());
        return Messages::all();
    }


    public function show(Request $request)
    {

    }

    public function update(Request $request, $id)
    {
        $message = Messages::find($id);
        $message->message = $request->text;
        $message->save();
    }

    public function destroy(Messages $messages)
    {
        //
    }
}
