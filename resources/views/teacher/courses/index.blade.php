@extends('layouts.teacher')

@section('content')
<div class="container">
    <h1>Mes Cours</h1>
    
    @foreach($courses as $course)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $course->title }}</h5>
            <p>Niveau : {{ ucfirst($course->level) }}</p>
            <p>Prix : {{ $course->is_free ? 'Gratuit' : $course->price.' €' }}</p>
            <a href="{{ route('teacher.courses.edit', $course) }}" class="btn btn-sm btn-primary">
                Modifier
            </a>
            <form action="{{ route('teacher.courses.destroy', $course) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Confirmer la suppression ?')">
                    Supprimer
                </button>

                <a href="{{ route('courses.show', $course) }}" 
                   class="btn btn-sm btn-outline-primary">
                   Voir détails
                </a>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection