<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>
    <div class="dashboard_sec py-4">
        <div class="container">
            <div class="d-flex justify-content-between mb-4">
                <h4>Dashboard - School: {{ $school->name }}</h4>
                <div class="d-flex justify-content-between mb-4 gap-4">
                    <a href="{{ route('students.add') }}" class="btn btn-secondary">+
                        Add</a>
                        <button type="button" class="btn btn-danger" id="logout_button">Logout</button>

                </div>
            </div>
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr no</th>
                        <th>Name</th>
                        <th>Standard</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Year</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->standard->name ?? 'N/A' }}</td>
                            <td>{{ ucfirst($student->gender) }}</td>
                            <td>{{ $student->contact }}</td>
                            <td>{{ $student->year }}</td>
                            <td>
                                <img src="{{ url('storage/app/public/uploads/School/image/' . $student->image) }}"
                                    alt="Image" style="max-width: 100px; max-height: 100px;">

                            </td>
                            <td>
                                <a href="{{ route('students.show', $student->id) }}"
                                    class="btn btn-info btn-sm">View</a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="{{ route('students.export', $student->id) }}"
                                    class="btn btn-success btn-sm">Export</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        $('#logout_button').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("logout") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = '/login';
                    } else {
                        toastr.error('Logout failed.');
                    }
                },
                error: function(xhr) {
                    toastr.error('An error occurred during logout.');
                }
            });
        });
    </script>

</body>

</html>
