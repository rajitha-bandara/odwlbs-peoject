
<div  id="login_popup_content" style="display:none;">
            <div id="popup_user_login">
            
    <div id="right_column_topic">Sign in</div>
    <form method="post" action="?action=sign_in" id="sign_in">
<div class="control-group">
        <label class="control-label" for="input01">Username</label>
            <div class="controls">
              <input type="text" class="input-large" id="txtUname" name="txtUname" value="<?php echo $username;?>">
            </div>
      </div>
          <div class="control-group">
            <label class="control-label" for="input01">Password</label>
            <div class="controls">
              <input type="password" class="input-large" id="txtPass" name="txtPass" value="">
            </div>
          </div>
          
          <div class="control-group">
              <div class="controls">
              <input type="checkbox" id="cbRemeber" name="cbRemeber" value="<?php echo $remember;?>">&nbsp; Remember Me
            </div>
          </div>
          
          <div class="control-group">
              <div class="controls">
              <button class="btn btn-primary" name="btnSignIn" id="btnSignIn">Sign in</button>
            </div>
          </div>
          <a href="forgot_password.php">Forgot Password?</a>
          <div class="clear"></div>
          <div id="sign_in_response"></div>
          </form>
          
    </div>
    		</div>