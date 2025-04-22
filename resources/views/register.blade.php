<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('style.css') }}">

</head>

<body>

    <div class="main_sec">
        <div class="container">
            <h1 class="text-center mb-5">Register School</h1>
            <form id= "register_school_form">
                <div>
                    <label for="exampleInputEmail1" class="form-label">School
                        Name</label>
                    <input type="text" name="name" class="form-control" id=""
                        placeholder="Enter School Name">
                </div>

                <div>
                    <label for="exampleInputPassword1" class="form-label">School
                        Address</label>
                    <input type="text" name="address" class="form-control" id=""
                        placeholder="Enter School Address">
                </div>
                <div>
                    <label for="exampleInputPassword1" class="form-label">State</label>
                    <select class="form-select" name="state" aria-label="Default select example">
                        <option selected disabled>Select State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="exampleInputPassword1" class="form-label">District</label>
                    <select class="form-select" name="district" aria-label="Default select example">
                        <option selected disabled>Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}">
                                {{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="exampleInputPassword1" class="form-label">City
                    </label>
                    <select class="form-select" name="city" aria-label="Default select example">
                        <option selected disabled>Select City</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">
                                {{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="exampleInputEmail1" class="form-label">School
                        Establishment date</label>
                    <input type="date" class="form-control" name="established_at" id="exampleInputEmail1"
                        placeholder="School
                            Establishment date">
                </div>

                <div>
                    <label for="exampleInputEmail1" class="form-label">Login Id</label>
                    <input type="number" class="form-control" name="login_id" placeholder="Enter Login Id" id="exampleInputEmail1">
                </div>
                <div>
                    <label for="exampleInputEmail1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="Enter Password">
                </div>

                <div class="mt-4 pt-1">

                        <button type="submit" id="btn-submit-add"class="btn btn-success">Submit</button>
                        <a href="{{ route('login') }}" class="btn btn-info">Login</a>


                </div>
            </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    $(document).ready(function () {

        $('#register_school_form').validate({
            ignore: [],
            debug: false,
            rules: {
                name: {
                    required: true,
                },
                address: {
                    required: true,
                },
                state: {
                    required: true,
                },
                district: {
                    required: true,
                },
                city: {
                    required: true,
                },
                established_at: {
                    required: true,
                },
                login_id: {
                    required: true,
                    minlength: 6,
                },
                password: {
                    required: true,
                    minlength: 6,
                }
            },
            messages: {
                name: {
                    required: "Please Enter School Name",
                },
                address: {
                    required: "Please Enter School Address",
                },
                state: {
                    required: "Please Select State",
                },
                district: {
                    required: "Please Select District",
                },
                city: {
                    required: "Please Select City",
                },
                established_at: {
                    required: "Please Enter School Establishment Date",
                },
                login_id: {
                    required: "Please Enter Login Id",
                    minlength: "Login Id must be 6 Characters Long",
                },
                password: {
                    required: "Please Enter Password",
                    minlength: "Password must be 6 Characters Long",
                }
            },
            submitHandler: function (form) {
                var formData = new FormData(form);
                $('#btn-submit-add').text('Please wait...');
                $('#btn-submit-add').attr('disabled', true);

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: '/register/store',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status_code === 200) {
                            toastr.success(response.message);
                            setTimeout(function () {
                                window.location.href = '/login';
                            }, 1000);
                        } else {
                            toastr.error("Failed to Login");
                            // $('#btn-submit-add').text('Login');
                            // $('#btn-submit-add').attr('disabled', false);
                        }
                    },
                    error: function (error) {
                        toastr.error("Something went wrong");
                        // $('#btn-submit-add').text('Login');
                        // $('#btn-submit-add').attr('disabled', false);
                    }
                });
            }
        });
    });
</script>

</body>

</html>
