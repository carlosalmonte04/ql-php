<div class="main-wrapper">
  <div class="form-container">
    <h1>User Signup</h1>
    <form action="?controller=users&action=store" method="POST">
      <div>
        <label for="username">username</label>
        <input name="username" type="text">
      </div>
      <div>
        <label for="">password</label>
        <input name="password" type="password">
      </div>
      <div>
        <label for="">password confirmation</label>
        <input name="passwordConf" type="password">
      </div>
      <div>
        <input type="submit" class="login-btn" value="signup">
      </div>
    </form>
    <button class="login-btn" id="login-btn">login</button>
  </div>
</div>
<script>
  window.onload = function() {
    document.getElementById('login-btn').onclick = function(e) {
      e.preventDefault()
      window.location.href = '?controller=sessions&action=create'
    }
  }
</script>