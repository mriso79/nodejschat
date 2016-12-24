<?php
/**
 * Created by @mriso_dev.
 * Date: 22/12/16
 * Time: 01:09
 */

include_once('pdo.php');

$room = $_POST['room'];
$stmt = $pdo->prepare("SELECT * from messages where room = :room order by sent_at asc");
$stmt->bindParam(':room', $room, PDO::PARAM_STR);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['status'=>'ok', 'data'=>$data]);
