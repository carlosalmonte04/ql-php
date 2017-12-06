<div class="main-wrapper">
  <div class="form-container">
    <h1>Login</h1>
    <form action="?controller=sessions&action=store" method="POST">
      <span class="flash-message">
        <?php echo (isset($flash_message) ? $flash_message : null); ?>
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
    <button id="signup-btn" class="login-btn" style="height: 25px">signup</button>
  </div>
</div>
<script>
window.onload = function() {
  console.log("LOADED")
  document.getElementById('signup-btn').onclick = function(e) {
    console.log("HELLO")
    e.preventDefault()
    window.location.href = '?controller=users&action=create'
  }
}
</script>