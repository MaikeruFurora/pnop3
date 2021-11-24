<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function create(Request $request){
        Announcement::updateorcreate(['id'=>$request->id],[
            'headline'=>Str::title($request->headline),
            'slug'=>Str::slug($request->headline),
            'content_body'=>$request->content_body,
            'visible_by'=>$request->visible_by
        ]);
    }

    public function list(){
        return response()->json(
            Announcement::latest()->get()
        );
    }

    public function edit(Announcement $announcement){
        return response()->json($announcement);
    }

    public function destroy(Announcement $announcement){
        return $announcement->delete();
    }
}
