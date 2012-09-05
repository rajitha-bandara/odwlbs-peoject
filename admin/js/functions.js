///////////////////Track Search Terms////////////////
function handleEmailAct(id,status)
{
	if(status == 0)
	{
	 $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: 'action=activateEmail&uid='+ id,
            success: function(ret) {
              window.location.reload();
            }
        });
	}
	else if(status == 1)
	{
		 $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: 'action=deactivateEmail&uid='+ id,
            success: function(ret) {
               window.location.reload();
            }
        });
	}
	
}

function handleContent(id,app)
{
	 if(app == 0)
	{
	 $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: 'action=approveContent&lid='+ id,
            success: function(ret) {
              window.location.reload();
            }
        });
	}
	else if(app == 1)
	{
		 $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: 'action=rejectContent&lid='+ id,
            success: function(ret) {
               window.location.reload();
            }
        });
	}
}

function updateStatus(lid,status)
{
	$.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: 'action=updateStatus&lid='+ lid + '&status=' + status,
            success: function(ret) {
               window.location.reload();
            }
        });
}

