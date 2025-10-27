<?php
class forms {

    private function submit_button($value, $name) {
        ?>
        <button type="submit" class="btn btn-primary" name="<?php echo $name; ?>" value="<?php echo $value; ?>"><?php echo $value; ?></button>
        <?php
    }

    public function signup() {
      global $conf, $ObjFncs;
      $err = $ObjFncs->getMsg('errors'); print $ObjFncs->getMsg('msg');
    ?>
<h1>Sign Up</h1>
<form action="" method="post" autocomplete="off">
  <div class="mb-3">
    <label for="fullname" class="form-label">Fullname</label>
    <input type="text" class="form-control" id="fullname" name="fullname" aria-describedby="nameHelp" maxlength="50" value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?>" placeholder="Enter your fullname" required>
    <?php print (isset($err['nameFormat_error']) ? '<div id="nameHelp" class="alert alert-danger">'.$err['nameFormat_error'].'</div>' : ''); ?>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" maxlength="100" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" placeholder="Enter your email" required>
    <?php print (isset($err['mailFormat_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['mailFormat_error'].'</div>' : ''); ?>
    <?php print (isset($err['emailDomain_error']) ? '<div id="nameHelp" class="alert alert-danger">'.$err['emailDomain_error'].'</div>' : ''); ?>
    <?php print (isset($err['emailExists_error']) ? '<div id="nameHelp" class="alert alert-danger">'.$err['emailExists_error'].'</div>' : ''); ?>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>" placeholder="Enter your password" required>
    <?php print (isset($err['passwordLength_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['passwordLength_error'].'</div>' : ''); ?>
    <?php print (isset($err['passwordComplexity_error']) ? '<div id="nameHelp" class="alert alert-danger">'.$err['passwordComplexity_error'].'</div>' : ''); ?>
    <input type="hidden" name="origin" value="<?php print basename($_SERVER['PHP_SELF']); ?>">
  </div>
          <?php $this->submit_button("Sign Up", "signup"); ?> Already have an account? <a href="signin.php">Sign In</a>
</form>

<?php
    }

    public function verify_code() {
      global $conf, $ObjFncs;
      $err = $ObjFncs->getMsg('errors'); print $ObjFncs->getMsg('msg');
        ?>
    <h1>Code Verification</h1>
    <form action="" method="post" autocomplete="off">
      <div class="mb-3">
        <label for="verification_code" class="form-label">Verification Code</label>
        <input type="number" class="form-control" id="verification_code" name="verification_code" maxlength="6" placeholder="Enter your verification code" required>
        <?php print (isset($err['code_error']) ? '<div id="codeHelp" class="alert alert-danger">'.$err['code_error'].'</div>' : ''); ?>
        <?php print (isset($_SESSION['verification_code']) ? '<div id="codeHelp" class="alert alert-danger">'.$_SESSION['verification_code'].'</div>' : ''); ?>
        <?php print (isset($err['codeFormat_error']) ? '<div id="codeHelp" class="alert alert-danger">'.$err['codeFormat_error'].'</div>' : ''); ?>
      </div>
      <?php $this->submit_button("Verify Code", "verify_code"); ?> Can't verify? <a href="forgot_password.php">Resend code</a>
    </form>
    <?php
    }

    public function forgot_password() {
      global $conf, $ObjFncs;
      $err = $ObjFncs->getMsg('errors'); print $ObjFncs->getMsg('msg');
        ?>
    <h1>Forgot Password</h1>
    <form action="" method="post" autocomplete="off">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
        <?php print (isset($err['mailFormat_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['mailFormat_error'].'</div>' : ''); ?>
        <?php print (isset($err['emailNotFound_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['emailNotFound_error'].'</div>' : ''); ?>
        <input type="hidden" name="origin" value="<?php print basename($_SERVER['PHP_SELF']); ?>">
      </div>
      <?php $this->submit_button("Send Code", "send_code"); ?> Dont have an account? <a href="signup.php">Sign up</a>
    </form>
    <?php
    }
public function change_password() {
      global $conf, $ObjFncs;
      $err = $ObjFncs->getMsg('errors'); print $ObjFncs->getMsg('msg');
        ?>
    <h1>Change Password</h1>
    <form action="" method="post" autocomplete="off">
      
      <?php if(isset($_SESSION['origin']) && $_SESSION['origin'] == 'forgot_password.php') { ?>
      <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password" value="<?php echo isset($_SESSION['current_password']) ? $_SESSION['current_password'] : ''; ?>" required>
        <?php print (isset($err['currentPassword_error']) ? '<div id="currentPasswordHelp" class="alert alert-danger">'.$err['currentPassword_error'].'</div>' : ''); ?>
      </div>
      <?php } ?>
      <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password" value="<?php echo isset($_SESSION['new_password']) ? $_SESSION['new_password'] : ''; ?>" required>
        <?php print (isset($err['newPassword_error']) ? '<div id="newPasswordHelp" class="alert alert-danger">'.$err['newPassword_error'].'</div>' : ''); ?>
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo isset($_SESSION['confirm_password']) ? $_SESSION['confirm_password'] : ''; ?>" required>
        <?php print (isset($err['confirmPassword_error']) ? '<div id="confirmPasswordHelp" class="alert alert-danger">'.$err['confirmPassword_error'].'</div>' : ''); ?>
      </div>
      <?php $this->submit_button("Change Password", "change_password"); ?> Remembered your password? <a href="signin.php">Sign In</a>
    </form>
    <?php
    }

    public function signin() {
      global $conf, $ObjFncs;
      $err = $ObjFncs->getMsg('errors'); print $ObjFncs->getMsg('msg');
        ?>
    <h1>Sign In</h1>
    <form action="" method="post" autocomplete="off">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" maxlength="100" placeholder="Enter your email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
        <?php print (isset($err['mailFormat_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['mailFormat_error'].'</div>' : ''); ?>
        <?php print (isset($err['emailNotFound_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['emailNotFound_error'].'</div>' : ''); ?>
        <?php print (isset($err['accountInactive_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['accountInactive_error'].'</div>' : ''); ?>
        <?php print (isset($err['accountSuspended_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['accountSuspended_error'].'</div>' : ''); ?>
        <?php print (isset($err['accountDeleted_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['accountDeleted_error'].'</div>' : ''); ?>
        <?php print (isset($err['invalidCredentials_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['invalidCredentials_error'].'</div>' : ''); ?>
        <?php print (isset($err['userNotFound_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['userNotFound_error'].'</div>' : ''); ?>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Enter your password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>" required>
        <?php print (isset($err['passwordFormat_error']) ? '<div id="passwordHelp" class="alert alert-danger">'.$err['passwordFormat_error'].'</div>' : ''); ?>
        <?php print (isset($err['invalidCredentials_error']) ? '<div id="passwordHelp" class="alert alert-danger">'.$err['invalidCredentials_error'].'</div>' : ''); ?>
        <?php print (isset($err['userNotFound_error']) ? '<div id="passwordHelp" class="alert alert-danger">'.$err['userNotFound_error'].'</div>' : ''); ?>
        <?php print (isset($err['invalidLogin_error']) ? '<div id="passwordHelp" class="alert alert-danger">'.$err['invalidLogin_error'].'</div>' : ''); ?>
        <input type="hidden" name="origin" value="<?php print basename($_SERVER['PHP_SELF']); ?>">

      </div>
        <?php $this->submit_button("Sign In", "signin"); ?> Don't have an account? <a href="signup.php">Sign up</a> Or <a href="forgot_password.php">Reset password</a>
    </form>
        <?php
    }


private function clean_date_input($date_input) {
        // Remove any unwanted characters (basic sanitization)
// $input = "D:20110303120738+01'00'";

// verify if the string had a D: prefix
if (substr($date_input, 0, 2) !== 'D:') {
    // If not, return the original string or handle the error as needed
    return $date_input;
}else{
// Step 1: Remove the "D:" prefix
$cleaned = substr($date_input, 2);

// Step 2: Replace the timezone format from +01'00' to +0100
$cleaned = preg_replace("/([+-]\d{2})'(\d{2})'/", "$1$2", $cleaned);

// Step 3: Create a DateTime object
$date = DateTime::createFromFormat("YmdHisO", $cleaned);

// Step 4: Convert to Unix timestamp
$timestamp = $date->getTimestamp();

  // If it had a D: prefix, return the formatted date
    return date('Y-m-d H:i:s', $timestamp);
}
    }
    public function edit_file_meta(){
      global $conf, $ObjFncs, $SQL;
      $err = $ObjFncs->getMsg('errors'); print $ObjFncs->getMsg('msg');
      $repoId = isset($_GET['id']) ? intval($_GET['id']) : 0;
      $repo = $SQL->select(sprintf("SELECT * FROM repository WHERE Id = %d", $repoId));
      if(!$repo){
        echo "<div class='alert alert-danger'>Repository not found.</div>";
        return;
      }else{
        ?>
<h1>Edit Repository - <?php echo htmlspecialchars($repo['Id']) . ' - ' . htmlspecialchars($repo['updated_at']); ?></h1>
<form action="" method="post" autocomplete="off">
  <div class="mb-3">
    <label for="FileName" class="form-label">File Name</label>
    <textarea class="form-control" id="FileName" name="FileName" aria-describedby="nameHelp"  placeholder="Enter repository name" value="FileName" required><?php echo $repo['FileName']; ?></textarea>
    <?php print (isset($err['repoName_error']) ? '<div id="nameHelp" class="alert alert-danger">'.$err['repoName_error'].'</div>' : ''); ?>
  </div>

  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <textarea class="form-control" id="title" name="Title" aria-describedby="descriptionHelp" placeholder="Enter File Title" value="Title" required><?php echo $repo['Title']; ?></textarea>
    <?php print (isset($err['repoDescription_error']) ? '<div id="descriptionHelp" class="alert alert-danger">'.$err['repoDescription_error'].'</div>' : ''); ?>
  </div>

  <div class="mb-3">
    <label for="Author" class="form-label">Author</label>
    <textarea class="form-control" id="Author" name="Author" aria-describedby="AuthorHelp" placeholder="Enter File author" value="Author" required><?php echo $repo['Author']; ?></textarea>
    <?php print (isset($err['repoAuthor_error']) ? '<div id="AuthorHelp" class="alert alert-danger">'.$err['repoAuthor_error'].'</div>' : ''); ?>
  </div>

  <div class="mb-3">
    <label for="CreationDate" class="form-label">CreationDate</label>
    <textarea class="form-control" id="CreationDate" name="CreationDate" aria-describedby="CreationDateHelp" placeholder="Enter File year of publication" value="CreationDate" required><?php if(!empty($repo['CreationDate'])) { print $this->clean_date_input($repo['CreationDate']); }else{ print 'Unknown ' . date('Y-m-d H:i:s'); } ?></textarea>
    <?php print (isset($err['repoCreationDate_error']) ? '<div id="CreationDateHelp" class="alert alert-danger">'.$err['repoCreationDate_error'].'</div>' : ''); ?>
  </div>

  <div class="mb-3">
    <label for="ModDate" class="form-label">ModDate</label>
    <textarea class="form-control" id="ModDate" name="ModDate" aria-describedby="ModDateHelp" placeholder="Enter File year of publication" value="ModDate" required><?php if(!empty($repo['ModDate'])) { print $this->clean_date_input($repo['ModDate']); }else{ print 'Unknown ' . date('Y-m-d H:i:s'); } ?></textarea>
    <?php print (isset($err['repoModDate_error']) ? '<div id="ModDateHelp" class="alert alert-danger">'.$err['repoModDate_error'].'</div>' : ''); ?>
  </div>

          <?php $this->submit_button("Update Repository - ".$repoId, "update_file_meta"); ?>
          <input type="hidden" name="repoId" value="<?php echo $repoId; ?>">  <a href="repository.php">Back to Repository List</a>
</form>
        <?php
      }
    }
    }
