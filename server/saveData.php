<?php
/**
 * Created by @mriso_dev.
 * Date: 22/12/16
 * Time: 01:09
 */

include_once('pdo.php');

$msg = $_POST['chatMsg'];
$time = date("Y-m-d H:i:s");

# User and Room are fake and hardcoded just for display - this is up to you
# REPLACE THE USER VAR BELOW WITH YOUR AUTH SESSION DATA
$sql = "Insert into messages (message, user, room, sent_at) values (:msg, 1, 1, '{$time}')";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':msg', $msg, PDO::PARAM_STR);
$exec = $stmt->execute();

/**
 * The user info bellow is a DUMMY
 */
if($exec) {
    echo json_encode(['status'=>'saved ok.', 'user'=>'Dummy Guy', 'room'=>1, 'sent_at'=>$time, 'msg'=>$msg]);
}else{
    echo json_encode(['status'=>'error while saving.']);
}
