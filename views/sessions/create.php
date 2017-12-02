<div class="main-wrapper">
  <div class="form-container">
    <h1>Tenant Login</h1>
    <form action="?controller=sessions&action=store" method="POST">
      <span class="flash-message">
        <?php echo ($flash_message ? $flash_message : null); ?>
      </span>
      <div>
        <label for="username">username</label>
        <input name="username" type="text">
      </div>
      <div>
        <label for="">password</label>
        <input name="password" type="password">
      </div>
      <div>
        <input type="submit" class="login-btn" value="login">
      </div>
    </form>
  </div>
</div>