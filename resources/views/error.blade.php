<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized - 404</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <!-- Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .error-container {
            text-align: center;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .error-code {
            font-size: 8rem;
            font-weight: 700;
            color: #dc3545;
        }

        .error-message {
            font-size: 1.8rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .error-description {
            color: #6c757d;
            margin-bottom: 30px;
        }

        .home-btn {
            padding: 10px 25px;
            font-size: 1rem;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-code">401</div>
        <div class="error-message">Unauthorized Access</div>
        <div class="error-description">
            Sorry, you are not authorized to access this page.<br>
            Please go back or return to the home page.
        </div>
        <a href="{{ route('students.index') }}" class="btn btn-primary home-btn">Go to Home</a>
    </div>
</body>

</html>
