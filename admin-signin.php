<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="loginCss.css">
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
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" placeholder="First Name" id="fname" class="capitalize-input">
                <input type="text" placeholder="Last Name" id="lname" class="capitalize-input">
                <input type="text" placeholder="Mobile" id="mobile">
                <button id="normal_button1" onclick="admin_signup();">Sign Up</button>

                <button class="btn btn-primary d-none" style="border-radius: 0;" type="button" id="loading_button1">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Signing up...</span>
                </button>
            </div>
        </div>

        <!-- Sign In Section -->
        <div class="form-container sign-in">
            <div class="form-div">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" placeholder="Email Address" id="signin_email">
                <input type="password" placeholder="Password" id="signin_password">
                <a class="btn forgot-pass border-0"  data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Forget Your Password?</a>
                
                <button onclick="admin_signin();" id="normal_button2">Sign In</button>

                <button class="btn btn-primary d-none" style="border-radius: 0;" type="button" id="loading_button2">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Loading...</span>
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
                    <p>Access the central control network to manage institutional operations, monitor system diagnostics, and maintain real-time campus data compliance workflows.</p>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Initialize your administrative credentials to establish secure server-side sessions, configure portal privileges, and oversee global campus integration parameters.</p>
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