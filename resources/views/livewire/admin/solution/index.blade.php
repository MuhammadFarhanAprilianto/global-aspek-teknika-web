@extends('layouts.app')

@section('title', 'Admin - Daftar Solusi')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Solusi (Admin)</h1>

        <!-- Tampilkan notifikasi jika ada success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach($solutions as $solution)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $solution->image ? asset('storage/' . $solution->image) : 'https://via.placeholder.com/400x200?text=No+Image' }}" class="card-img-top" alt="{{ $solution->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $solution->name }}</h5>
                            <p class="card-text">{{ Str::limit($solution->description, 100) }}</p>
                            <a href="{{ route('solution.show', $solution->id) }}" class="btn btn-primary">Lihat Detail</a>
                            <a href="{{ route('solution.edit', $solution->id) }}" class="btn btn-warning mt-2">Edit</a>
                            <form action="{{ route('solution.destroy', $solution->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('solution.create') }}" class="btn btn-success">Tambah Solusi Baru</a>
        </div>
    </div>
@endsection
