<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Qbuy.lk</title>
    <!----------------------------[ Css Library ]---------------------------->
    @include('/Admin/Component/Link/css')
</head>

<body class="bg-gray">
    <div class="container vh-100">
        <div class="row h-100 justify-content-center align-items-center">

            <div class="col-md-4">
                <div class="card RT-shadow bg-white rounded-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-center p-3 mb-3">
                            <img src="/assets/Backend/img/logo/favicon.png">
                        </div>
                        <form action="admin" method="post">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                </div>
                                <input type="text" name="email" id="email" class="form-control" placeholder="email">
                            </div>

                            <div class="text-danger">
                                <span id="invalidemail">invalid email</span>
                                <span id="emailError">required*</span>
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control" placeholder="password">
                            </div>

                            <div class="text-danger">
                                <span id="invalidpass">(8-15 include special character) </span>
                                <span id="passwordError">required*</span>
                            </div>

                            <div class="row mt-3">
                                <div class="col pr-2">
                                    <button type="submit" id="sub" class="btn btn-block btn-primary">Login</button>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!----------------------------[ Footer ]---------------------------->
                    @include('/Admin/Component/Footer/footer')
                </div>
            </div>
        </div>
    </div>


    <!----------------------------[ Javascript Library ]---------------------------->
    @include('/Admin/Component/Link/js')
    <script src="/assets/Backend/js/validation/login/login.js"></script>
</body>

</html>