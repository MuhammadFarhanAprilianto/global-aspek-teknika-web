@extends('layouts.app')

@section('title', 'Detail Solusi')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $solution->name }}</h1>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <img src="{{ $solution->image ? asset('storage/' . $solution->image) : 'https://via.placeholder.com/600x300?text=No+Image' }}" class="card-img-top" alt="{{ $solution->name }}">
                    <div class="card-body">
                        <p class="card-text">{{ $solution->description }}</p>
                        <p><strong>Penulis:</strong> {{ $solution->author ?? 'Tidak Diketahui' }}</p>
                        <p><strong>Diterbitkan pada:</strong> {{ \Carbon\Carbon::parse($solution->published_at)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('solution.publicIndex') }}" class="btn btn-secondary">Kembali ke Daftar Solusi</a>
        </div>
    </div>
@endsection
