<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maxim's Group - Login</title>
    <!--favicon-->
    <link rel="icon" href="assets/images/logo/Maxims_Group-removebg-preview.png" type="image/png">

    <!--plugins-->
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/metismenu/mm-vertical.css">
    <!--bootstrap css-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="sass/main.css" rel="stylesheet">
    <link href="sass/dark-theme.css" rel="stylesheet">
    <link href="sass/blue-theme.css" rel="stylesheet">
    <link href="sass/responsive.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f4f0 !important;
            /* soft off-white */
        }

        .auth-basic-wrapper {
            min-height: 100vh;
            background-color: #f5f4f0;
        }

        .auth-basic-wrapper .card {
            background-color: #ffffff;
            /* pure white card */
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
        }

        .auth-basic-wrapper .form-control {
            background-color: #ffffff !important;
            background-image: none !important;
            color: #212529 !important;
            -webkit-text-fill-color: #212529 !important;
            border: 1px solid #dcdcdc;
            padding: 0.65rem 0.9rem;
            border-radius: 8px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .auth-basic-wrapper .form-control::placeholder {
            color: #a3a3a3 !important;
            opacity: 1 !important;
            -webkit-text-fill-color: #a3a3a3 !important;
        }

        .auth-basic-wrapper .form-control:-ms-input-placeholder {
            color: #a3a3a3 !important;
        }

        .auth-basic-wrapper .form-control::-ms-input-placeholder {
            color: #a3a3a3 !important;
        }

        .auth-basic-wrapper .form-control:focus {
            background-color: #ffffff !important;
            color: #212529 !important;
            border-color: #6c63ff;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.12);
        }

        .auth-basic-wrapper .btn-grd-primary {
            background: #514ef3 !important;
            background-image: none !important;
            border: none;
            color: #ffffff;
            font-weight: 500;
            padding: 0.7rem 1rem;
            border-radius: 8px;
            transition: background-color 0.2s ease, transform 0.15s ease;
        }

        .auth-basic-wrapper .btn-grd-primary:hover {
            background: #423ee0 !important;
            transform: translateY(-1px);
        }

        .auth-basic-wrapper .btn-grd-primary:active {
            transform: translateY(0);
        }

        #show_hide_password {
            position: relative;
        }

        #show_hide_password .form-control {
            padding-right: 2.75rem;
        }

        #show_hide_password .toggle-password-btn {
            position: absolute;
            top: 50%;
            right: 0.75rem;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 0;
            color: #a3a3a3;
            display: flex;
            align-items: center;
            cursor: pointer;
            z-index: 5;
        }

        #show_hide_password .toggle-password-btn:hover {
            color: #6c63ff;
        }
    </style>

</head>

<body>

    <!--authentication-->
    <div class="auth-basic-wrapper d-flex align-items-center justify-content-center">
        <div class="container-fluid my-5 my-lg-0">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                    <div class="card rounded-4 mb-0 border-top border-4 border-primary border-gradient-1">
                        <div class="card-body p-5">
                            <img src="assets/images/logo/Maxims_Group-removebg-preview.png" class="mb-4 d-block mx-auto"
                                width="145" alt="">
                            <h4 class="fw-bold">Maxim's Group</h4>
                            <p class="mb-0">Enter your credentials to login your account</p>

                            <div class="form-body my-5">
                                <form method="POST" action="{{ route('login1') }}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email</label>
                                        <input type="email" class="form-control" placeholder="Enter Email"
                                            name="email" id="inputEmailAddress">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="inputChoosePassword" class="form-label">Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control" id="inputChoosePassword"
                                                name="password" placeholder="Enter Password">
                                            <button type="button" class="toggle-password-btn">
                                                <i class="bi bi-eye-slash-fill"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-grd-primary">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </div>
    <!--authentication-->


    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#show_hide_password .toggle-password-btn").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });
        });
    </script>

</body>
<script>
    'undefined' === typeof _trfq || (window._trfq = []);
    'undefined' === typeof _trfd && (window._trfd = []), _trfd.push({
        'tccl.baseHost': 'secureserver.net'
    }, {
        'ap': 'cpsh-oh'
    }, {
        'server': 'p3plzcpnl509132'
    }, {
        'dcenter': 'p3'
    }, {
        'cp_id': '10399385'
    }, {
        'cp_cl': '8'
    })
</script>
<script src='../../../../img1.wsimg.com/signals/js/clients/scc-c2/scc-c2.min.js'></script>

</html>
