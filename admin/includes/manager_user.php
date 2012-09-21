<?php
require_once('../../includes/init.php');

global $guserObj;
$userObj = "";
$id = isset($_GET['id']) ? ($_GET['id']) : false;
	
if($id){
   	
	if($guserObj->fetchUserObj($id) != false)
	{
		$userObj = $guserObj->fetchUserObj($id);
	}
	else
	{
		echo'Data not found';
	}
}
?>
<?php
if(isset($_POST['btnAdd']))
	{
	  $uname = $_POST['uname'];
      $pw = $_POST['password'];
      $email = $_POST['email'];
	  
	  global $guserObj;
	  $guserObj->set_basic_vars($uname,$pw,$email);
      $res = $guserObj->create();
	  if($res)
	  {
		  $msg = "ok";
	  }
	  else
	  {
		  echo "no";
	  }
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link rel="stylesheet" href="css/val.css" type="text/css" />
  
  <script type="text/javascript">
		$(document).ready(function() {
			$("#form1").validate({
				rules: {
				  uname: "required",
				  zip: {
          	 		number: true
					
          		  },
				 phone: {
          	 		number: true
					
          		  },
				  
				  password: {
          	 required: true,
					   minlength: 4
          },		
			     cpassword:
			     {
				      required: true,
				      equalTo: "#password"
			     },
					email: {				
						required: true,
						email: true
					},
					website: {
        	  required: true,
						url: true
					}
				},
			
      	messages: { 
			    uname: {
				    required: '. Username required'
			    },
				
			   
			    password: {
				    required : '. Password required',
				    minlength: '. Password should have 4 or more letters'
			    },
			    cpassword: {
				    required: '. Confirm Password required',
				    equalTo : '. Passwords mismatch'
			    },
			    email: {
				    required: '. Email is required',
				    email   : '. Invalid Email'
			    },
				zip: {
				    number: '. Invalid postal code'
				    
			    },
				phone: {
				    number: '. Invalid phone no'
				    
			    },
			    website: {
				    required: '. Website harus di isi',
				    url     : '. Alamat website harus valid'
			    }
			   },
         
         success: function(label) {
            label.text('OK!').addClass('valid');
         }
			});
		});		
	</script>
    
    <script type="text/javascript">
		$(document).ready(function() {
			$("#form2").validate({
				rules: {
				  uid: "required",
				  uname: "required",
				    zip: {
          	 		number: true
					
          		  },
				    phone: {
          	 		number: true
					
          		  },
					email: {				
						required: true,
						email: true
					},
					website: {
        	  required: true,
						url: true
					}
				},
			
      	messages: { 
				uid: {
				    required: '. User ID required'
			    },
			    uname: {
				    required: '. Username required'
			    },
				
			    email: {
				    required: '. Email is required',
				    email   : '. Invalid Email'
			    },
				zip: {
				    number: '. Invalid postal code'
				    
			    },
				phone: {
				    number: '. Invalid phone no'
				    
			    },
			    website: {
				    required: '. Website harus di isi',
				    url     : '. Alamat website harus valid'
			    }
			   },
         
         success: function(label) {
            label.text('OK!').addClass('valid');
         }
			});
		});		
	</script>
	<!--<script type="text/javascript" src="js/ui/ui.core.js"></script>
    <script type="text/javascript" src="js/ui/ui.datepicker.js"></script>    
    <script type="text/javascript" src="js/ui/i18n/ui.datepicker-id.js"></script>-->
	
    <script type="text/javascript"> 
	//klo tidak mau keluar coba akses file langsung pada browser lengkapi dengan file js dan css. jika mau tampil pasti ada jquery yg bentrok.
      $nf(document).ready(function(){
        $nf("#tanggal").datepicker({
					dateFormat  : "yy-mm-dd",        
          changeMonth : true,
          changeYear  : true					
        });
      });
    </script>

</head>

<body style="font-size:65%;">
<div class="form-div">
<?php if($id){?>
<h2>Edit user</h2>
<hr/>
<form id="form2" name="form2" method="post" action="includes/process_user.php">
	<div class="form-row">
	<span class="label">User ID</span>
    <input type="hidden" name="hidden_desc" value="<?php echo $userObj->description;?>" />
	<input type="hidden" id="ID" name="ID" value="<?php echo $userObj->user_id;?>">
	<input id="uid" name="uid" type="text" value="<?php echo $userObj->user_id;?>" style="width:200px;" readonly="readonly">
	</div>
  
  <div class="form-row">
  <span class="label">Username</span>
    <input type="text" name="uname" value="<?php echo $userObj->username;?>" style="width:200px;" readonly="readonly"/>
  </div>
    
  <div class="form-row">
    <span class="label">Email</span>
    <input type="text" name="email" value="<?php echo $userObj->email;?>" style="width:200px;" readonly="readonly"/>
  </div>
  <div class="form-row">
    <span class="label">First Name</span>
    <input type="text" name="first_name" value="<?php echo $userObj->first_name;?>" style="width:200px;"/>
  </div>
  <div class="form-row">
    <span class="label">Last Name</span>
    <input type="text" name="last_name" value="<?php echo $userObj->last_name;?>" style="width:200px;"/>
  </div>
  <div class="form-row">
    <span class="label">Gender</span>
    <select name="gender">
    <option value="<?php echo $userObj->gender;?>"><?php echo $userObj->gender;?></option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    </select>
  </div>
  <div class="form-row">
    <span class="label">Country</span>
    <select name="listcountry"><option value="<?php echo $userObj->country;?>"><?php echo $userObj->country;?></option> <option value="Afghanistan">Afghanistan</option> <option value="Albania">Albania</option> <option value="Algeria">Algeria</option> <option value="American Samoa">American Samoa</option> <option value="Andorra">Andorra</option> <option value="Angola">Angola</option> <option value="Anguilla">Anguilla</option> <option value="Antigua and Barbuda">Antigua and Barbuda</option> <option value="Argentina">Argentina</option> <option value="Armenia">Armenia</option> <option value="Aruba">Aruba</option> <option value="Australia">Australia</option> <option value="Austria">Austria</option> <option value="Azerbaijan">Azerbaijan</option> <option value="Bahamas">Bahamas</option> <option value="Bahrain">Bahrain</option> <option value="Bangladesh">Bangladesh</option> <option value="Barbados">Barbados</option> <option value="Belarus">Belarus</option> <option value="Belgium">Belgium</option> <option value="Belize">Belize</option> <option value="Benin">Benin</option> <option value="Bermuda">Bermuda</option> <option value="Bhutan">Bhutan</option> <option value="Bolivia">Bolivia</option> <option value="Bonaire">Bonaire</option> <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> <option value="Botswana">Botswana</option> <option value="Brazil">Brazil</option> <option value="British Indian Ocean Ter">British Indian Ocean Ter</option> <option value="Brunei">Brunei</option> <option value="Bulgaria">Bulgaria</option> <option value="Burkina Faso">Burkina Faso</option> <option value="Burundi">Burundi</option> <option value="Cambodia">Cambodia</option> <option value="Cameroon">Cameroon</option> <option value="Canada">Canada</option> <option value="Canary Islands">Canary Islands</option> <option value="Cape Verde">Cape Verde</option> <option value="Cayman Islands">Cayman Islands</option> <option value="Central African Republic">Central African Republic</option> <option value="Chad">Chad</option> <option value="Channel Islands">Channel Islands</option> <option value="Chile">Chile</option> <option value="China">China</option> <option value="Christmas Island">Christmas Island</option> <option value="Cocos Island">Cocos Island</option> <option value="Columbia">Columbia</option> <option value="Comoros">Comoros</option> <option value="Congo">Congo</option> <option value="Cook Islands">Cook Islands</option> <option value="Costa Rica">Costa Rica</option> <option value="Cote D'Ivoire">Cote D'Ivoire</option> <option value="Croatia">Croatia</option> <option value="Cuba">Cuba</option> <option value="Curacao">Curacao</option> <option value="Cyprus">Cyprus</option> <option value="Czech Republic">Czech Republic</option> <option value="Denmark">Denmark</option> <option value="Djibouti">Djibouti</option> <option value="Dominica">Dominica</option> <option value="Dominican Republic">Dominican Republic</option> <option value="East Timor">East Timor</option> <option value="Ecuador">Ecuador</option> <option value="Egypt">Egypt</option> <option value="El Salvador">El Salvador</option> <option value="Equatorial Guinea">Equatorial Guinea</option> <option value="Eritrea">Eritrea</option> <option value="Estonia">Estonia</option> <option value="Ethiopia">Ethiopia</option> <option value="Falkland Islands">Falkland Islands</option> <option value="Faroe Islands">Faroe Islands</option> <option value="Fiji">Fiji</option> <option value="Finland">Finland</option> <option value="France">France</option> <option value="French Guiana">French Guiana</option> <option value="French Polynesia">French Polynesia</option> <option value="French Southern Ter">French Southern Ter</option> <option value="Gabon">Gabon</option> <option value="Gambia">Gambia</option> <option value="Georgia">Georgia</option> <option value="Germany">Germany</option> <option value="Ghana">Ghana</option> <option value="Gibraltar">Gibraltar</option> <option value="Great Britain">Great Britain</option> <option value="Greece">Greece</option> <option value="Greenland">Greenland</option> <option value="Grenada">Grenada</option> <option value="Guadeloupe">Guadeloupe</option> <option value="Guam">Guam</option> <option value="Guatemala">Guatemala</option> <option value="Guinea">Guinea</option> <option value="Guyana">Guyana</option> <option value="Haiti">Haiti</option> <option value="Hawaii">Hawaii</option> <option value="Honduras">Honduras</option> <option value="Hong Kong">Hong Kong</option> <option value="Hungary">Hungary</option> <option value="Iceland">Iceland</option> <option value="India">India</option> <option value="Indonesia">Indonesia</option> <option value="Iran">Iran</option> <option value="Iraq">Iraq</option> <option value="Ireland">Ireland</option> <option value="Isle of Man">Isle of Man</option> <option value="Israel">Israel</option> <option value="Italy">Italy</option> <option value="Jamaica">Jamaica</option> <option value="Japan">Japan</option> <option value="Jordan">Jordan</option> <option value="Kazakhstan">Kazakhstan</option> <option value="Kenya">Kenya</option> <option value="Kiribati">Kiribati</option> <option value="Korea North">Korea North</option> <option value="Korea South">Korea South</option> <option value="Kuwait">Kuwait</option> <option value="Kyrgyzstan">Kyrgyzstan</option> <option value="Laos">Laos</option> <option value="Latvia">Latvia</option> <option value="Lebanon">Lebanon</option> <option value="Lesotho">Lesotho</option> <option value="Liberia">Liberia</option> <option value="Libya">Libya</option> <option value="Liechtenstein">Liechtenstein</option> <option value="Lithuania">Lithuania</option> <option value="Luxembourg">Luxembourg</option> <option value="Macau">Macau</option> <option value="Macedonia">Macedonia</option> <option value="Madagascar">Madagascar</option> <option value="Malaysia">Malaysia</option> <option value="Malawi">Malawi</option> <option value="Maldives">Maldives</option> <option value="Mali">Mali</option> <option value="Malta">Malta</option> <option value="Marshall Islands">Marshall Islands</option> <option value="Martinique">Martinique</option> <option value="Mauritania">Mauritania</option> <option value="Mauritius">Mauritius</option> <option value="Mayotte">Mayotte</option> <option value="Mexico">Mexico</option> <option value="Midway Islands">Midway Islands</option> <option value="Moldova">Moldova</option> <option value="Monaco">Monaco</option> <option value="Mongolia">Mongolia</option> <option value="Montserrat">Montserrat</option> <option value="Morocco">Morocco</option> <option value="Mozambique">Mozambique</option> <option value="Myanmar">Myanmar</option> <option value="Nambia">Nambia</option> <option value="Nauru">Nauru</option> <option value="Nepal">Nepal</option> <option value="Netherland Antilles">Netherland Antilles</option> <option value="Netherlands">Netherlands</option> <option value="Nevis">Nevis</option> <option value="New Caledonia">New Caledonia</option> <option value="New Zealand">New Zealand</option> <option value="Nicaragua">Nicaragua</option> <option value="Niger">Niger</option> <option value="Nigeria">Nigeria</option> <option value="Niue">Niue</option> <option value="Norfolk Island">Norfolk Island</option> <option value="Norway">Norway</option> <option value="Oman">Oman</option> <option value="Pakistan">Pakistan</option> <option value="Palau Island">Palau Island</option> <option value="Palestine">Palestine</option> <option value="Panama">Panama</option> <option value="Papua New Guinea">Papua New Guinea</option> <option value="Paraguay">Paraguay</option> <option value="Peru">Peru</option> <option value="Philippines">Philippines</option> <option value="Pitcairn Island">Pitcairn Island</option> <option value="Poland">Poland</option> <option value="Portugal">Portugal</option> <option value="Puerto Rico">Puerto Rico</option> <option value="Qatar">Qatar</option> <option value="Reunion">Reunion</option> <option value="Romania">Romania</option> <option value="Russia">Russia</option> <option value="Rwanda">Rwanda</option> <option value="St Barthelemy">St Barthelemy</option> <option value="St Eustatius">St Eustatius</option> <option value="St Helena">St Helena</option> <option value="St Kitts-Nevis">St Kitts-Nevis</option> <option value="St Lucia">St Lucia</option> <option value="St Maarten">St Maarten</option> <option value="St Pierre and Miquelon">St Pierre and Miquelon</option> <option value="St Vincent and Grenadines">St Vincent and Grenadines</option> <option value="Saipan">Saipan</option> <option value="Samoa">Samoa</option> <option value="Samoa American">Samoa American</option> <option value="San Marino">San Marino</option> <option value="Sao Tome and Principe">Sao Tome and Principe</option> <option value="Saudi Arabia">Saudi Arabia</option> <option value="Senegal">Senegal</option> <option value="Seychelles">Seychelles</option> <option value="Serbia and Montenegro">Serbia and Montenegro</option> <option value="Sierra Leone">Sierra Leone</option> <option value="Singapore">Singapore</option> <option value="Slovakia">Slovakia</option> <option value="Slovenia">Slovenia</option> <option value="Solomon Islands">Solomon Islands</option> <option value="Somalia">Somalia</option> <option value="South Africa">South Africa</option> <option value="Spain">Spain</option> <option value="Sri Lanka">Sri Lanka</option> <option value="Sudan">Sudan</option> <option value="Suriname">Suriname</option> <option value="Swaziland">Swaziland</option> <option value="Sweden">Sweden</option> <option value="Switzerland">Switzerland</option> <option value="Syria">Syria</option> <option value="Tahiti">Tahiti</option> <option value="Taiwan">Taiwan</option> <option value="Tajikistan">Tajikistan</option> <option value="Tanzania">Tanzania</option> <option value="Thailand">Thailand</option> <option value="Togo">Togo</option> <option value="Tokelau">Tokelau</option> <option value="Tonga">Tonga</option> <option value="Trinidad and Tobago">Trinidad and Tobago</option> <option value="Tunisia">Tunisia</option> <option value="Turkey">Turkey</option> <option value="Turkmenistan">Turkmenistan</option> <option value="Turks and Caicos Is">Turks and Caicos Is</option> <option value="Tuvalu">Tuvalu</option> <option value="Uganda">Uganda</option> <option value="Ukraine">Ukraine</option> <option value="United Arab Emirates">United Arab Emirates</option> <option value="United Kingdom">United Kingdom</option> <option value="United States of America">United States of America</option> <option value="Uruguay">Uruguay</option> <option value="Uzbekistan">Uzbekistan</option> <option value="Vanuatu">Vanuatu</option> <option value="Vatican City State">Vatican City State</option> <option value="Venezuela">Venezuela</option> <option value="Vietnam">Vietnam</option> <option value="Virgin Islands (Brit)">Virgin Islands Brit</option> <option value="Virgin Islands (USA)">Virgin Islands USA</option> <option value="Wake Island">Wake Island</option> <option value="Wallis and Futana Is">Wallis and Futana Is</option> <option value="Yemen">Yemen</option> <option value="Zaire">Zaire</option> <option value="Zambia">Zambia</option> <option value="Zimbabwe">Zimbabwe</option> </select>
  </div>
   <div class="form-row">
    <span class="label">City</span>
    <input type="text" name="city" value="<?php echo $userObj->city;?>" style="width:200px;"/>
  </div>
   <div class="form-row">
    <span class="label">Street</span>
    <input type="text" name="street" value="<?php echo $userObj->street;?>" style="width:200px;"/>
  </div>
     
   <div class="form-row">
    <span class="label">Postal Code</span>
    <input type="text" name="zip" value="<?php echo $userObj->zip;?>" style="width:200px;"/>
  </div>
   <div class="form-row">
    <span class="label">Phone</span>
    <input type="text" name="phone" value="<?php echo $userObj->phone;?>" style="width:200px;"/>
  </div>
  <div class="form-row">
    <span class="label">Email activated</span>
    <select name="email_act">
    <option value="<?php echo $userObj->email_activated;?>"><?php echo $userObj->email_activated;?></option>
    <option value="0">0</option>
    <option value="1">1</option>
    </select>
  </div>
  <div class="form-row" style="margin-bottom:20px;">
    <span class="label">.</span>
    <input type="submit" name="btnEdit" value="Update" />
  </div>
  
</form>
<?php
}else{
?>
<h2>Add new user</h2>
<hr/>
<?php echo $msg;?>
<form id="form1" name="form1" method="post" action="includes/process_user.php">

  <input type="hidden" name="hid1" value="add" />  
  <div class="form-row">
  <span class="label">Username</span>
    <input type="text" name="uname"  value="" style="width:200px;"/>
  </div>
  <div class="form-row">
    <span class="label">Password</span>
    <input type="password" name="password" id="password" value="" style="width:200px;"/>
  </div>
  <div class="form-row">
    <span class="label">Confirm Password</span>
    <input type="password" name="cpassword" value="" style="width:200px;"/>
  </div>
  <div class="form-row">
    <span class="label">Email</span>
    <input type="text" name="email" value="" style="width:200px;"/>
  </div>
 
  <div class="form-row" style="margin-bottom:20px;">
  <span class="label">.</span>
    <input type="submit" name="btnAdd" value="Add" />
  </div>
</form>
</div>
<?php
}
?>
</body>
</html>
