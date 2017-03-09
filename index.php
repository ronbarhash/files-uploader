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
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">      
      <label class="btn btn-success btn-file navbar-btn">
        Upload
            <input id="fileupload" type="file" name="files[]" data-url="lib/js/jQuery-File-Upload/server/php/" multiple style="display: none;">
        </label>
    </div>
  </div>
</nav>
<div class="container">    
	<div class="row">
		<table class="table table-bordered"></table>
		<div class="PDF">
		   <object data="" type="application/pdf" width="750" height="600">
		       alt : <a href="files/013147149X_book.pdf">your.pdf</a>
		   </object>
		</div>
	</div>
    <div class="row .top">
   
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
                		$('.table').append('<tr><td>'+file.name+'</td><td><button class="btn btn-default">show</button>'+"<input type='submit' class='btn btn-warning' id="+data+" value='delete'></td></tr>"); 
				  	});
            });        
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