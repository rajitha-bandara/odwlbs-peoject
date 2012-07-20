<div  id="email_popup_content" style="display:none;">
 <div id="popup_user_login">            
    <div id="email_topic"></div>
    <form method="post" action="?action=sign_in" id="email_form">
<div class="control-group">
        <label class="control-label" for="input01">To</label>
            <div class="controls">
              <input type="text" class="input-large" id="txtTo" name="txtTo" value="<?php echo $to;?>">
            </div>
      </div>
          <div class="control-group">
            <label class="control-label" for="input01">Your Name</label>
            <div class="controls">
              <input type="text" class="input-large" id="txtU" name="txtU" value="">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="input01">Your Email Address</label>
            <div class="controls">
              <input type="text" class="input-large" id="txtU" name="txtU" value="">
            </div>
          </div>
          
          <div class="control-group">
              <div class="controls">
              <button class="btn btn-primary" name="btnSignIn" id="btnSignIn">Send</button>
            
              <button class="btn btn-primary" name="btnSignIn" id="btnSignIn">Cancel</button>
            </div>
          </div>
          
          <div class="clear"></div>
          <div id="sign_in_response"></div>
          </form>
          
    </div>
    		</div>