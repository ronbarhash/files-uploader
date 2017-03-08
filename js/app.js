function getTable(){
var table = $.get( "api/", function( data ) {
  var table = $( "table" );

  var str = "";
  var btn = "<td><button class='btn btn-success'>show</button></td>";
  for(var row in data) {
    console.log(data[row]);
    str += "<tr> <td>" + data[row]['filename'] +"</td>"+ btn +"<td><form method='POST' action='api/file/"+data[row]['id']+"'><input type='hidden' name='_method' value='DELETE'><input type='submit' class='btn btn-danger' value='delete'></form></tr>";
  }

  table.append(str);
    
},"json");


$('.table').on('click', 'button', function(){
  var tr = this.closest('tr');
  var fname = "files/" + $(tr).find('td').get(0).innerHTML;
  $("object").attr('data',fname);


});

  
}