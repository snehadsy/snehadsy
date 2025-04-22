<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>

    <div class="main_sec login_form">
        <div class="container">
            <form id="login_form">
                <h1 class="text-center mb-4">Login</h1>
                <div>
                    <label for="exampleInputEmail1" class="form-label">Login Id</label>
                    <input type="number" class="form-control" name="login_id" placeholder="Enter Login Id"
                        id="exampleInputEmail1">
                </div>
                <div>
                    <label for="exampleInputEmail1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password"
                        id="exampleInputEmail1">
                </div>
                <div class="d-flex gap-4">
                    <button type="submit" id="btn-submit-add" class="btn btn-primary">Login</button>
                    <a href="{{ route('register') }}" class="btn btn-success">Register</a>

                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        $(document).ready(function() {

            $('#login_form').validate({

                ignore: [],
                debug: false,
                rules: {
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

                    login_id: {
                        required: "Please Enter Login Id",
                        minlength: "Login Id must be 6 Characters Long",
                    },
                    password: {
                        required: "Please Enter Password",
                        minlength: "Password must be 6 Characters Long",
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
                        url: '/verify/login',
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
                                toastr.error(response
                                .message); // This will now show properly
                                $('#btn-submit-add').text('Login');
                                $('#btn-submit-add').attr('disabled', false);
                            }
                        },
                        error: function(xhr) {
                            let message = "Something went wrong";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                            toastr.error(message);
                            $('#btn-submit-add').text('Login');
                            $('#btn-submit-add').attr('disabled', false);
                        }
                    });

                }
            });
        });
    </script>

</body>

</html>
