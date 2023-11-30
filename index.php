<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="shortcut icon" href="assets/favicon/complaint.ico" type="image/x-icon" />
  <title>SC-CMS</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="partials/login.php" class="sign-in-form" method="post">
          <img src="assets/img/logo.png" alt="" srcset="" height="200px" />
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="registered-email" id="email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="registered-password" id="password" required />

          </div>
          <div class="input-field">
            <i class="fas fa-key"></i>
            <input type="password" placeholder="Badge number(Police Staff only)" name="badge_number" id="badge_number" />
          </div>
          <input type="submit" value="Login" class="btn solid" />
        </form>
        <form action="partials/login.php" class="sign-up-form" method="post">
          <img src="assets/img/logo.png" alt="" srcset="" height="200px" />
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="email" id="email" required />
            <span class="eye-icon" onclick="togglePasswordVisibility()">
              <img id="eye-image" src="./assets/img/eye.png" height="20" alt="Toggle Password Visibility" />
            </span>
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" id="password" required />

          </div>
          <input type="submit" class="btn" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <p1>SC-CMS</p1>
          <h3>New here ?</h3>
          <p>
            Ready to be heard? Sign up to SC-CMS now and let's address your
            concerns promptly and professionally.
          </p>
          <button class="btn transparent" id="sign-up-btn">Sign up</button>
        </div>
        <img src="assets/img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <p1>SC-CMS</p1>
          <h3>One of us ?</h3>
          <p>
            Empower justice at your fingertips with SC-CMS – South Cotabato's
            cutting-edge Complaint and Monitoring System. Your voice, our
            priority – report seamlessly for a safer community.
          </p>
          <button class="btn transparent" id="sign-in-btn">Sign in</button>
        </div>

        <img src="assets/img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>
  <script>
    const sign_in_btn = document.querySelector('#sign-in-btn');
    const sign_up_btn = document.querySelector('#sign-up-btn');
    const container = document.querySelector('.container');

    sign_up_btn.addEventListener('click', () => {
      container.classList.add('sign-up-mode');
    });

    sign_in_btn.addEventListener('click', () => {
      container.classList.remove('sign-up-mode');
    });

  </script>

</body>

</html>