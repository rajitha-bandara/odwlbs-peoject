<?php @session_start();?>
<?php require_once('includes/init.php');?>
<?php require_once('includes/process_add_listings.php');?>
<?php
$flagAccountType = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add your Listing -<?php echo DOMAIN_NAME;?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Add listing on <?php echo DOMAIN_NAME;?> online directory." />
<meta name="keywords" content="business directory, local, search, business listings">
<!-- Le styles -->
<link href="public/css/bootstrap.css" rel="stylesheet">
<link href="public/css/bootstrap.min.css" rel="stylesheet">
<link href="public/css/960_24_col.css" rel="stylesheet">
<link href="public/css/reset.css" rel="stylesheet">
<link href="public/css/style.css" rel="stylesheet">
<link href="public/css/ad.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="public/js/html5.js"></script>
      <link rel="stylesheet" href="public/css/ie-csss3.htc" type="text/css" media="screen">
    <![endif]-->
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="public/icons/favicon.ico">
<script src="public/js/jquery.js"></script>
<script src="public/js/bpopup-0.6.0.min.js"></script>
<script src="public/js/bootstrap/bootstrap-tab.js"></script>
<script src="public/js/functions.js"></script>
<style type="text/css">
.response-waiting {
	background:url(public/img/loading_small.gif) no-repeat;
}
.response-success {
	background:url(public/img/tick.png) no-repeat;
}
.response-error {
	background:url(public/img/cross.png) no-repeat;
}
</style>
<script type="text/javascript">
function toggleAlert() {
<?php

	if($requested_pkg == "silver" || $requested_pkg == "gold")
	{
		$flagAccountType = 1;
	}
	else
	{
		echo "toggleDisabled(document.getElementById('packInfo'))";
		$flagAccountType = 0;
	}


?>

}

function toggleDisabled(el) {
try {
el.disabled = el.disabled ? false : true;
}
catch(E){
}
if (el.childNodes && el.childNodes.length > 0) {
for (var x = 0; x < el.childNodes.length; x++) {
toggleDisabled(el.childNodes[x]);
}
}
}


