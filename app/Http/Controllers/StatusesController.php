<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class StatusesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            "content"=>"required|max:148"
        ]);

        Auth::user()->statuses()->create([
            "content"=>$request->content
        ]);

        return redirect()->back();
    }

    public function destroy(Status $status)
    {
        $this->authorize("destroy",$status);
        $status->delete();
        session()->flash("success","删除成功");
        return redirect()->back();
    }
}
