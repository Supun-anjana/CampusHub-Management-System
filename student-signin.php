<?php
require "connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="student_login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>CampusHUB</title>
</head>

<body>

    <div class="container" id="container">
        <!-- Sign Up Section -->
        <div class="form-container sign-up">
            <div class="form-div">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-microsoft"></i></a>
                </div>
                <span>fill the following details to continue</span>
                <input type="text" placeholder="Student ID | NIC" id="st_id" class="capitalize-input">

                <select class="form-select mt-2 mb-2" aria-label="Default select example" id="institute" onchange="load_branch();">
                    <option selected value="0">Select the institute</option>
                    <?php
                    $institute_rs = Database::search("SELECT * FROM `institute`");
                    $institute_num = $institute_rs->num_rows;
                    for ($i = 0; $i < $institute_num; $i++) {
                        $institute_data = $institute_rs->fetch_assoc();
                    ?>
                        <option value="<?php echo $institute_data["id"]; ?>"><?php echo $institute_data["name"]; ?></option>
                    <?php
                    }
                    ?>
                </select>

                <select class="form-select mt-2 mb-2" aria-label="Default select example" id="branch" type="button" disabled>
                    <option selected value="0">Select your branch</option>
                </select>

                <button onclick="student_signup_v2();" id="sign_up_btn1">Sign Up</button>
                <button class="btn btn-primary d-none" style="border-radius: 0;" type="button" id="loading_btn1">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Creating account...</span>
                </button>

            </div>
        </div>

        <!-- Sign In Section -->
        <div class="form-container sign-in">
            <div class="form-div d-none" id="signup_form1">
                <h1>Sign Up</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-microsoft"></i></a>
                </div>
                <span>fill the following details to continue ...</span>
                <input type="text" placeholder="First Name" id="st_fname" class="capitalize-input">
                <input type="text" placeholder="Last Name" id="st_lname" class="capitalize-input">

                <input type="email" placeholder="Email Address" id="st_email">
                <input type="password" placeholder="Password" id="st_password">

                <button onclick="student_signup_v1();" id="sign_up_btn">Sign Up</button>
                <button class="btn btn-primary d-none" style="border-radius: 0;" type="button" id="loading_btn">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Signing up...</span>
                </button>
            </div>

            <div class="form-div" id="signin_form">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-microsoft"></i></a>
                </div>
                <span>or use your email password</span>

                <?php
                
                $email = "";
                $password = "";

                if (isset($_COOKIE["student_email"])) {
                    $email = $_COOKIE["student_email"];
                }

                if (isset($_COOKIE["student_password"])) {
                    $password = $_COOKIE["student_password"];
                }

                ?>


                <input type="email" placeholder="Email Address" id="signin_email" value="<?php echo $email; ?>">
                <input type="password" placeholder="Password" id="signin_password" value="<?php echo $password; ?>">

                <div class="d-flex justify-content-start align-items-center w-100">
                    <div class="form-check text-start d-flex align-items-center gap-2">
                        <input class="form-check-input custom-checkbox" type="checkbox" id="rememberme">
                        <label class="form-check-label text-light-50 m-0" for="rememberme" style="color: #cbd5e1; cursor: pointer;">Remember Me</label>
                    </div>
                    </div>
                <a class="btn forgot-pass border-0 m-0 p-0" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Forget Your Password?</a>
                <button onclick="student_signin();" id="signin_btn">Sign In</button>

                <button class="btn btn-primary d-none" style="border-radius: 0;" type="button" id="signingin_btn">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Signing in ...</span>
                </button>
            </div>
        </div>

        <!-- Forgot password offcanvas -->
        <div style="font-size: 14px;" class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <p style="font-size: 14px;" class="offcanvas-title" id="offcanvasExampleLabel">Forget Your Password?</p>
                <a type="button" class="btn-close text-bg-dark" style="background: transparent; border: none;" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x-lg fs-5"></i></a>
            </div>
            <div class="offcanvas-body">
                <div class="mb-3">
                    <label for="admin_email" class="form-label">Email Address</label>
                    <input type="email" class="form-control text-bg-dark" style="font-size: 14px; color: #f8fafc; border-radius: 0;" id="admin_email" placeholder="name@example.com">
                    <p class="mt-2"><i class="bi bi-check2-circle"></i>&nbsp; Please enter your Email to send the verfication code.</p>
                </div>
                <button class="btn btn-success d-grid col-12 mb-2" style="border-radius: 0; font-size: 14px;" onclick="admin_verification();" id="sendvc">Send verfication code</button>
                <button class="btn btn-success d-grid col-12 d-flex justify-content-center d-none" type="button" disabled id="disabled_btn" style="border-radius: 0;">
                    <span class="spinner-grow spinner-grow-sm mt-1" aria-hidden="true"></span>&nbsp; &nbsp;
                    <span role="status">Loading...</span>
                </button>
                <hr>
                <div class="mb-3">
                    <label for="vcode" class="form-label">Verfication code</label>
                    <input type="text" class="form-control text-bg-dark" style="font-size: 14px; color: #f8fafc; border-radius: 0;" id="vcode" placeholder="eg - 512595">
                </div>
                <button class="btn btn-success d-grid col-12 mb-3" style="border-radius: 0; font-size: 14px;" onclick="admin_verify_vcode();" id="verify" disabled>Verify</button>
                <button class="btn btn-success d-grid col-12 d-flex justify-content-center d-none mb-3" type="button" disabled id="verifying" style="border-radius: 0;">
                    <span class="spinner-grow spinner-grow-sm mt-1" aria-hidden="true"></span>&nbsp; &nbsp;
                    <span role="status">Verfying...</span>
                </button>

                <div class="d-none fade" id="up">
                    <label for="newpw" class="form-label">New password</label>
                    <input type="password" class="form-control mb-2 text-bg-dark" style="font-size: 14px; color: #f8fafc; border-radius: 0;" id="newpw" placeholder="***********">

                    <label for="re_enter_pw" class="form-label">Re-enter new password</label>
                    <input type="password" class="form-control mb-3 text-bg-dark" style="font-size: 14px; color: #f8fafc; border-radius: 0;" id="re_enter_pw" placeholder="***********">

                    <button class="btn btn-success d-grid col-12 mb-2" style="border-radius: 0; font-size: 14px;" id="update_pw" onclick="admin_reset_password();">Update password</button>

                    <button class="btn btn-success d-grid col-12 d-flex justify-content-center d-none mb-3" type="button" disabled id="updating_pw" style="border-radius: 0;">
                        <span class="spinner-grow spinner-grow-sm mt-1" aria-hidden="true"></span>&nbsp; &nbsp;
                        <span role="status">Updating password...</span>
                    </button>
                </div>

            </div>
        </div>

        <!-- Toggle Overlay Section -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Already have an account? Sign in now to access your student dashboard, courses, and academic activities.</p>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Student!</h1>
                    <p>Join CampusHUB today! Create your account to step into campus life - register for upcoming events, join exciting clubs, and dive into sports!</p>
                    <button onclick="toggle_forms();" id="toggle_btn">Sign Up</button>
                    <button class="btn btn-primary d-none" style="border-radius: 0;" type="button" id="loading_signup">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap JS -->
    <script src="bootstrap.bundle.min.js"></script>
    <!-- Login Frontend -->
    <script src="script.js"></script>
</body>

</html>