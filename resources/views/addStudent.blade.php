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

    <div class="main_sec py-5">
        <div class="container">
            <h1 class="text-center mb-5">Add Student</h1>
            <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3" >Back to List</a>


            <form id="studentForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Student name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Student Name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Standard</label>
                    <select class="form-select" name="standard_xid">
                        <option value="" disabled selected>Select Standard</option>
                        @foreach ($standards as $standard)
                            <option value="{{ $standard->id }}">{{ $standard->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="male">
                        <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="female">
                        <label class="form-check-label">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="other">
                        <label class="form-check-label">Other</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Year</label>
                    <select class="form-select" name="year" id="yearSelect">
                        <option value="" disabled selected>Select Year</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input type="file" class="form-control" name="image" id="imageInput" accept="image/*">
                    <img id="imagePreview" src="#" alt="Preview" class="mt-3"
                        style="max-width: 200px; display: none;" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact number</label>
                    <input type="number" class="form-control" name="contact" placeholder="Enter Contact Number">
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>

            <div id="responseMsg" class="mt-3"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        const startYear = 1900;
        const currentYear = new Date().getFullYear();
        const yearSelect = $('#yearSelect');

        for (let year = currentYear; year >= startYear; year--) {
            yearSelect.append(`<option value="${year}">${year}</option>`);
        }
    </script>
    <script>
        $('#imageInput').on('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview')
                        .attr('src', e.target.result)
                        .show();
                };
                reader.readAsDataURL(file);
            } else {
                $('#imagePreview').hide();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#studentForm').validate({
                ignore: [],
                debug: false,
                rules: {
                    name: {
                        required: true,
                    },
                    standard_xid: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    year: {
                        required: true,
                        number: true
                    },
                    contact: {
                        required: true,
                        digits: true,
                        maxlength: 10,
                        minlength: 10,
                    },
                    image: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter student name"
                    },
                    standard_xid: {
                        required: "Please select standard"
                    },
                    gender: {
                        required: "Please select gender"
                    },
                    year: {
                        required: "Please enter year",
                        number: "Year must be a number"
                    },
                    contact: {
                        required: "Please enter contact number",
                        digits: "Only digits are allowed",
                        maxlength: "Contact number must be 10 digits",
                        minlength: "Contact number must be 10 digits"
                    },
                    image: {
                        required: "Please upload a photo"
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $('#btn-submit-add').text('Please wait...');
                    $('#btn-submit-add').attr('disabled', true);
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });
                    $.ajax({
                        url: '/students/store',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {

                            if (response.status_code === 200) {
                                console.log(response);
                                toastr.success(response.message);
                                setTimeout(function() {
                                    window.location.href = '/students';
                                }, 2000);
                            } else {
                                toastr.error("Failed to add");
                                $('#btn-submit-add').text('Save');
                                $('#btn-submit-add').attr('disabled', false);
                            }
                        },
                        error: function(error) {
                            toastr.error("Something went wrong");
                            $('#btn-submit-add').text('Save');
                            $('#btn-submit-add').attr('disabled', false);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
