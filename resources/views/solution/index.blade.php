@extends('layouts.app')

@section('title', 'Daftar Solusi')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Daftar Solusi</h1>
        
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
