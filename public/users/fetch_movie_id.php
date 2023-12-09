<?php

    // Check if 'title' parameter is received via POST
    if (isset($_POST['title'])) {
        // Sanitize the received title
        $movieTitle = $_POST['title'];

        // Establish a connection to the database (using your existing CRUD class or connection method)
        require_once '../global-includes/crud.php'; // Adjust the path as needed
        $crud = new Crud(); // Instantiate your CRUD class

        // Prepare the statement to fetch the ID based on the title
        $query = "SELECT id FROM admin WHERE title = ?";
        
        // Prepare the statement and check for errors
        $stmt = $crud->connect->prepare($query);

        if (!$stmt) {
            echo json_encode(['error' => $crud->connect->error]); // Return the specific error message
        } else {
            $stmt->bind_param('s', $movieTitle); // 's' indicates a string parameter
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch the ID and return it as JSON
                $row = $result->fetch_assoc();
                echo json_encode($row['id']);
            } else {
                echo json_encode(null); // Return null if no ID is found for the title
            }

            $stmt->close();
        }
    } else {
        echo json_encode(null); // Return null for an invalid request (no title parameter)
    }
?>
