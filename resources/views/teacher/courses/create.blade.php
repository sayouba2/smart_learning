@extends('layouts.teacher')

@section('content')
    <h2>Créer un nouveau cours</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('teacher.courses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titre du cours</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description du cours</label>
            <textarea class="form-control" name="description" id="description" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Créer le cours</button>
    </form>
@endsection
