<?php 
require_once('includes/captcha/recaptchalib.php');
$publickey = "6LdEAs8SAAAAAEzQCImC8bqa8ksihEhYgxpzaMin"; 
echo recaptcha_get_html($publickey);
?>