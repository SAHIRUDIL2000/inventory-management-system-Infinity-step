<?php
	session_start();
	
	// Check if user is already logged in
	if(isset($_SESSION['loggedIn'])){
		header('Location: index.php');
		exit();
	}
	
	require_once('inc/config/constants.php');
	require_once('inc/config/db.php');
	require_once('inc/header.html');
?>

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }

        .brand-name {
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            letter-spacing: 2px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.3s ease-in-out;
            animation: fadeIn 0.5s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .card-header {
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            color: white;
            text-align: center;
            padding: 15px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .form-group {
            margin-bottom: 1rem;
            position: relative;
        }

        .form-control {
            border-radius: 25px;
            padding: 10px 15px;
            background-color: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            color: black; /* Changed to black */
            transition: all 0.3s ease;
        }

        /* Before entering text - light blue */
        .form-control:not(:placeholder-shown) {
            background-color: rgba(173, 216, 230, 0.2);
            border-color: rgba(173, 216, 230, 0.5);
        }

        /* After entering text - light green */
        .form-control:valid {
            background-color: rgba(144, 238, 144, 0.2);
            border-color: rgba(144, 238, 144, 0.5);
        }

        /* Invalid/Error state - light red */
        .form-control:invalid {
            background-color: rgba(255, 182, 193, 0.2);
            border-color: rgba(255, 182, 193, 0.5);
        }

        .form-control:focus {
            background-color: rgba(255,255,255,0.2);
            border-color: #fff;
            box-shadow: 0 0 10px rgba(255,255,255,0.3);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6a11cb;
        }

        .btn {
            border-radius: 25px;
            padding: 10px 15px;
            margin: 5px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            border: none;
        }

        .btn-success {
            background: linear-gradient(to right, #00b09b, #96c93d);
            border: none;
        }

        .btn-warning {
            background: linear-gradient(to right, #ff8008, #ffc837);
            border: none;
        }

        .btn:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }

        .requiredIcon {
            color: red;
            margin-left: 4px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        label {
            color: white;
            font-weight: 500;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>

<?php
// Variable to store the action (login, register, passwordReset)
$action = '';
	if(isset($_GET['action'])){
		$action = $_GET['action'];
		if($action == 'register'){
?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-5 col-lg-5">
            <div class="login-container">
                <img src="logo.png" alt="Infinity Step Logo" class="logo-circle">
                <div class="brand-name">INFINITY STEP</div>
            </div>
            <div class="card">
              <div class="card-header">
                Register
              </div>
              <div class="card-body">
                <form action="" novalidate>
                <div id="registerMessage"></div>
                  <div class="form-group">
                    <label for="registerFullName">Name<span class="requiredIcon">*</span></label>
                    <input type="text" class="form-control" id="registerFullName" name="registerFullName" required placeholder="Enter your full name">
                  </div>
                   <div class="form-group">
                    <label for="registerUsername">Username<span class="requiredIcon">*</span></label>
                    <input type="email" class="form-control" id="registerUsername" name="registerUsername" autocomplete="on" required placeholder="Enter your email">
                  </div>
                  <div class="form-group position-relative">
                    <label for="registerPassword1">Password<span class="requiredIcon">*</span></label>
                    <input type="password" class="form-control" id="registerPassword1" name="registerPassword1" required placeholder="Enter password">
                    <span class="password-toggle" onclick="togglePassword('registerPassword1')">
                        <i class="fas fa-eye-slash" id="toggleRegisterPassword1"></i>
                    </span>
                  </div>
                  <div class="form-group position-relative">
                    <label for="registerPassword2">Re-enter password<span class="requiredIcon">*</span></label>
                    <input type="password" class="form-control" id="registerPassword2" name="registerPassword2" required placeholder="Confirm password">
                    <span class="password-toggle" onclick="togglePassword('registerPassword2')">
                        <i class="fas fa-eye-slash" id="toggleRegisterPassword2"></i>
                    </span>
                  </div>
                  <div class="button-container">
                    <a href="login.php" class="btn btn-primary">Login</a>
                    <button type="button" id="register" class="btn btn-success">Register</button>
                    <a href="login.php?action=resetPassword" class="btn btn-warning">Reset Password</a>
                    <button type="reset" class="btn">Clear</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
<?php
			require 'inc/footer.php';
			echo '</body></html>';
			exit();
		} elseif($action == 'resetPassword'){
?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-5 col-lg-5">
            <div class="login-container">
                <img src="logo.png" alt="Infinity Step Logo" class="logo-circle">
                <div class="brand-name">INFINITY STEP</div>
            </div>
            <div class="card">
              <div class="card-header">
                Reset Password
              </div>
              <div class="card-body">
                <form action="" novalidate>
                <div id="resetPasswordMessage"></div>
                  <div class="form-group">
                    <label for="resetPasswordUsername">Username</label>
                    <input type="text" class="form-control" id="resetPasswordUsername" name="resetPasswordUsername" required placeholder="Enter your username">
                  </div>
                  <div class="form-group position-relative">
                    <label for="resetPasswordPassword1">New Password</label>
                    <input type="password" class="form-control" id="resetPasswordPassword1" name="resetPasswordPassword1" required placeholder="Enter new password">
                    <span class="password-toggle" onclick="togglePassword('resetPasswordPassword1')">
                        <i class="fas fa-eye-slash" id="toggleResetPasswordPassword1"></i>
                    </span>
                  </div>
                  <div class="form-group position-relative">
                    <label for="resetPasswordPassword2">Re-enter Password</label>
                    <input type="password" class="form-control" id="resetPasswordPassword2" name="resetPasswordPassword2" required placeholder="Confirm new password">
                    <span class="password-toggle" onclick="togglePassword('resetPasswordPassword2')">
                        <i class="fas fa-eye-slash" id="toggleResetPasswordPassword2"></i>
                    </span>
                  </div>
                  <div class="button-container">
                    <a href="login.php" class="btn btn-primary">Login</a>
                    <a href="login.php?action=register" class="btn btn-success">Register</a>
                    <button type="button" id="resetPassword" class="btn btn-warning">Reset Password</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
<?php
			require 'inc/footer.php';
			echo '</body></html>';
			exit();
		}
	}
?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-5 col-lg-5">
            <div class="login-container">
                <img src="logo.png" alt="Infinity Step Logo" class="logo-circle">
                <div class="brand-name">INFINITY STEP</div>
            </div>
            <div class="card">
              <div class="card-header">
                Login
              </div>
              <div class="card-body">
                <form action="" novalidate>
                <div id="loginMessage"></div>
                  <div class="form-group">
                    <label for="loginUsername">Username</label>
                    <input type="text" class="form-control" id="loginUsername" name="loginUsername" required placeholder="Enter your username">
                  </div>
                  <div class="form-group position-relative">
                    <label for="loginPassword">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="loginPassword" required placeholder="Enter your password">
                    <span class="password-toggle" onclick="togglePassword('loginPassword')">
                        <i class="fas fa-eye-slash" id="toggleLoginPassword"></i>
                    </span>
                  </div>
                  <div class="button-container">
                    <button type="button" id="login" class="btn btn-primary">Login</button>
                    <a href="login.php?action=register" class="btn btn-success">Register</a>
                    
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById('toggle' + inputId.charAt(0).toUpperCase() + inputId.slice(1));
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>

<?php
	require 'inc/footer.php';
?>
