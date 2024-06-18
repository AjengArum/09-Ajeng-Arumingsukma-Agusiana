<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            display: grid;
            place-items: center;
            gap: 50px;
            margin: 0;
            height: 100vh;
            padding: 0 32px;
            background: #eff9ff;
            font-family: "Euclid Circular A", "Poppins";
        }

        @media (width >= 500px) {
            body {
                padding: 0;
            }
        }

        .background {
            position: fixed;
            top: -50vmin;
            left: -50vmin;
            width: 10;
            height: 100vmin;
            border-radius: 47% 53% 61% 39% / 45% 51% 49% 55%;
            background: #65c8ff;
        }

        .background::after {
            content: "";
            position: inherit;
            right: -50vmin;
            bottom: -55vmin;
            width: inherit;
            height: inherit;
            border-radius: inherit;
            background: #143d81;
        }

        .card {
            overflow: hidden;
            position: relative;
            z-index: 3;
            width: 94%;
            margin: 0 20px;
            padding: 170px 30px 54px;
            border-radius: 24px;
            background: #ffffff;
            text-align: center;
            box-shadow: 0 100px 100px rgb(0 0 0 / 10%);
        }

        .card::before {
            content: "";
            position: absolute;
            top: -880px;
            left: 50%;
            translate: -50% 0;
            width: 1000px;
            height: 1000px;
            border-radius: 50%;
            background: #fff;
        }

        @media (width >= 500px) {
            .card {
                margin: 0;
                width: 360px;
            }
        }

        .card .logo {
            position: absolute;
            top: 30px;
            left: 50%;
            translate: -50% 0;
            width: 100px;
            height: 100px;
        }

        .card > h2 {
            font-size: 22px;
            font-weight: 400;
            margin: 0 0 38px;
            color: rgb(0 0 0 / 38%);
        }

        .form {
            margin: 0 0 44px;
            display: grid;
            gap: 12px;
        }

        .form :is(input, button) {
            width: 100%;
            height: 56px;
            border-radius: 28px;
            font-size: 16px;
            font-family: inherit;
        }

        .form > input {
            border: 0;
            padding: 0 24px;
            color: #222222;
            background: #ededed;
        }

        .form > input::placeholder {
            color: rgb(0 0 0 / 28%);
        }

        .form > button {
            border: 0;
            color: #f9f9f9;
            background: #2D3094;
            display: grid;
            place-items: center;
            font-weight: 500;
            cursor: pointer;
        }

        .card > footer {
            color: #a1a1a1;
        }

        .card > footer > a {
            color: #216ce7;
        }

    </style>
</head>

<!-- <script>
    function togglePassword() {
      var passwordInput = document.getElementById("password");
      var toggleIcon = document.getElementById("toggle-icon");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
      }
    }
  </script> -->
  
<body>
    <div class="background"></div>
    <div class="card">
        <img src="assets/file/logo_ku.png" alt="logo" class="logo" />
        <h2>Login</h2>
        <form class="form" method="post" action="<?php echo base_url('Auth/index'); ?>">
            <?= $this->session->flashdata('error'); ?>
            <input type="username" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>" />
            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
            <input type="password" id="password" name="password" placeholder="Password" />
            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="form-outline mb-4">
                <div class="form-check">
                    <input class="custom-checkbox" type="checkbox" value="" id="showPasswordCheckbox" />
                    <label class="form-check-label" for="showPasswordCheckbox">Show Password</label>
                </div>
            </div>
            
            <button type="submit">Login</button>
        </form>
        <footer>
            
        </footer>
    </div>
</body>
</html>