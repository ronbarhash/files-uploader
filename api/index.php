<?php
require_once '../lib/php/vendor/autoload.php';
require_once 'db.php';


$app = new \Slim\Slim();

$app->get('/', function () use($fpdo){
	$result = [];
    $query = $fpdo->from('files')->limit(5);
    foreach ($query as $key => $value) {
    	$result[]=$value;
    }
    $result = json_encode($result);
    echo ($result);
});

$app->get('/files/:id', function ($id) use($fpdo) {

    $query = $fpdo->from('files')->where('id', $id);
    $row = $query->fetch();
   
    if( !empty($row)){
	    $row = json_encode($row);
	    	    echo ($row);
    } else echo "no data";
});

$app->post('/file/:id', function ($id) use($fpdo,$app) {

    $query = $fpdo->deleteFrom('files')->where('id', $id)->execute();
    $app->redirect('/');
   
});

$app->post('/files', function () use($fpdo,$app) {
	$allPostVars = $app->request->post();

    $filename = $allPostVars['filename'];

	$values = array('id' => 'NULL', 'filename' => $filename);
	$query = $fpdo->insertInto('files', $values)->execute();
	
	// $app->redirect('/');   
});
$app->run();
?>