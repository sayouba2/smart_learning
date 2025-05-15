@extends('layouts.teacher')

@section('content')
    <h2>Créer une nouvelle leçon pour le cours: {{ $course->title }}</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('teacher.lessons.store', $course) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titre de la leçon</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="content">Contenu de la leçon</label>
            <textarea class="form-control" name="content" id="content" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Créer la leçon</button>
    </form>
@endsection
