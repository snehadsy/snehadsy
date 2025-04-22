<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>
    <div class="container row m-auto d-flex justify-content-center">
        <div class="col-md-6">
            <h2 class="text-align-center">Edit Student</h2>

            <form id="edit_student_form">
                @csrf

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $student->name }}" class="form-control"
                        maxlength="200" autocomplete="off" oninput="validate(this)">

                </div>

                <div class="mb-3">
                    <label>Standard</label>
                    <select name="standard_id" class="form-control" required>
                        <option value="">Select Standard</option>
                        @foreach ($standards as $standard)
                            <option value="{{ $standard->id }}"
                                {{ (int) $student->standard_xid === (int) $standard->id ? 'selected' : '' }}>
                                {{ $standard->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 gender">
                    <label class="form-label d-block">Gender</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male"
                            {{ $student->gender == 'male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="genderMale">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female"
                            {{ $student->gender == 'female' ? 'checked' : '' }}>
                        <label class="form-check-label" for="genderFemale">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderOther" value="other"
                            {{ $student->gender == 'other' ? 'checked' : '' }}>
                        <label class="form-check-label" for="genderOther">Other</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Year</label>
                    <select class="form-select" name="year" id="yearSelect" required>
                        <option value="" disabled>Select Year</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Contact</label>
                   
                        <input type="text" class="form-control" name="contact" placeholder="Enter Contact Number"
                        maxlength="10" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        id="contact"  value="{{ $student->contact }}">
                </div>

                <div class="mb-3">
                    <label>Image</label><br>
                    @if ($student->image)
                        <img id="imagePreview"
                            src="{{ url('storage/app/public/uploads/School/image/' . $student->image) }}"
                            width="100" class="mb-2">
                    @else
                        <img id="imagePreview" src="#" width="100" class="mb-2" style="display:none;">
                    @endif
                    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">
                    <p class="note">Only jpg, png, jpeg format</p>

                </div>

                <button type="submit" class="btn btn-primary">Update Student</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const startYear = 1900;
        const currentYear = new Date().getFullYear();
        const selectedYear = @json($student->year);
        const yearSelect = $('#yearSelect');

        for (let year = currentYear; year >= startYear; year--) {
            const isSelected = String(year) === String(selectedYear) ? 'selected' : '';
            yearSelect.append(`<option value="${year}" ${isSelected}>${year}</option>`);
        }

        $('#imageInput').change(function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        function validate(input) {
            if (/^\s/.test(input.value))
                input.value = '';
        }

        $(document).ready(function() {
            $('#edit_student_form').validate({
                ignore: [],
                debug: false,
                rules: {
                    name: {
                        required: true
                    },
                    standard_id: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    year: {
                        required: true
                    },
                    contact: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15
                    },

                },
                messages: {
                    name: {
                        required: "Please enter student name"
                    },
                    standard_id: {
                        required: "Please select standard"
                    },
                    gender: {
                        required: "Please select gender"
                    },
                    year: {
                        required: "Please select year"
                    },
                    contact: {
                        required: "Please enter contact number",
                        digits: "Contact number should only contain digits",
                        minlength: "Contact number should be at least 10 digits",
                        maxlength: "Contact number should not exceed 15 digits"
                    },

                },
                submitHandler: function(form) {
                    var formData = new FormData(form);


                    $('#btn-submit-edit-student').text('Please wait...').attr('disabled', true);

                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        }
                    });

                    $.ajax({
                        url: '/students/{{ $student->id }}/update',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status_code === 200) {
                                toastr.success(response.message);
                                setTimeout(function() {
                                    window.location.href = '/students';
                                }, 1000);
                            } else {
                                toastr.error('Something went wrong');
                            }
                        },
                        error: function(error) {
                            console.log(error.responseJSON);
                            toastr.error('Failed to update student');
                        },
                        complete: function() {
                            $('#btn-submit-edit-student').text('Update Student').attr(
                                'disabled', false);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
