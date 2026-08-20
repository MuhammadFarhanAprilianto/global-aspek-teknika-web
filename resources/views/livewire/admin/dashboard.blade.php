@extends('components.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="custom-card shadow">
                <h5><i class="fa fa-list-ul"></i> GAT - Dashboard</h5>
                <hr>
                <ul class="list-group">
    <li class="list-group-item">
        <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('product.index') }}" class="text-decoration-none text-dark">
            <i class="fas fa-box"></i> Product
        </a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('solution.index') }}" class="text-decoration-none text-dark">
            <i class="fas fa-lightbulb"></i> Solution
        </a>
    </li>
    <li class="list-group-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link text-danger p-0 m-0">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </li>
</ul>

            </div>
        </div>
        <div class="col-md-9">
            <div class="custom-card shadow">
                <h5><i class="fa fa-tachometer-alt"></i> Dashboard</h5>
                <hr>
                <p>Selamat Datang <strong>{{ auth()->check() ? auth()->user()->name : 'Tamu' }}</strong></p>
                <p>Ini adalah halaman admin dashboard. Silakan navigasi dari menu di kiri.</p>
            </div>
        </div>
    </div>
</div>

@endsection
