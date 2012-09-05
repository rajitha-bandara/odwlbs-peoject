<ul id="VerColMenu">
	<li><a  href="idefault.php?lid=<?php echo $lid;?>" target="edit_listing_view" onClick="window.open('idefault.php?lid=<?php echo $lid;?>','edit_listing_view');" oncontextmenu="return false;">Listing Overview</a></li>
	<li><a href="#">Listing Details</a>
		<ul>
        	<li><a  href="iedit_general.php?lid=<?php echo $lid;?>" target="edit_listing_view" onClick="window.open('iedit_general.php?lid=<?php echo $lid;?>','edit_listing_view');" oncontextmenu="return false;">General Info</a></li>
			<li><a  href="iedit_contacts.php?lid=<?php echo $lid;?>" target="edit_listing_view" onClick="window.open('iedit_contacts.php?lid=<?php echo $lid;?>','edit_listing_view');" oncontextmenu="return false;">Contacts</a></li>
			<li><a  href="iedit_location.php?lid=<?php echo $lid;?>" target="edit_listing_view" onClick="window.open('iedit_location.php?lid=<?php echo $lid;?>','edit_listing_view');" oncontextmenu="return false;">Location</a></li>
            <li <?php if($package == 'b'){?> style="display:none" <?php }?>><a  href="iedit_social_links.php?lid=<?php echo $lid;?>" target="edit_listing_view" onClick="window.open('iedit_social_links.php?lid=<?php echo $lid;?>','edit_listing_view');" oncontextmenu="return false;">Social Links</a></li>
		</ul>
	</li>
	<li><a  href="#">Keywords</a>
		<ul>
			<li><a  href="iedit_keywords.php?lid=<?php echo $lid;?>" target="edit_listing_view" onClick="window.open('iedit_keywords.php?lid=<?php echo $lid;?>','edit_listing_view');" oncontextmenu="return false;">Manage</a></li>
			
			
		</ul>
	</li>
	<li <?php if($package == 'b'){?> style="display:none" <?php }?>><a  href="#" oncontextmenu="return false;">Banners</a>
		<ul <?php if($package == 'b'){?> style="display:none" <?php }?>>
			<li><a  href="iedit_banners.php?lid=<?php echo $lid;?>" target="edit_listing_view" onClick="window.open('iedit_banners.php?lid=<?php echo $lid;?>','edit_listing_view');" oncontextmenu="return false;">Add</a></li>
			
		</ul>
	</li>
	
</ul>
