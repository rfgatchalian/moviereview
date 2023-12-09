<?php 
require_once '../global-includes/crud.php';
$crud = new Crud(); // Assuming you've instantiated the Crud class

if (isset($_POST["action"]) && $_POST["action"] === "load_data") {
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();
    $movie_id = $_POST['id'];

    // Assuming $crud is your Crud class instance with a method execute_query
    $query = "SELECT * FROM review_table WHERE movie_id=" . $movie_id;

    // Execute the query using your Crud class
    $result = $crud->execute_query($query);

    if ($result) {
        foreach ($result as $row) {
            // Retrieve and format review data
            $review_content[] = array(
                'user_name'     => $row["user_name"],
                'user_review'   => $row["user_review"],
                'rating'        => $row["user_rating"],
                'datetime'      => date('l jS, F Y h:i:s A', strtotime($row["datetime"]))
            );

            // Counting star ratings
            switch ($row["user_rating"]) {
                case '5':
                    $five_star_review++;
                    break;
                case '4':
                    $four_star_review++;
                    break;
                case '3':
                    $three_star_review++;
                    break;
                case '2':
                    $two_star_review++;
                    break;
                case '1':
                    $one_star_review++;
                    break;
            }

            $total_review++;
            $total_user_rating += $row["user_rating"];
        }

        if ($total_review > 0) {
            $average_rating = $total_user_rating / $total_review;
        }

        $output = array(
            'average_rating'    => number_format($average_rating, 1),
            'total_review'      => $total_review,
            'five_star_review'  => $five_star_review,
            'four_star_review'  => $four_star_review,
            'three_star_review' => $three_star_review,
            'two_star_review'   => $two_star_review,
            'one_star_review'   => $one_star_review,
            'review_data'       => $review_content
        );

        // Set response header to JSON
        header('Content-Type: application/json');

        // Return the JSON-encoded output
        echo json_encode($output);
    } else {
        echo "Error: Failed to retrieve review data";
    }
} elseif (
    isset($_POST["rating_data"]) &&
    isset($_POST["user_name"]) &&
    isset($_POST["user_review"]) &&
    isset($_POST["id"]) &&
    isset($_POST["datetime"]) // Ensure datetime is also checked
) {
    // Retrieve data sent via Ajax request
    $rating_data = $_POST["rating_data"];
    $user_name = $_POST["user_name"];
    $user_review = $_POST["user_review"];
    $movie_id = $_POST['id']; // Assuming 'id' refers to the movie ID
    $datetime = $_POST["datetime"]; // Retrieve datetime
    // Get the current date and time
    $currentDateTime = date('Y-m-d H:i:s');

    // Validate and sanitize the data (perform necessary validations)

    // Your existing database connection logic from Crud class
    
    // Insert data into the database
    // Assuming you have a method within Crud for inserting review data
    $query_execution_success = $crud->insertReview($movie_id, $user_name, $user_review, $rating_data, $currentDateTime);

    // Return a response indicating success or failure
    if ($query_execution_success) {
        echo "Your Review & Rating Successfully Submitted";
    } else {
        echo "Error: Review submission failed";
    }
} else {
    echo "Error: Incomplete data received";
}
