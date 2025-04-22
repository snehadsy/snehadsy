<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Details</title>
    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
            padding: 8px;
        }
        .img-fluid { max-width: 200px; border-radius: 8px; }
        h2 { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Details</h2>
        <div>
            <h3>School: {{ $schoolName }}</h3>
        </div>
        <div style="display: flex;">

            <div style="width: 70%;">
                <table class="table table-bordered">
                    <tr><th>Name</th><td>{{ $student->name }}</td></tr>
                    <tr><th>Standard</th><td>{{ $student->standard->name ?? 'N/A' }}</td></tr>
                    <tr><th>School</th><td>{{ $student->school->name ?? 'N/A' }}</td></tr>
                    <tr><th>Gender</th><td>{{ ucfirst($student->gender) }}</td></tr>
                    <tr><th>Year</th><td>{{ $student->year }}</td></tr>
                    <tr><th>Contact</th><td>{{ $student->contact }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
