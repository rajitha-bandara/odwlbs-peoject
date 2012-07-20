<div class="grid_4" id="profile_left_col">
  <div align="center"><h1>My Account</h1></div>
  <div id="profile_image" align="center">
    <?php print "$profile_img"; ?>
    </div>
    
    <div id="link_area">
    <h3>Account Options</h3>
      <ul id="item_list">
        <li><a href="profile.php?id=<?php print "$id"?>">View Profile</a></li>
        <li><a href="edit_profile.php?id=<?php print "$id"?>">Edit Profile</a></li>
        <li><a href="account_settings.php?id=<?php print "$id"?>">Account Settings</a></li>
      </ul>
      <br>
      
      <h3>My Listings</h3>
      <ul id="item_list">
        <li><a href="view_listings.php?id=<?php print "$id"?>">Manage Listings</a></li>
        <li><a href="add_listing.php?id=<?php print "$id"?>">Add Listing</a></li>
      </ul>
    </div>
    
  </div>