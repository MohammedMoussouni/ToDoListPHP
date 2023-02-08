<?php

include_once 'config.php';

global $db;

$requestBody = file_get_contents('php://input');

$data = json_decode($requestBody, true);


$action =(isset($_POST['action'])) ? $_POST['action'] : $data['action'];

switch ($action){
    case 'add_task':
        addTask();
        break;
    case 'update_task':
        updateTask($data);
        break;
    case 'delete_task':
        deleteTask($data);
        break;

    default:
    # code
    break;
}

if ($action === 'delete_task'){
    echo "suppression demandée";
}

function addTask(): void {

    global $db;

    if (!isset($_POST['taskName'])) return;

    $db->addtask($_POST['taskName']);

    echo json_encode([
        'code' => 'ADD_TASK_OK',
        'taskId' => $db->getDatabase()->lastInsertRowID(),
        'taskName' => $_POST['taskName']
    ]);
}

function updateTask(array $data){
    global $db;

    if(!isset($data['taskId'], $data['done'])) return;

    $db->updateTask(intval($data['taskId']), intval($data['done']));

    echo json_encode([
        'code'=> 'UPDATE_TASK_OK'
    ]);
}


function deleteTask($data){
    global $db;

    if(!isset($data['taskId'])) return;

    $db->deleteTask(intval($data['taskId']));

    echo json_encode([
        'code'=> 'TASK_DELETED'
    ]);
}












?>