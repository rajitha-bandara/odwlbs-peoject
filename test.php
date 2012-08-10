<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link href="public/css/bootstrap.css" rel="stylesheet">
    
<script type="text/javascript" src="public/js/jquery.js"></script>


<script type="text/javascript">
    function track_search()
{
	
	 var what = document.getElementById('q').value;
	 var where  = document.getElementById('city').value;
	 what_where = what +'_'+ where;
	_gaq.push(['_trackEvent', 'search_terms', 'search', what_where]);
	
	 $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: 'action=search&what='+ what +'&where='+ where,
            success: function(ret) {
                
            }
        });
	 
}
    </script>




</head>

<body onLoad="">
 <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="padding: 0; margin: 0;">
    <input type="hidden" name="cmd" value="_xclick/" />
    <input type="hidden" name="business" value="your bussiness id" />
    <input type="hidden" name="quantity" value="1" />
    <input type="hidden" name="item_name" value="your item" />
    <input type="hidden" name="item_number" value="1" />
    <input type="hidden" name="amount" value="item price" />
    <input type="hidden" name="shipping" value="0" />
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="notify_url" value="Your notify url">
    <input type="hidden" name="currency_code" value="GBP" />
    <input type="hidden" name="rm" value="2" >
    <input type="hidden" name="return" value="your return url">
    <input type="image" border="0" name="paypal" src="images/btn_paypal_nl.gif" onClick="" />
    </form>

    
    
</body>
</html>