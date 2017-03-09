<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="lib/js/bootstrap-3/css/bootstrap.min.css">
	<link rel="stylesheet" href="lib/js/bootstrap-3/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/index.js"></script>
	<script src="lib/js/bootstrap-3/js/bootstrap.min.js"></script>
	<script src="lib/js/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
	<script src="lib/js/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
	<script src="lib/js/jQuery-File-Upload/js/jquery.fileupload.js"></script>
	<title>Pdf - Reader</title>
</head>
<body>
<div class="container">
	<div class="row .top">
	<label class="btn btn-default btn-file">
	Upload
		<input id="fileupload" type="file" name="files[]" data-url="lib/js/jQuery-File-Upload/server/php/" multiple style="display: none;">
	</label>
		<div id="progress" class="progress">
        	<div class="progress-bar progress-bar-success"></div>
   		</div>
        <div class="test"><button id1="5">delpage</button></div>
		
	</div>
	
    <!-- The container for the uploaded files -->
   
	<div class="row">
		<table class="table table-hover"></table>
		<div class="PDF">
		   <object data="" type="application/pdf" width="750" height="600">
		       alt : <a href="files/013147149X_book.pdf">your.pdf</a>
		   </object>
		</div>
	</div>

</div>
<script src="js/app.js"></script>
<script>
$(function () {
    'use strict';
    
    var url = window.location.hostname === 'localhost' ?
               'lib/js/jQuery-File-Upload/server/php/' : 'server/php/';
    getTable();
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
                $.post('api/files',  { 'filename': file.name})
                	.done(function(data) {
                		$('.table').append('<tr><td>'+file.name+'</td><td><button class="btn btn-success">show</button></td>'+"<td><input type='submit' class='btn btn-danger' id="+data+" value='delete'></td></tr>"); 
                		// +"<td><form method='POST' action='api/file/"+data+"'><input type='hidden' name='_method' value='DELETE'><input type='submit' class='btn btn-danger' value='delete'></form></td><tr>"
                		// console.log(data);             						    	
				  	});
            });
            // getTable();
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>	
</body>
</html>