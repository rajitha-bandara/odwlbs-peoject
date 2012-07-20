<?php @session_start();?>
<?php require_once('includes/init.php');?>
<?php require_once('includes/process_add_listings.php');?>
<?php
$flagAccountType = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Places.com :: Add your Listing</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
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
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
    <link rel="apple-touch-icon-precomposed" href="">
    
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
/*global  $guserObj;//Add a reference to User class
$userAccountType = $guserObj-> getUserAccountType($logOptions_id);
if(!($userAccountType == 1 || $userAccountType == 2))
{
	echo "toggleDisabled(document.getElementById('packInfo'))";
	$flagAccountType = 0;
}
else
{
	$flagAccountType = 1;
}*/

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

  <div id="page_topic"><h1>Create Listing</h1></div>
  <div  class="alert alert-success" id="biz_info">
   <h3>Business listing:</h3>
	<ul>
    <li id="biz_info_list_item">To maintain the quality and value of our business listings, we review every listing request. Final determination on 	whether a listing is accepted is made at our sole discretion.</li>
    <li id="biz_info_list_item">We do not accept businesses that are Warez, illegal, Gambling, Adult/Pornography, Drugs/Pharmacy, Retail tobacco, Alcoholic drinks related, Multi-Level Marketing sites or inappropriate. </li>
     <li id="biz_info_list_item">None English sites are allowed, but the description of the submission should be in English. </li>
     <li id="biz_info_list_item">The Publisher reserves the right to edit each listing according to established editorial guidelines.</li>
    </ul>
  </div>
  
  <div  id="response">
  <?php echo $msg;?>
  </div>
  <div id="add_biz_content" style="margin-top:50px;margin-bottom:100px;"> <!--Begins Add Listing section-->
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
      </div><!--End of Main category control-->
       </div>
       
         <div class="control-group">
         <label class="control-label" for="input03" id="show_heading"><span class="red_star">*</span>Sub Category</label>
         <div class="controls" >
         	<div id="show_sub_categories">
			<img src="public/img/loader.gif" style="margin-top:8px; float:left" id="loader" alt="" />
            
		</div>
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
            
            
          
            </div><!--End bizInfo tab pane-->
            
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
            
            </div><!--End of contactInfo tab pae-->
            
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
                 <option value="">Please select</option><option value="xx">Other</option><option value="af">Afghanistan</option><option value="ax">Aland Islands</option><option value="al">Albania</option><option value="dz">Algeria</option><option value="as">American Samoa</option><option value="ad">Andorra</option><option value="ao">Angola</option><option value="ai">Anguilla</option><option value="aq">Antarctica</option><option value="ag">Antigua and Barbuda</option><option value="ar">Argentina</option><option value="am">Armenia</option><option value="aw">Aruba</option><option value="au">Australia</option><option value="at">Austria</option><option value="az">Azerbaijan</option><option value="bs">Bahamas</option><option value="bh">Bahrain</option><option value="bd">Bangladesh</option><option value="bb">Barbados</option><option value="by">Belarus</option><option value="be">Belgium</option><option value="bz">Belize</option><option value="bj">Benin</option><option value="bm">Bermuda</option><option value="bt">Bhutan</option><option value="bo">Bolivia</option><option value="ba">Bosnia and Herzegovina</option><option value="bw">Botswana</option><option value="bv">Bouvet Island</option><option value="br">Brazil</option><option value="io">British Indian Ocean Territory</option><option value="vg">British Virgin Islands</option><option value="bn">Brunei</option><option value="bg">Bulgaria</option><option value="bf">Burkina Faso</option><option value="bi">Burundi</option><option value="kh">Cambodia</option><option value="cm">Cameroon</option><option value="ca">Canada</option><option value="cv">Cape Verde</option><option value="ky">Cayman Islands</option><option value="cf">Central African Republic</option><option value="td">Chad</option><option value="cl">Chile</option><option value="cn">China</option><option value="cx">Christmas Island</option><option value="cc">Cocos (Keeling) Islands</option><option value="co">Colombia</option><option value="km">Comoros</option><option value="cg">Congo (Brazzaville)</option><option value="cd">Congo (Kinshasa)</option><option value="ck">Cook Islands</option><option value="cr">Costa Rica</option><option value="hr">Croatia</option><option value="cu">Cuba</option><option value="cy">Cyprus</option><option value="cz">Czech Republic</option><option value="dk">Denmark</option><option value="dj">Djibouti</option><option value="dm">Dominica</option><option value="do">Dominican Republic</option><option value="tl">East Timor</option><option value="ec">Ecuador</option><option value="eg">Egypt</option><option value="sv">El Salvador</option><option value="gq">Equatorial Guinea</option><option value="er">Eritrea</option><option value="ee">Estonia</option><option value="et">Ethiopia</option><option value="fk">Falkland Islands</option><option value="fo">Faroe Islands</option><option value="fj">Fiji</option><option value="fi">Finland</option><option value="fr">France</option><option value="gf">French Guiana</option><option value="pf">French Polynesia</option><option value="tf">French Southern Territories</option><option value="ga">Gabon</option><option value="gm">Gambia</option><option value="ge">Georgia</option><option value="de">Germany</option><option value="gh">Ghana</option><option value="gi">Gibraltar</option><option value="gr">Greece</option><option value="gl">Greenland</option><option value="gd">Grenada</option><option value="gp">Guadeloupe</option><option value="gu">Guam</option><option value="gt">Guatemala</option><option value="gg">Guernsey</option><option value="gn">Guinea</option><option value="gw">Guinea-Bissau</option><option value="gy">Guyana</option><option value="ht">Haiti</option><option value="hm">Heard Island and McDonald Islands</option><option value="hn">Honduras</option><option value="hk">Hong Kong S.A.R., China</option><option value="hu">Hungary</option><option value="is">Iceland</option><option value="in">India</option><option value="id">Indonesia</option><option value="ir">Iran</option><option value="iq">Iraq</option><option value="ie">Ireland</option><option value="im">Isle of Man</option><option value="il">Israel</option><option value="it">Italy</option><option value="ci">Ivory Coast</option><option value="jm">Jamaica</option><option value="jp">Japan</option><option value="je">Jersey</option><option value="jo">Jordan</option><option value="kz">Kazakhstan</option><option value="ke">Kenya</option><option value="ki">Kiribati</option><option value="kw">Kuwait</option><option value="kg">Kyrgyzstan</option><option value="la">Laos</option><option value="lv">Latvia</option><option value="lb">Lebanon</option><option value="ls">Lesotho</option><option value="lr">Liberia</option><option value="ly">Libya</option><option value="li">Liechtenstein</option><option value="lt">Lithuania</option><option value="lu">Luxembourg</option><option value="mo">Macao S.A.R., China</option><option value="mk">Macedonia</option><option value="mg">Madagascar</option><option value="mw">Malawi</option><option value="my">Malaysia</option><option value="mv">Maldives</option><option value="ml">Mali</option><option value="mt">Malta</option><option value="mh">Marshall Islands</option><option value="mq">Martinique</option><option value="mr">Mauritania</option><option value="mu">Mauritius</option><option value="yt">Mayotte</option><option value="mx">Mexico</option><option value="fm">Micronesia</option><option value="md">Moldova</option><option value="mc">Monaco</option><option value="mn">Mongolia</option><option value="me">Montenegro</option><option value="ms">Montserrat</option><option value="ma">Morocco</option><option value="mz">Mozambique</option><option value="mm">Myanmar</option><option value="na">Namibia</option><option value="nr">Nauru</option><option value="np">Nepal</option><option value="nl">Netherlands</option><option value="an">Netherlands Antilles</option><option value="nc">New Caledonia</option><option value="nz">New Zealand</option><option value="ni">Nicaragua</option><option value="ne">Niger</option><option value="ng">Nigeria</option><option value="nu">Niue</option><option value="nf">Norfolk Island</option><option value="mp">Northern Mariana Islands</option><option value="kp">North Korea</option><option value="no">Norway</option><option value="om">Oman</option><option value="pk">Pakistan</option><option value="pw">Palau</option><option value="ps">Palestinian Territory</option><option value="pa">Panama</option><option value="pg">Papua New Guinea</option><option value="py">Paraguay</option><option value="pe">Peru</option><option value="ph">Philippines</option><option value="pn">Pitcairn</option><option value="pl">Poland</option><option value="pt">Portugal</option><option value="pr">Puerto Rico</option><option value="qa">Qatar</option><option value="re">Reunion</option><option value="ro">Romania</option><option value="ru">Russia</option><option value="rw">Rwanda</option><option value="sh">Saint Helena</option><option value="kn">Saint Kitts and Nevis</option><option value="lc">Saint Lucia</option><option value="pm">Saint Pierre and Miquelon</option><option value="vc">Saint Vincent and the Grenadines</option><option value="ws">Samoa</option><option value="sm">San Marino</option><option value="st">Sao Tome and Principe</option><option value="sa">Saudi Arabia</option><option value="sn">Senegal</option><option value="rs">Serbia</option><option value="cs">Serbia And Montenegro</option><option value="sc">Seychelles</option><option value="sl">Sierra Leone</option><option value="sg">Singapore</option><option value="sk">Slovakia</option><option value="si">Slovenia</option><option value="sb">Solomon Islands</option><option value="so">Somalia</option><option value="za">South Africa</option><option value="gs">South Georgia and the South Sandwich Islands</option><option value="kr">South Korea</option><option value="es">Spain</option><option value="lk" selected="selected">Sri Lanka</option><option value="sd">Sudan</option><option value="sr">Suriname</option><option value="sj">Svalbard and Jan Mayen</option><option value="sz">Swaziland</option><option value="se">Sweden</option><option value="ch">Switzerland</option><option value="sy">Syria</option><option value="tw">Taiwan</option><option value="tj">Tajikistan</option><option value="tz">Tanzania</option><option value="th">Thailand</option><option value="tg">Togo</option><option value="tk">Tokelau</option><option value="to">Tonga</option><option value="tt">Trinidad and Tobago</option><option value="tn">Tunisia</option><option value="tr">Turkey</option><option value="tm">Turkmenistan</option><option value="tc">Turks and Caicos Islands</option><option value="tv">Tuvalu</option><option value="vi">U.S. Virgin Islands</option><option value="ug">Uganda</option><option value="ua">Ukraine</option><option value="ae">United Arab Emirates</option><option value="uk">United Kingdom</option><option value="us">United States</option><option value="um">United States Minor Outlying Islands</option><option value="uy">Uruguay</option><option value="uz">Uzbekistan</option><option value="vu">Vanuatu</option><option value="va">Vatican</option><option value="ve">Venezuela</option><option value="vn">Vietnam</option><option value="wf">Wallis and Futuna</option><option value="eh">Western Sahara</option><option value="ye">Yemen</option><option value="zm">Zambia</option><option value="zw">Zimbabwe</option></select>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="input05"><span class="red_star">&nbsp;</span>Zip Code</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtZip" name="txtZip" value="<?php echo $zip;?>">
              </div>
            </div>
            <div class="controls">
           	</div>
                       
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
            
            </div><!--End of locInfo tab pae-->
            
            <div class="tab-pane" id="metaInfo">
                <div class="control-group">
              <label class="control-label" for="input05">Enter Keywords separated by comma</label>
              <div class="controls">
                 <input type="text" class="input-xlarge" id="txtKeywords" name="txtKeywords" value="<?php echo $keywords;?>">
              </div>
            </div>
            
            </div><!--End of meta data tab pae-->
            
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
             <h3><b><?php 
			 if($flagAccountType==0)
			 {
				 echo "Free listing plan does not allow to display advertidements. Register for a premium plan and put an advertisement for your valuable product/business.";
			 }
			 ?></b></h3>
             
             </div>
            
            </div><!--End of packages tab pane-->
            
            <div class="tab-pane" id="confirm">
            
           <div id="accept" style="margin-top:100px;">
            <input type="checkbox" name="cbAccept" value="<?php echo $isAccepted;?>"> I have read and accept  <?php echo DOMAIN_NAME;?> <a href="terms.php"> Terms and Conditions</a>
            </div>
            <div id="submit" style="margin-left:200px;margin-top:50px;margin-bottom:50px;">
            <button class="btn btn-primary" name="btnSave">Save</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button class="btn btn-primary">Cancel</button>
            </div>
            
            
            </div><!--End of confirm tab pane-->
            
           <div class="clear"></div>
            
        </div> <!--End of Business Content-->
  </div> <!--End of Page Content-->
    
 <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".#tabs").tabs();
        });
    </script>
</form>
  </div>
  </div><!--End of Add Listing section-->
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
    
    


    
</body>
</html>
