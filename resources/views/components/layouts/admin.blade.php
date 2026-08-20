<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1b1b1b;
        }
        .custom-card {
            background-color: #fffafa;
            border-radius: 12px;
            padding: 20px;
        }
        .card-body h5 {
            color: #333;
        }
        .list-group-item {
            background-color: #fffafa;
            color: #333;
            border: none;
        }
        .list-group-item.active {
            background-color: #333;
            color: white;
        }
    </style>

     <!-- Favicon -->
     <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            </div>

            <!-- Main Content -->
            <div class="col-md-9 p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
