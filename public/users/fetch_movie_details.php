<?php
if (isset($_POST['title'])) {
    $movieTitle = $_POST['title'];

    // Establish a connection to the database (using your existing CRUD class)
    require_once '../global-includes/crud.php';
    $crud = new Crud();

    // Prepare the statement
    $query = "SELECT * FROM admin WHERE title = ?";
    $stmt = $crud->connect->prepare($query);
    $stmt->bind_param('s', $movieTitle); // 's' indicates a string parameter
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $movieDetails = $result->fetch_assoc();
        echo json_encode($movieDetails);
    } else {
        echo json_encode(['error' => 'No movie found']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request']);
}
