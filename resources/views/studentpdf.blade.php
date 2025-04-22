<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Details</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        .img-fluid {
            max-width: 200px;
            border-radius: 8px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .content-row {
            display: flex;
            gap: 40px;
            align-items: center;
            margin-top: 20px;
        }

        .image-box {
            width: 30%;
            text-align: center;
        }

        .table-box {
            width: 70%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Student Details</h2>
        <h3>School: {{ $schoolName }}</h3>

        <div class="content-row">
            <div class="image-box">
                @php
                    $imagePath = public_path('storage/app/public/uploads/School/image/' . $student->image);
                @endphp

                @if ($student->image && file_exists($imagePath))
                    <h4 style="text-align: left">Student Image</h4>
                    <img src="{{ $imagePath }}" class="img-fluid " alt="Student Image" style="margin-bottom: 10px">
                @else
                    <p>No image available</p>
                @endif
            </div>

            <!-- Student Info Table -->
            <div class="table-box">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <th>Standard</th>
                        <td>{{ $student->standard->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>School</th>
                        <td>{{ $student->school->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ ucfirst($student->gender) }}</td>
                    </tr>
                    <tr>
                        <th>Year</th>
                        <td>{{ $student->year }}</td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td>{{ $student->contact }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
