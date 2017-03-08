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
		<input id="fileupload" type="file" name="files[]" data-url="lib/js/jQuery-File-Upload/server/php/" multiple>
		<div id="progress" class="progress">
        	<div class="progress-bar progress-bar-success"></div>
   		</div>
		
	</div>
	
	<div class="row">
		<table class="table table-hover">
  			
		</table>
		<!-- <embed src="files/013147149X_book.pdf" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html"> -->
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
                	.done(function() {
                		$('.table').html("");
				    	getTable();
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