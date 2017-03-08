<?php
include 'config.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/messages','getMessages');
$app->post('/messages', 'insertMessage');
$app->delete('/messages/delete/:message_id','deleteMessage');

$app->run();


function getMessages() {
	$sql = "SELECT * from messages  ORDER BY message_id DESC";
	try {
		$database = getDB();
		$stmt = $database->prepare($sql); 
		$stmt->execute();		
		$updates = $stmt->fetchAll(PDO::FETCH_OBJ);
		$database = null;
		echo '{"messages": ' . json_encode($updates) . '}';
		
	} catch(PDOException $e) {

		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getUpdatedMessages($message_id) {
	$sql = "SELECT * from messages WHERE message_id=:message_id";
	try {
		$database = getDB();
		$stmt = $database->prepare($sql);
        $stmt->bindParam("message_id", $message_id);		
		$stmt->execute();		
		$messages = $stmt->fetchAll(PDO::FETCH_OBJ);
		$database = null;
		echo '{"messages": ' . json_encode($messages) . '}';
		
	} catch(PDOException $e) {

		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function insertMessage() {
	$request = \Slim\Slim::getInstance()->request();
	$massage = json_decode($request->getBody());


	$sql = "INSERT INTO messages (text_message, messages_title, created, ip) VALUES (:text_message, :messages_title, :created, :ip)";
	try {
		$database = getDB();
		$stmt = $database->prepare($sql);  
		$stmt->bindParam("text_message", $massage->text_message);
		$stmt->bindParam("messages_title", $massage->messages_title);
		$time=time();
		$stmt->bindParam("created", $time);
		$ip=$_SERVER['REMOTE_ADDR'];
		$stmt->bindParam("ip", $ip);
		$stmt->execute();
		$massage->id = $database->lastInsertId();
		$database = null;
		$massage_id= $massage->id;
		getUpdatedMessages($massage_id);
		$file = 'messages.txt';
		$current = file_get_contents($file);
		$current .= "Title : ".$massage->messages_title."\n";
		$current .="message : ".$massage->text_message."\n";
		file_put_contents($file, $current);
	} catch(PDOException $e) {

		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteMessage($message_id) {
   
	$sql = "DELETE FROM messages WHERE message_id=:message_id";
	try {
		$database = getDB();
		$stmt = $database->prepare($sql);  
		$stmt->bindParam("message_id", $message_id);
		$stmt->execute();
		$database = null;
		echo true;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
	
}

function getUserSearch($query) {
	$sql = "SELECT * FROM messages WHERE UPPER(name) LIKE :query ORDER BY user_id";
	try {
		$database = getDB();
		$stmt = $database->prepare($sql);
		$query = "%".$query."%";  
		$stmt->bindParam("query", $query);
		$stmt->execute();
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$database = null;
		echo '{"messages": ' . json_encode($users) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
?>