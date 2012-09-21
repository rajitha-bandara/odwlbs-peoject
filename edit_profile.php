<?php
@session_start();
?>
<?php 
if ($_GET['id']) {
	
     $id = $_GET['id'];

} else if (isset($_SESSION['auth_id'])) {
	
	 $id = $_SESSION['auth_id'];

} else {
	
   include_once "deny_access.php";
   exit();
}
?>
<?php
require_once('includes/init.php');
?>
<?php
$username = "";
$password = "";
$email = "";
$fname = "";
$lname = "";
$street = "";
$city = "";
$country = "";
$zipcode = "";
$phone = "";
$description = "";

$id = mysql_real_escape_string($id);
$id = eregi_replace("`", "", $id);
$sql = mysql_query("SELECT * FROM lbs_user WHERE user_id= '$id' ");
// Make sure this person a visitor is trying to view actually exists
$existCount = mysql_num_rows($sql);
 if ($existCount < 1) 
{
	 $page_topic = "Unrecognized User!";
	 $msgToUser = "The user you are trying to access does not exist.";
	 require_once('msg_to_user.php');
     exit();
}


while($row = mysql_fetch_array($sql)){ 
	
	$username = $row["username"];
	$password = $row["password"];
	$email = $row["email"];
	$fname = $row["first_name"];
	$lname = $row["last_name"];
	$street = $row["street"];
	$city = $row["city"];
	$country = $row["country"];
	$zipcode = $row["zip_code"];
	$phone = $row["phone"];
	$description = $row["description"];
	
	$check_pic = "members/$logOptions_id/image01.jpg";
	$default_pic = "members/default.png";
	if (file_exists($check_pic))
	{
    	$profile_img = "<img src='$check_pic' width='100px' height= '100px' />"; 
	} else 
	{
		$profile_img = "<img src='$default_pic' width='100px' height= '100px' />";
	}

} 
?>
<?php
require_once('includes/process_edit_profile.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Places.com Edit Profile::<?php print "$logOptions_username"?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Le styles -->
<link href="public/css/bootstrap.css" rel="stylesheet">
<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/960_24_col.css" rel="stylesheet">
<link href="public/css/reset.css" rel="stylesheet">
<link href="public/css/style.css" rel="stylesheet">
<link href="public/css/profile.css" rel="stylesheet" type="text/css">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="public/js/html5.js"></script>
    <![endif]-->
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="public/icons/favicon.ico">
<script src="public/js/jquery.js"></script>
<script src="public/js/bpopup-0.6.0.min.js"></script>
<script src="public/js/functions.js"></script>
</head>
<body>
<?php require_once('includes/geo_location_all.php');?>
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <?php require('templates/profile_left_column.php');?>
  <div id="profile_body" class="grid_12">
    <h1 id="profile_page_topic">Edit Profile Info</h1>
    <table width="500" border="0" cellspacing="0" cellpadding="0" id="profile_details_table">
      <form action="" enctype="multipart/form-data" method="post" name="pic1_form" id="pic1_form">
        <tr>
          <td width="173" style="padding-left:20px;">User Name</td>
          <td width="327"><input type="text" class="span3" name="txtuname" id="username" value="<?php print "$username"; ?>" size="10" maxlength="32" /></td>
        </tr>
        <tr>
          <td width="173" style="padding-left:20px;">First Name 
          <td width="327"><input type="text" class="span3" name="txtfname" id="" value="<?php print "$fname"; ?>" size="10" maxlength="32" /></td>
        </tr>
        <tr>
          <td width="173" style="padding-left:20px;">Last Name</td>
          <td width="327"><input type="text" class="span3" name="txtlname" id="lastname" value="<?php print "$lname"; ?>" size="10" maxlength="32" /></td>
        </tr>
        <tr>
        <tr>
          <td width="173" style="padding-left:20px;">Profile image</td>
          <td width="328"><input name="fileField" type="file">
            100kb max</td>
        </tr>
        </tr>
        
        <tr>
          <td width="173" style="padding-left:20px;">Country</td>
          <td width="327"><select name="listcountry" class="formFields">
              <option value="<?php print "$country"; ?>"><?php print "$country"; ?></option>
              <option value="United States of America">United States of America</option>
              <option value="Afghanistan">Afghanistan</option>
              <option value="Albania">Albania</option>
              <option value="Algeria">Algeria</option>
              <option value="American Samoa">American Samoa</option>
              <option value="Andorra">Andorra</option>
              <option value="Angola">Angola</option>
              <option value="Anguilla">Anguilla</option>
              <option value="Antigua and Barbuda">Antigua and Barbuda</option>
              <option value="Argentina">Argentina</option>
              <option value="Armenia">Armenia</option>
              <option value="Aruba">Aruba</option>
              <option value="Australia">Australia</option>
              <option value="Austria">Austria</option>
              <option value="Azerbaijan">Azerbaijan</option>
              <option value="Bahamas">Bahamas</option>
              <option value="Bahrain">Bahrain</option>
              <option value="Bangladesh">Bangladesh</option>
              <option value="Barbados">Barbados</option>
              <option value="Belarus">Belarus</option>
              <option value="Belgium">Belgium</option>
              <option value="Belize">Belize</option>
              <option value="Benin">Benin</option>
              <option value="Bermuda">Bermuda</option>
              <option value="Bhutan">Bhutan</option>
              <option value="Bolivia">Bolivia</option>
              <option value="Bonaire">Bonaire</option>
              <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
              <option value="Botswana">Botswana</option>
              <option value="Brazil">Brazil</option>
              <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
              <option value="Brunei">Brunei</option>
              <option value="Bulgaria">Bulgaria</option>
              <option value="Burkina Faso">Burkina Faso</option>
              <option value="Burundi">Burundi</option>
              <option value="Cambodia">Cambodia</option>
              <option value="Cameroon">Cameroon</option>
              <option value="Canada">Canada</option>
              <option value="Canary Islands">Canary Islands</option>
              <option value="Cape Verde">Cape Verde</option>
              <option value="Cayman Islands">Cayman Islands</option>
              <option value="Central African Republic">Central African Republic</option>
              <option value="Chad">Chad</option>
              <option value="Channel Islands">Channel Islands</option>
              <option value="Chile">Chile</option>
              <option value="China">China</option>
              <option value="Christmas Island">Christmas Island</option>
              <option value="Cocos Island">Cocos Island</option>
              <option value="Columbia">Columbia</option>
              <option value="Comoros">Comoros</option>
              <option value="Congo">Congo</option>
              <option value="Cook Islands">Cook Islands</option>
              <option value="Costa Rica">Costa Rica</option>
              <option value="Cote D'Ivoire">Cote D'Ivoire</option>
              <option value="Croatia">Croatia</option>
              <option value="Cuba">Cuba</option>
              <option value="Curacao">Curacao</option>
              <option value="Cyprus">Cyprus</option>
              <option value="Czech Republic">Czech Republic</option>
              <option value="Denmark">Denmark</option>
              <option value="Djibouti">Djibouti</option>
              <option value="Dominica">Dominica</option>
              <option value="Dominican Republic">Dominican Republic</option>
              <option value="East Timor">East Timor</option>
              <option value="Ecuador">Ecuador</option>
              <option value="Egypt">Egypt</option>
              <option value="El Salvador">El Salvador</option>
              <option value="Equatorial Guinea">Equatorial Guinea</option>
              <option value="Eritrea">Eritrea</option>
              <option value="Estonia">Estonia</option>
              <option value="Ethiopia">Ethiopia</option>
              <option value="Falkland Islands">Falkland Islands</option>
              <option value="Faroe Islands">Faroe Islands</option>
              <option value="Fiji">Fiji</option>
              <option value="Finland">Finland</option>
              <option value="France">France</option>
              <option value="French Guiana">French Guiana</option>
              <option value="French Polynesia">French Polynesia</option>
              <option value="French Southern Ter">French Southern Ter</option>
              <option value="Gabon">Gabon</option>
              <option value="Gambia">Gambia</option>
              <option value="Georgia">Georgia</option>
              <option value="Germany">Germany</option>
              <option value="Ghana">Ghana</option>
              <option value="Gibraltar">Gibraltar</option>
              <option value="Great Britain">Great Britain</option>
              <option value="Greece">Greece</option>
              <option value="Greenland">Greenland</option>
              <option value="Grenada">Grenada</option>
              <option value="Guadeloupe">Guadeloupe</option>
              <option value="Guam">Guam</option>
              <option value="Guatemala">Guatemala</option>
              <option value="Guinea">Guinea</option>
              <option value="Guyana">Guyana</option>
              <option value="Haiti">Haiti</option>
              <option value="Hawaii">Hawaii</option>
              <option value="Honduras">Honduras</option>
              <option value="Hong Kong">Hong Kong</option>
              <option value="Hungary">Hungary</option>
              <option value="Iceland">Iceland</option>
              <option value="India">India</option>
              <option value="Indonesia">Indonesia</option>
              <option value="Iran">Iran</option>
              <option value="Iraq">Iraq</option>
              <option value="Ireland">Ireland</option>
              <option value="Isle of Man">Isle of Man</option>
              <option value="Israel">Israel</option>
              <option value="Italy">Italy</option>
              <option value="Jamaica">Jamaica</option>
              <option value="Japan">Japan</option>
              <option value="Jordan">Jordan</option>
              <option value="Kazakhstan">Kazakhstan</option>
              <option value="Kenya">Kenya</option>
              <option value="Kiribati">Kiribati</option>
              <option value="Korea North">Korea North</option>
              <option value="Korea South">Korea South</option>
              <option value="Kuwait">Kuwait</option>
              <option value="Kyrgyzstan">Kyrgyzstan</option>
              <option value="Laos">Laos</option>
              <option value="Latvia">Latvia</option>
              <option value="Lebanon">Lebanon</option>
              <option value="Lesotho">Lesotho</option>
              <option value="Liberia">Liberia</option>
              <option value="Libya">Libya</option>
              <option value="Liechtenstein">Liechtenstein</option>
              <option value="Lithuania">Lithuania</option>
              <option value="Luxembourg">Luxembourg</option>
              <option value="Macau">Macau</option>
              <option value="Macedonia">Macedonia</option>
              <option value="Madagascar">Madagascar</option>
              <option value="Malaysia">Malaysia</option>
              <option value="Malawi">Malawi</option>
              <option value="Maldives">Maldives</option>
              <option value="Mali">Mali</option>
              <option value="Malta">Malta</option>
              <option value="Marshall Islands">Marshall Islands</option>
              <option value="Martinique">Martinique</option>
              <option value="Mauritania">Mauritania</option>
              <option value="Mauritius">Mauritius</option>
              <option value="Mayotte">Mayotte</option>
              <option value="Mexico">Mexico</option>
              <option value="Midway Islands">Midway Islands</option>
              <option value="Moldova">Moldova</option>
              <option value="Monaco">Monaco</option>
              <option value="Mongolia">Mongolia</option>
              <option value="Montserrat">Montserrat</option>
              <option value="Morocco">Morocco</option>
              <option value="Mozambique">Mozambique</option>
              <option value="Myanmar">Myanmar</option>
              <option value="Nambia">Nambia</option>
              <option value="Nauru">Nauru</option>
              <option value="Nepal">Nepal</option>
              <option value="Netherland Antilles">Netherland Antilles</option>
              <option value="Netherlands">Netherlands</option>
              <option value="Nevis">Nevis</option>
              <option value="New Caledonia">New Caledonia</option>
              <option value="New Zealand">New Zealand</option>
              <option value="Nicaragua">Nicaragua</option>
              <option value="Niger">Niger</option>
              <option value="Nigeria">Nigeria</option>
              <option value="Niue">Niue</option>
              <option value="Norfolk Island">Norfolk Island</option>
              <option value="Norway">Norway</option>
              <option value="Oman">Oman</option>
              <option value="Pakistan">Pakistan</option>
              <option value="Palau Island">Palau Island</option>
              <option value="Palestine">Palestine</option>
              <option value="Panama">Panama</option>
              <option value="Papua New Guinea">Papua New Guinea</option>
              <option value="Paraguay">Paraguay</option>
              <option value="Peru">Peru</option>
              <option value="Philippines">Philippines</option>
              <option value="Pitcairn Island">Pitcairn Island</option>
              <option value="Poland">Poland</option>
              <option value="Portugal">Portugal</option>
              <option value="Puerto Rico">Puerto Rico</option>
              <option value="Qatar">Qatar</option>
              <option value="Reunion">Reunion</option>
              <option value="Romania">Romania</option>
              <option value="Russia">Russia</option>
              <option value="Rwanda">Rwanda</option>
              <option value="St Barthelemy">St Barthelemy</option>
              <option value="St Eustatius">St Eustatius</option>
              <option value="St Helena">St Helena</option>
              <option value="St Kitts-Nevis">St Kitts-Nevis</option>
              <option value="St Lucia">St Lucia</option>
              <option value="St Maarten">St Maarten</option>
              <option value="St Pierre and Miquelon">St Pierre and Miquelon</option>
              <option value="St Vincent and Grenadines">St Vincent and Grenadines</option>
              <option value="Saipan">Saipan</option>
              <option value="Samoa">Samoa</option>
              <option value="Samoa American">Samoa American</option>
              <option value="San Marino">San Marino</option>
              <option value="Sao Tome and Principe">Sao Tome and Principe</option>
              <option value="Saudi Arabia">Saudi Arabia</option>
              <option value="Senegal">Senegal</option>
              <option value="Seychelles">Seychelles</option>
              <option value="Serbia and Montenegro">Serbia and Montenegro</option>
              <option value="Sierra Leone">Sierra Leone</option>
              <option value="Singapore">Singapore</option>
              <option value="Slovakia">Slovakia</option>
              <option value="Slovenia">Slovenia</option>
              <option value="Solomon Islands">Solomon Islands</option>
              <option value="Somalia">Somalia</option>
              <option value="South Africa">South Africa</option>
              <option value="Spain">Spain</option>
              <option value="Sri Lanka">Sri Lanka</option>
              <option value="Sudan">Sudan</option>
              <option value="Suriname">Suriname</option>
              <option value="Swaziland">Swaziland</option>
              <option value="Sweden">Sweden</option>
              <option value="Switzerland">Switzerland</option>
              <option value="Syria">Syria</option>
              <option value="Tahiti">Tahiti</option>
              <option value="Taiwan">Taiwan</option>
              <option value="Tajikistan">Tajikistan</option>
              <option value="Tanzania">Tanzania</option>
              <option value="Thailand">Thailand</option>
              <option value="Togo">Togo</option>
              <option value="Tokelau">Tokelau</option>
              <option value="Tonga">Tonga</option>
              <option value="Trinidad and Tobago">Trinidad and Tobago</option>
              <option value="Tunisia">Tunisia</option>
              <option value="Turkey">Turkey</option>
              <option value="Turkmenistan">Turkmenistan</option>
              <option value="Turks and Caicos Is">Turks and Caicos Is</option>
              <option value="Tuvalu">Tuvalu</option>
              <option value="Uganda">Uganda</option>
              <option value="Ukraine">Ukraine</option>
              <option value="United Arab Emirates">United Arab Emirates</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="United States of America">United States of America</option>
              <option value="Uruguay">Uruguay</option>
              <option value="Uzbekistan">Uzbekistan</option>
              <option value="Vanuatu">Vanuatu</option>
              <option value="Vatican City State">Vatican City State</option>
              <option value="Venezuela">Venezuela</option>
              <option value="Vietnam">Vietnam</option>
              <option value="Virgin Islands (Brit)">Virgin Islands Brit</option>
              <option value="Virgin Islands (USA)">Virgin Islands USA</option>
              <option value="Wake Island">Wake Island</option>
              <option value="Wallis and Futana Is">Wallis and Futana Is</option>
              <option value="Yemen">Yemen</option>
              <option value="Zaire">Zaire</option>
              <option value="Zambia">Zambia</option>
              <option value="Zimbabwe">Zimbabwe</option>
            </select>
            &nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td width="173" style="padding-left:20px;">City</td>
          <td width="327"><input type="text" class="span3" name="txtcity" id="city" value="<?php print "$city"; ?>" size="10" maxlength="32" /></td>
        </tr>
        <tr>
          <td width="173" style="padding-left:20px;">Street</td>
          <td width="327"><input type="text" class="span3" name="txtstreet" id="street" value="<?php print "$street"; ?>" size="10" maxlength="32" /></td>
        </tr>
        <tr>
          <td width="173" style="padding-left:20px;">Phone</td>
          <td width="327"><input type="text" class="span3" name="txtphone" id="phone" value="<?php print "$phone"; ?>" size="10" maxlength="32" /></td>
        </tr>
        <tr>
          <td width="173" style="padding-left:20px;">Zip Code</td>
          <td width="327"><input type="text" class="span3" name="txtzip" id="zip" value="<?php print "$zipcode"; ?>" size="10" maxlength="32" /></td>
        </tr>
        <tr>
          <td width="173" style="padding-left:20px;">Description</td>
          <td width="327"><textarea name="txtdescription" cols="1" rows="5"></textarea></td>
        </tr>
        <tr>
          <td width="173" style="padding-left:20px;"></td>
          <td width="327"></td>
        </tr>
        <tr>
          <td width="173" style="padding-left:20px;"></td>
          <td width="327"><button type="submit" name="btnupdate" class="btn btn-primary">Update</button></td>
        </tr>
      </form>
    </table>
    <div id="resultBox"><?php echo $msg;?></div>
  </div>
  <div class="grid_6">
    <?php require_once('templates/right_column.php');?>
  </div>
  <div class="clear"></div>
  <?php require_once('templates/footer.php');?>
</div>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/js/uservoice_feedback.js"></script>
</body>
</html>