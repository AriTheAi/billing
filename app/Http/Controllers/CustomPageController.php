<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomPageController extends Controller
{
    public function viewPage(Request $request, $slug)
    {
        $sql = DB::table('pages')->where('slug','=',$slug)->get();
        if(count($sql) != 0)
        {
            $data = [
                        'title'     => $sql[0]->title,
                        'content'   => $sql[0]->content
                    ];
            return view('public/custompage', $data);
        }
        else
        {
            abort(404);
        }
    }
}