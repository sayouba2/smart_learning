<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::where('teacher_id', Auth::id())->with('course', 'student')->get();
        return view('teacher.certificates.index', compact('certificates'));
    }
}
