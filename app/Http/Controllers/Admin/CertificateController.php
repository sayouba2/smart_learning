<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::with(['user', 'course'])->latest()->paginate(10);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function show($id)
    {
        $certificate = Certificate::with(['user', 'course'])->findOrFail($id);
        return view('admin.certificates.show', compact('certificate'));
    }

    public function create()
    {
        $users = User::all();
        $courses = Course::all();
        return view('admin.certificates.create', compact('users', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'issued_at' => 'required|date',
        ]);

        Certificate::create($request->all());

        return redirect()->route('admin.certificates.index')->with('success', 'Certificat généré avec succès.');
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificat supprimé avec succès.');
    }
}
