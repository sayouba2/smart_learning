<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('teacher_id', Auth::id())->latest()->paginate(10);
        return view('teacher.announcements.index', compact('announcements'));
    }

    public function create()
    {
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.announcements.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Announcement::create([
            'teacher_id' => Auth::id(),
            'course_id' => $request->course_id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('teacher.announcements.index')->with('success', 'Annonce publiée avec succès.');
    }

    public function edit(Announcement $announcement)
    {
        $this->authorize('update', $announcement);

        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.announcements.edit', compact('announcement', 'courses'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->authorize('update', $announcement);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $announcement->update([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('teacher.announcements.index')->with('success', 'Annonce mise à jour avec succès.');
    }

    public function destroy(Announcement $announcement)
    {
        $this->authorize('delete', $announcement);

        $announcement->delete();

        return redirect()->route('teacher.announcements.index')->with('success', 'Annonce supprimée.');
    }
}
