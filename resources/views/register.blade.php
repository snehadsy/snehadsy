<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{ asset('style.css') }}">

    </head>
    <body>

        <div class="main_sec">
            <div class="container">
                <h1 class="text-center mb-5">Register School</h1>
                <form>
                    <div>
                        <label for="exampleInputEmail1"
                            class="form-label">School
                            Name</label>
                        <input type="text" class="form-control"
                            id="exampleInputEmail1">
                    </div>

                    <div>
                        <label for="exampleInputPassword1"
                            class="form-label">School
                            Address</label>
                        <input type="text" class="form-control"
                            id="exampleInputPassword1">
                    </div>
                    <div>
                        <label for="exampleInputPassword1"
                            class="form-label">State</label>
                        <select class="form-select"
                            aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div>
                        <label for="exampleInputPassword1"
                            class="form-label">District</label>
                        <select class="form-select"
                            aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div>
                        <label for="exampleInputPassword1"
                            class="form-label">City /
                            Village</label>
                        <select class="form-select"
                            aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div>
                        <label for="exampleInputEmail1"
                            class="form-label">School
                            Establishment date</label>
                        <input type="date" class="form-control"
                            id="exampleInputEmail1">
                    </div>
                    <div>
                        <label for="exampleInputEmail1"
                            class="form-label">School
                            Photo</label>
                        <input type="file" class="form-control"
                            id="exampleInputEmail1">
                    </div>
                    <div>
                        <label for="exampleInputEmail1"
                            class="form-label">Login Id</label>
                        <input type="number" class="form-control"
                            id="exampleInputEmail1">
                    </div>
                    <div>
                        <label for="exampleInputEmail1"
                            class="form-label">Password</label>
                        <input type="password" class="form-control"
                            id="exampleInputEmail1">
                    </div>

                    <div class="mt-4 pt-1">
                        <a href="login.html">
                            <button type="submit"
                            class="btn btn-info">Submit</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
