@extends('layouts.app')

@section('title', 'Edit Solusi')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Solusi</h1>

        <form action="{{ route('solution.update', $solution->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Solusi</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $solution->name) }}" required>
                @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Solusi</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $solution->description) }}</textarea>
                @error('description')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Penulis</label>
                <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $solution->author) }}">
                @error('author')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="published_at" class="form-label">Tanggal Terbit</label>
                <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at', $solution->published_at) }}">
                @error('published_at')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar Solusi</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
                @if($solution->image)
                    <p>Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $solution->image) }}" alt="{{ $solution->name }}" class="img-fluid">
                @endif
            </div>

            <button type="submit" class="btn btn-warning w-100">Perbarui Solusi</button>
        </form>
    </div>
@endsection
