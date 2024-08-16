<?= include('./Include/DashBoardHeader.php');

?>
<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card shadow">
      <div class="card-body">
        <form enctype="multipart/form-data" action="../controller/UpdateProfile.php" method="POST">
          <div class="card-header text-center">
            <h2>Profile</h2>
            <div class="profile_img">
              <label for="avatar">
                <img src="<?= GetImage() ?>" class="rounded-circle w-px-100 ProfileImg" />
              </label>
              <input accept=".jpg,.png,.svg" type="file" id="avatar" name="ProfileImage" value="" class="d-none">
            </div>
          </div>

          <div class="mb-3 d-flex justify-content-center">
            <div class="w-50">
              <label for="">Your Name</label>
              <input type="text" name="username" id="" class="form-control my-3" value="<?= $_SESSION['auth']['username'] ?>" placeholder="Your Name" />
              <span class="text-danger"><?= $_SESSION['errors']['name_error'] ?? null ?></span>
              <br />
              <label for="">Your Email</label>
              <input type="email" name="email" id="" class="form-control my-3" value="<?= $_SESSION['auth']['email'] ?>" placeholder="Email" />
              <span class="text-danger"><?= $_SESSION['errors']['email_error'] ?? null ?></span>
              <br />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <button class="btn btn-primary">Update Profile</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card shadow">
    <div class="card-body">
      <form action="../controller/UpdatePassword.php" method="POST">
        <div class="head">
          <h4>Update Password</h4>
        </div>
        <label for="">Enter Current Password</label>
        <input type="password" name="old_password" class="form-control mt-5" />
        <span class="text-danger"><?= $_SESSION["errors"]["currentPasswordError"] ?? null ?></span>
        <label for="">Enter New Password</label>
        <input type="password" name="new_password" class="form-control mt-5"/>
        <span class="text-danger"><?= $_SESSION["errors"]["newPasswordError"] ?? null ?></span>
        <label for="">Enter Confirm Password</label>
        <input type="password" name="con_password" class="form-control mt-5"/>
        <span class="text-danger"><?= $_SESSION["errors"]["confirmPasswordError"] ?? null ?></span>
        <br />
        <button class="btn btn-primary">Update Password</button>
      </form>
    </div>
    </div>
  </div>


  <?=

  include('./Include/DashBoardFooter.php'); ?>


  <script>
    const ImageInput = document.querySelector('#avatar');
    const ProfileImage = document.querySelector('.ProfileImg');


    function ProfileImageUpdate(event) {

      ProfileImage.src = URL.createObjectURL(event.target.files[0]);

    }


    ImageInput.addEventListener('change', ProfileImageUpdate);
  </script>