function getTable(){
var table = $.get( "api/", function( data ) {
  var table = $( "table" );

  var str = "";
  var btn = "<td><button class='btn btn-success'>show</button></td>";

  for(var row in data) {    
    str += "<tr> <td>" + data[row]['filename'] +"</td>"+ btn +"<td><input type='submit' id='"+data[row]['id'] +"' class='btn btn-danger' value='delete'></td></tr>";
  }

  table.append(str);
    
},"json");


$('.table').on('click', 'button', function(){
  var tr = this.closest('tr');
  var fname = "files/" + $(tr).find('td').get(0).innerHTML;
  $("object").attr('data',fname);


});

$('.table').on('click', 'input', function(){
  var tr= $(this).closest('tr');
  var id = $(this).attr('id');
  $.post('/api/file/'+ id,{'id':id}).done(function(){  
    
    tr.remove();
    $('.PDF').hide();
    
  });
  
});


}