</script>
</head>
<body onLoad="toggleAlert()">
<div class="container_24" id="container">
  <?php require_once('templates/top-nav-bar.php');?>
  <?php require_once('templates/header.php');?>
  <?php require_once('templates/linkbar.html');?>
  <div class="grid_24">
    <div id="page_body" class="grid_24" style="width:935px;padding-bottom:150px;">
      <div id="page_topic">
        <h1>Create Listing</h1>
      </div>
      <div  class="alert alert-success" id="biz_info">
        <h3>Business listing:</h3>
        <ul>
          <li id="biz_info_list_item">To maintain the quality and value of our business listings, we review every listing request. Final determination on 	whether a listing is accepted is made at our sole discretion.</li>
          <li id="biz_info_list_item">We do not accept businesses that are Warez, illegal, Gambling, Adult/Pornography, Drugs/Pharmacy, Retail tobacco, Alcoholic drinks related, Multi-Level Marketing sites or inappropriate. </li>
          <li id="biz_info_list_item">None English sites are allowed, but the description of the submission should be in English. </li>
          <li id="biz_info_list_item">The Publisher reserves the right to edit each listing according to established editorial guidelines.</li>
        </ul>
      </div>
      <div  id="response"> <?php echo $msg;?> </div>
      <div id="add_biz_content" style="margin-top:50px;margin-bottom:100px;">
        <!--Begins Add Listing section-->
        <form action="" method="post" enctype="multipart/form-data" name="listing-form" class="form-horizontal" onSubmit="map_geocode( this.address.value ); return false;">
          <div id="content" class="grid_17">
            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
              <li class="active"><a href="#bizInfo" data-toggle="tab" id="tab_link">Listing Info</a></li>
              <li><a href="#contactInfo" data-toggle="tab" style="" id="tab_link">Contacts</a></li>
              <li><a href="#locInfo" data-toggle="tab" id="tab_link">Location</a></li>
              <li><a href="#metaInfo" data-toggle="tab" id="tab_link">Meta Data</a></li>
              <li><a href="#packInfo" data-toggle="tab" id="tab_link">Banner Options</a></li>
              <li><a href="#confirm" data-toggle="tab" id="tab_link">Confirm</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
              <div class="tab-pane active" id="bizInfo">
                <div class="control-group">
                  <label class="control-label" for="input01"><span class="red_star">*</span>Listing Title</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="input01" name="txtTitle" value="<?php echo $title;?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input02"><span class="red_star">&nbsp;</span>Logo</label>
                  <div class="controls">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                    <input type="file" name="file_upload" id="fileLogo" class="input-xlarge" />
                    <p class="help-block">Maximum file size: 500 KB. Allowed extensions: png gif jpg jpeg</p>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input03"><span class="red_star">*</span>Tagline</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="input03" name="txtTagline" value="<?php echo $tagline;?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input04"><span class="red_star">*</span>Category</label>
                  <div class="controls">
                    <select name="listCategory"  id="search_category_id" class="input-xlarge">
                      <option value="" selected="selected"></option>
                      <?php
		$query = "select * from lbs_biz_main_categories ";
		$results = mysql_query($query);
		
		while ($rows = mysql_fetch_assoc(@$results))
		{?>
                      <option value="<?php echo $rows['main_category_id'];?>"><?php echo $rows['name'];?></option>
                      <?php
		}?>
                    </select>
                  </div>
                  <!--End of Main category control-->
                </div>
                <div class="control-group">
                  <label class="control-label" for="input03" id="show_heading"><span class="red_star">*</span>Sub Category</label>
                  <div class="controls" >
                    <div id="show_sub_categories"> <img src="public/img/loader.gif" style="margin-top:8px; float:left" id="loader" alt="" /> </div>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Description</label>
                  <div class="controls">
                    <textarea name="txtDes" id="textarea" cols="45" rows="5" class="input-xlarge"></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Web Site</label>
                  <div class="controls">
                    <select name="listUrlProtocol" style="width:80px;">
                      <option value="http://">http://</option>
                      <option value="https://">https://</option>
                    </select>
                    <input type="text" class="input-large" id="input06" name="txtWeb" value="<?php echo $web;?>">
                  </div>
                </div>
              </div>
              <!--End bizInfo tab pane-->
              <div class="tab-pane" id="contactInfo">
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">*</span>Email</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtEmail" name="txtEmail" value="<?php echo $email;?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">*</span>Phone Number</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtPhone" name="txtPhone" value="<?php echo $phone;?>" >
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Fax Number</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtFax" name="txtFax" value="<?php echo $fax;?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Mobile</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtMobile" name="txtMobile" value="<?php echo $mobile;?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">*</span>Contact Person</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtContactP" name="txtContactP" value="<?php echo $contactP;?>">
                  </div>
                </div>
              </div>
              <!--End of contactInfo tab pae-->
              <div class="tab-pane" id="locInfo">
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">*</span>Street</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtStreet" name="txtStreet" value="<?php echo $street;?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">*</span>Town/City</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtCity" name="txtCity" value="<?php echo $city;?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">*</span>State/Country</label>
                  <div class="controls">
                    <select name="listCountry" class="input-xlarge" id="">
                      <option value="">Please select</option>
                      <option value="Afghanistan">Afghanistan</option>
                      <option value="Åland Islands">Åland Islands</option>
                      <option value="Albania">Albania</option>
                      <option value="Algeria">Algeria</option>
                      <option value="American Samoa">American Samoa</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antarctica">Antarctica</option>
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
                      <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                      <option value="Botswana">Botswana</option>
                      <option value="Bouvet Island">Bouvet Island</option>
                      <option value="Brazil">Brazil</option>
                      <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                      <option value="Brunei Darussalam">Brunei Darussalam</option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Cambodia">Cambodia</option>
                      <option value="Cameroon">Cameroon</option>
                      <option value="Canada">Canada</option>
                      <option value="Cape Verde">Cape Verde</option>
                      <option value="Cayman Islands">Cayman Islands</option>
                      <option value="Central African Republic">Central African Republic</option>
                      <option value="Chad">Chad</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Christmas Island">Christmas Island</option>
                      <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comoros">Comoros</option>
                      <option value="Congo">Congo</option>
                      <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                      <option value="Cook Islands">Cook Islands</option>
                      <option value="Costa Rica">Costa Rica</option>
                      <option value="Cote D'ivoire">Cote D'ivoire</option>
                      <option value="Croatia">Croatia</option>
                      <option value="Cuba">Cuba</option>
                      <option value="Cyprus">Cyprus</option>
                      <option value="Czech Republic">Czech Republic</option>
                      <option value="Denmark">Denmark</option>
                      <option value="Djibouti">Djibouti</option>
                      <option value="Dominica">Dominica</option>
                      <option value="Dominican Republic">Dominican Republic</option>
                      <option value="Ecuador">Ecuador</option>
                      <option value="Egypt">Egypt</option>
                      <option value="El Salvador">El Salvador</option>
                      <option value="Equatorial Guinea">Equatorial Guinea</option>
                      <option value="Eritrea">Eritrea</option>
                      <option value="Estonia">Estonia</option>
                      <option value="Ethiopia">Ethiopia</option>
                      <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                      <option value="Faroe Islands">Faroe Islands</option>
                      <option value="Fiji">Fiji</option>
                      <option value="Finland">Finland</option>
                      <option value="France">France</option>
                      <option value="French Guiana">French Guiana</option>
                      <option value="French Polynesia">French Polynesia</option>
                      <option value="French Southern Territories">French Southern Territories</option>
                      <option value="Gabon">Gabon</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Germany">Germany</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Greece">Greece</option>
                      <option value="Greenland">Greenland</option>
                      <option value="Grenada">Grenada</option>
                      <option value="Guadeloupe">Guadeloupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guernsey">Guernsey</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guinea-bissau">Guinea-bissau</option>
                      <option value="Guyana">Guyana</option>
                      <option value="Haiti">Haiti</option>
                      <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                      <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Hungary">Hungary</option>
                      <option value="Iceland">Iceland</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                      <option value="Iraq">Iraq</option>
                      <option value="Ireland">Ireland</option>
                      <option value="Isle of Man">Isle of Man</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japan">Japan</option>
                      <option value="Jersey">Jersey</option>
                      <option value="Jordan">Jordan</option>
                      <option value="Kazakhstan">Kazakhstan</option>
                      <option value="Kenya">Kenya</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                      <option value="Korea, Republic of">Korea, Republic of</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                      <option value="Latvia">Latvia</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lithuania">Lithuania</option>
                      <option value="Luxembourg">Luxembourg</option>
                      <option value="Macao">Macao</option>
                      <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Malaysia">Malaysia</option>
                      <option value="Maldives">Maldives</option>
                      <option value="Mali">Mali</option>
                      <option value="Malta">Malta</option>
                      <option value="Marshall Islands">Marshall Islands</option>
                      <option value="Martinique">Martinique</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mauritius">Mauritius</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                      <option value="Moldova, Republic of">Moldova, Republic of</option>
                      <option value="Monaco">Monaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montenegro">Montenegro</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Morocco">Morocco</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="Namibia">Namibia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Netherlands">Netherlands</option>
                      <option value="Netherlands Antilles">Netherlands Antilles</option>
                      <option value="New Caledonia">New Caledonia</option>
                      <option value="New Zealand">New Zealand</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk Island">Norfolk Island</option>
                      <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                      <option value="Norway">Norway</option>
                      <option value="Oman">Oman</option>
                      <option value="Pakistan">Pakistan</option>
                      <option value="Palau">Palau</option>
                      <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                      <option value="Panama">Panama</option>
                      <option value="Papua New Guinea">Papua New Guinea</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Peru</option>
                      <option value="Philippines">Philippines</option>
                      <option value="Pitcairn">Pitcairn</option>
                      <option value="Poland">Poland</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Reunion">Reunion</option>
                      <option value="Romania">Romania</option>
                      <option value="Russian Federation">Russian Federation</option>
                      <option value="Rwanda">Rwanda</option>
                      <option value="Saint Helena">Saint Helena</option>
                      <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                      <option value="Saint Lucia">Saint Lucia</option>
                      <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                      <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                      <option value="Samoa">Samoa</option>
                      <option value="San Marino">San Marino</option>
                      <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                      <option value="Saudi Arabia">Saudi Arabia</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Serbia">Serbia</option>
                      <option value="Seychelles">Seychelles</option>
                      <option value="Sierra Leone">Sierra Leone</option>
                      <option value="Singapore">Singapore</option>
                      <option value="Slovakia">Slovakia</option>
                      <option value="Slovenia">Slovenia</option>
                      <option value="Solomon Islands">Solomon Islands</option>
                      <option value="Somalia">Somalia</option>
                      <option value="South Africa">South Africa</option>
                      <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                      <option value="Spain">Spain</option>
                      <option value="Sri Lanka">Sri Lanka</option>
                      <option value="Sudan">Sudan</option>
                      <option value="Suriname">Suriname</option>
                      <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                      <option value="Swaziland">Swaziland</option>
                      <option value="Sweden">Sweden</option>
                      <option value="Switzerland">Switzerland</option>
                      <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                      <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                      <option value="Tajikistan">Tajikistan</option>
                      <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                      <option value="Thailand">Thailand</option>
                      <option value="Timor-leste">Timor-leste</option>
                      <option value="Togo">Togo</option>
                      <option value="Tokelau">Tokelau</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                      <option value="Tunisia">Tunisia</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Turkmenistan">Turkmenistan</option>
                      <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Uganda">Uganda</option>
                      <option value="Ukraine">Ukraine</option>
                      <option value="United Arab Emirates">United Arab Emirates</option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="United States">United States</option>
                      <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                      <option value="Uruguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistan</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Viet Nam">Viet Nam</option>
                      <option value="Virgin Islands, British">Virgin Islands, British</option>
                      <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                      <option value="Wallis and Futuna">Wallis and Futuna</option>
                      <option value="Western Sahara">Western Sahara</option>
                      <option value="Yemen">Yemen</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabwe">Zimbabwe</option>
                      <option value="xx">Other</option>
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Zip Code</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtZip" name="txtZip" value="<?php echo $zip;?>">
                  </div>
                </div>
                <div class="controls"> </div>
                <div id="showMap" class="controls"><a onClick="openMap()" href="javascript:void(0);" id="showMap">Show Map</a></div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Latitude</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtLat" name="txtLat" value="<?php echo $latitude;?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Longitude</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtLong" name="txtLong" value="<?php echo $longitude;?>">
                  </div>
                </div>
              </div>
              <!--End of locInfo tab pae-->
              <div class="tab-pane" id="metaInfo">
                <div class="control-group">
                  <label class="control-label" for="input05">Enter Keywords separated by comma</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtKeywords" name="txtKeywords" value="<?php echo $keywords;?>">
                  </div>
                </div>
              </div>
              <!--End of meta data tab pae-->
              <div class="tab-pane" id="packInfo">
                <div class="control-group">
                  <label class="control-label" for="input05">Display Location</label>
                  <div class="controls">
                    <select name="listType" class="input-xlarge">
                      <option value="">-- Select a Type --</option>
                      <option value="1" selected="selected">Top (468px x 60px)</option>
                      <option value="2" >Bottom (468px x 60px)</option>
                      <option value="3" >Featured (180px x 150px)</option>
                      <option value="50" >Sponsored Links (180px x 100px)</option>
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05">Caption</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="txtCaption" name="txtCaption" value="<?php echo $caption;?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input02">Image</label>
                  <div class="controls">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                    <input type="file" name="banner_upload" id="banner_upload" class="input-xlarge" />
                    <p class="help-block">Maximum file size: 500 KB. Allowed extensions: png gif jpg jpeg</p>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="input05">Destination URL</label>
                  <div class="controls">
                    <select name="listAdUrlProtocol" style="width:80px;">
                      <option value="http://">http://</option>
                      <option value="https://">https://</option>
                    </select>
                    <input type="text" class="input-large" id="input06" name="txtDestination" value="<?php echo $destination;?>">
                  </div>
                </div>
                <div class="control-group">
                  <h3><b>
                    <?php 
			 if($flagAccountType==0)
			 {
				 echo "Free listing plan does not allow to display advertidements. Register for a premium plan and put an advertisement for your valuable product/business.";
			 }
			 ?>
                    </b></h3>
                </div>
              </div>
              <!--End of packages tab pane-->
              <div class="tab-pane" id="confirm">
                <div id="accept" style="margin-top:100px;">
                  <input type="checkbox" name="cbAccept" value="<?php echo $isAccepted;?>">
                  I have read and accept <?php echo DOMAIN_NAME;?> <a href="terms.php"> Terms and Conditions</a> </div>
                <div id="submit" style="margin-left:200px;margin-top:50px;margin-bottom:50px;">
                  <button class="btn btn-primary" name="btnSave">Save</button>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-primary">Cancel</button>
                </div>
              </div>
              <!--End of confirm tab pane-->
              <div class="clear"></div>
            </div>
            <!--End of Business Content-->
          </div>
          <!--End of Page Content-->
          <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".#tabs").tabs();
        });
    </script>
        </form>
      </div>
    </div>
    <!--End of Add Listing section-->
  </div>
  <div class="clear"></div>
  <?php require_once('templates/footer.php');?>
</div>
<?php require_once('templates/popup_login.php');?>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/js/livevalidation.js"></script>
<script src="public/js/bootstrap/bootstrap-button.js"></script>
<script src="public/js/bootstrap/bootstrap-alert.js"></script>
<script src="public/js/uservoice_feedback.js"></script>
</body>
</html>
