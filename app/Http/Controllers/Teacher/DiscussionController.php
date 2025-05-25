<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::where('teacher_id', Auth::id())->get();
        return view('teacher.discussions.index', compact('discussions'));
    }

    public function unanswered()
{
    $discussions = Discussion::where('teacher_id', Auth::id())
        ->doesntHave('replies') // suppose une relation replies()
        ->latest()
        ->get();

    return view('teacher.discussions.unanswered', compact('discussions'));
}

}
