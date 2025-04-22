<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>
    <div class="dashboard_sec py-4">
        <div class="container">
            <div class="d-flex justify-content-between mb-4">
                <h4>Dashboard</h4>
                <div class="d-flex justify-content-between mb-4 gap-4">
                    <a href="{{ route('students.add') }}" class="btn btn-secondary">+
                        Add</a>
                    <a href="#" class="btn btn-danger">
                        Logout</a>
                </div>
            </div>
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
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
                                <a href="{{ route('students.edit', $student->id) }}"
                                    class="btn btn-success btn-sm">Edit</a>
                                <button class="btn btn-danger delete_student" data-student-id="{{ $student->id }}">
                                    Delete
                                </button>
                                <a href="{{ route('students.export', $student->id) }}"
                                    class="btn btn-success btn-sm">Export</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <input type="hidden" id="id_input">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this student?
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Confirm Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete_student').click(function(e) {
                e.preventDefault();

                const studentId = $(this).data('student-id');
                $('#id_input').val(studentId);
                $('#deleteModal').modal('show');
            });

            $('#confirmDelete').click(function() {
                const studentId = $('#id_input').val();

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    type: 'DELETE',
                    url: '/students/' + studentId,
                    success: function(response) {
                        if (response.status_code === 200 || response.success) {
                            toastr.success(response.message || 'Student deleted successfully!');

                            $(`button[data-student-id="${studentId}"]`).closest('tr').remove();

                            $('#deleteModal').modal('hide');

                        } else {
                            toastr.error(response.message || 'Failed to delete student');
                        }
                    },
                    error: function(error) {
                        console.error('Ajax request failed', error);
                        toastr.error('An error occurred while deleting the student.');
                    }
                });
            });

            $('#myTable').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>
