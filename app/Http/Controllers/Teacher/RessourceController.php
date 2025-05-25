<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resource;
use App\Models\Course;

class RessourceController extends Controller
{
    public function index()
    {
        $resources = Resource::where('teacher_id', Auth::id())->latest()->get();
        return view('teacher.resources.index', compact('resources'));
    }

    public function create()
    {
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.resources.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'file' => 'required|file|max:10240',
        ]);

        $filePath = $request->file('file')->store('resources', 'public');

        Resource::create([
            'teacher_id' => Auth::id(),
            'course_id' => $request->course_id,
            'title' => $request->title,
            'file_path' => $filePath,
        ]);

        return redirect()->route('teacher.resources.index')->with('success', 'Ressource ajoutée.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
        ]);

        $path = $request->file('file')->store('resources/temp', 'public');

        return response()->json(['path' => $path]);
    }

    public function show(Resource $resource)
    {
        $this->authorize('view', $resource);

        return response()->download(storage_path('app/public/' . $resource->file_path));
    }

    public function edit(Resource $resource)
    {
        $this->authorize('update', $resource);

        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.resources.edit', compact('resource', 'courses'));
    }

    public function update(Request $request, Resource $resource)
    {
        $this->authorize('update', $resource);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240',
        ]);

        $data = [
            'course_id' => $request->course_id,
            'title' => $request->title,
        ];

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('resources', 'public');
        }

        $resource->update($data);

        return redirect()->route('teacher.resources.index')->with('success', 'Ressource mise à jour.');
    }

    public function destroy(Resource $resource)
    {
        $this->authorize('delete', $resource);

        $resource->delete();

        return redirect()->route('teacher.resources.index')->with('success', 'Ressource supprimée.');
    }
}
