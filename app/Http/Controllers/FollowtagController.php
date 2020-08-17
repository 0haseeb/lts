<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tag;

class FollowtagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Follow a tag (topic)
     *
     * @param  Tag  $tag // tag to be folllowed by auth user
     * @return \Illuminate\Http\Response
     */
    public function followtag(Tag $tag)
    {
        // chech id auth user isn't alrady folloeing the tag
        if (!Auth::user()->isFollowingtag($tag->id)) {
            // Create a new follow tag instance for the authenticated user
            Auth::user()->followtag()->create([
           'tag_id' => $tag->id,
      ]);
            return back();
        } else {
            return back();
        }
    }

    /**
     * Follow a tag (topic)
     *
     * @param  Tag  $tag // tag to be unfolllowed by auth user
     * @return \Illuminate\Http\Response
     */
    public function unfollowtag(Tag $tag)
    {
        if (Auth::user()->isFollowingtag($tag->id)) {
            // delete follow tag instance for the authenticated user for $tag
            $followtag = Auth::user()->followtag()->where('tag_id', $tag->id)->first();
            $followtag->delete();
            return back();
        } else {
            return back();
        }
    }
}
