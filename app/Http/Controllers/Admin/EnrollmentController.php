<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'course'])->latest()->paginate(10);
        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function show($id)
    {
        $enrollment = Enrollment::with(['user', 'course'])->findOrFail($id);
        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return redirect()->route('admin.enrollments.index')->with('success', 'Inscription supprimée avec succès.');
    }
}
