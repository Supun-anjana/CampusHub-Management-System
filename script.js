const container = document.getElementById('container');
const inputs = document.querySelectorAll('.capitalize-input');

inputs.forEach(input => {
    input.addEventListener('input', function (e) {
        let value = e.target.value;

        if (value.length > 0) {
            e.target.value = value.charAt(0).toUpperCase() + value.slice(1);
        }
    });
});

function admin_signin() {
    var email = document.getElementById("signin_email");
    var pw = document.getElementById("signin_password");

    var form = new FormData();
    form.append("email", email.value);
    form.append("pw", pw.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var resp = request.responseText;

            if (resp == "incomplete") {
                document.getElementById("loading_button2").classList.remove("d-none");
                document.getElementById("normal_button2").classList.add("d-none");
                setTimeout(() => {
                    container.classList.add("active");
                }, 2000);
            } else if (resp == "done") {
                document.getElementById("loading_button2").classList.remove("d-none");
                document.getElementById("normal_button2").classList.add("d-none");
                setTimeout(() => {
                    window.location = "dashboard.php";
                }, 2000);
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: "error",
                    text: resp,
                    theme: 'dark'
                });
            }
        }
    }

    request.open("POST", "admin-signin_process.php", true);
    request.send(form);
}

function admin_signup() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("mobile", mobile.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var resp = request.responseText;

            if (resp == "done") {
                document.getElementById("loading_button1").classList.remove("d-none");
                document.getElementById("normal_button1").classList.add("d-none");

                setTimeout(() => {
                    window.location = "dashboard.php";
                }, 2000);
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: "error",
                    text: resp,
                    theme: 'dark'
                });
            }
        }
    }

    request.open("POST", "admin-signup_process.php", true);
    request.send(form);
}

function admin_verification() {

    var email = document.getElementById("admin_email").value;

    document.getElementById("disabled_btn").classList.remove("d-none");
    document.getElementById("sendvc").classList.add("d-none");

    var f = new FormData();
    f.append("email", email);

    var r = new XMLHttpRequest();
    r.open("POST", "admin-forgot_password_process.php", true);
    r.send(f);

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var response = r.responseText;

            setTimeout(() => {

                document.getElementById("disabled_btn").classList.add("d-none");
                document.getElementById("sendvc").classList.remove("d-none");

                if (response == "done") {
                    document.getElementById("admin_email").disabled = true;
                    document.getElementById("sendvc").disabled = true;

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        theme: 'dark',
                        text: "Verification code has been sent successfully."
                    });
                    document.getElementById("vcode").focus();
                    document.getElementById("verify").disabled = false;
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: "error",
                        theme: 'dark',
                        text: response
                    });
                }

            }, 2000); // 2000ms = 2s
        }
    }

}

function admin_verify_vcode() {
    var email = document.getElementById("admin_email");
    var vcode = document.getElementById("vcode");

    document.getElementById("verify").classList.add("d-none");
    document.getElementById("verifying").classList.remove("d-none");

    var f = new FormData();
    f.append("email", email.value);
    f.append("vcode", vcode.value);

    var r = new XMLHttpRequest();
    r.open("POST", "admin-verify_vcode_process.php", true);
    r.send(f);

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var response = r.responseText;

            setTimeout(() => {

                document.getElementById("verify").classList.remove("d-none");
                document.getElementById("verifying").classList.add("d-none");

                if (response == "done") {
                    document.getElementById("vcode").disabled = true;
                    document.getElementById("verify").disabled = true;

                    var upDiv = document.getElementById("up");
                    upDiv.classList.remove("d-none");
                    void upDiv.offsetWidth;
                    upDiv.classList.add("show");

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        theme: 'dark',
                        text: "User has been verified successfully. You can now reset your password."
                    });

                    document.getElementById("newpw").focus();

                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: "error",
                        theme: 'dark',
                        text: response
                    });
                }

            }, 2000); // 2000ms = 2s
        }
    }
}

function admin_reset_password() {
    var new_pw = document.getElementById("newpw").value;
    var re_enter_pw = document.getElementById("re_enter_pw").value;
    var email = document.getElementById("admin_email").value;

    var f = new FormData();
    f.append("new_pw", new_pw);
    f.append("re_enter_pw", re_enter_pw);
    f.append("email", email);

    var r = new XMLHttpRequest();
    r.open("POST", "admin-reset_password_process.php", true);
    r.send(f);

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var resp = r.responseText;

            if (resp == "done") {

                document.getElementById("updating_pw").classList.remove("d-none");
                document.getElementById("update_pw").classList.add("d-none");

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: "success",
                    theme: 'dark',
                    text: "Your password has been changed successfully."
                });

                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: "error",
                    theme: 'dark',
                    text: resp
                });
            }
        }
    }
}