<?php
    require_once '../global-includes/crud.php';

    $crud = new Crud();

    $query = "SELECT id, title, description, poster_image FROM admin";
    $result = $crud->execute_query($query);

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Sending a proper JSON header
    header('Content-Type: application/json');

    // Sending a JSON response
    echo json_encode($data);
?>
