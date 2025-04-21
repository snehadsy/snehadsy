<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4">Student Details</h2>

        <div class="card">
            <div class="card-body row">

                <div class="col-md-4 text-center">
                    <img src="{{ url('storage/app/public/uploads/School/image/' . $student->image) }}"
                        class="img-fluid rounded" style="max-width: 200px;" alt="Student Image">
                </div>

                <div class="col-md-8">
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

        <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
</body>

</html>
