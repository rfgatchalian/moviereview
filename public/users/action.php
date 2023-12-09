<?php
include '../global-includes/crud.php';

$object = new Crud();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];

        switch ($action) {
            case "Load":
                echo $object->get_data_in_table("SELECT * FROM admin ORDER BY id DESC");
                break;
            case "Insert":
                handleInsertAction($object);
                break;
            case "Delete":
                handleDeleteAction($object);
                break;
            case "fetch_single":
                handleFetchSingleAction($object);
                break;
            case "Update":
                handleUpdateAction($object);
                break;
            case "getDetails":
                handleGetDetailsAction($object);
                break;
            case "search":
                handleSearchAction($object);
                break;
            case "searchAndLoadDetails":
                handleSearchAndLoadDetailsAction($object);
                break;
            default:
                // Handle unknown action
                break;
        }
    }
}

function handleInsertAction($object) {
    $title = mysqli_real_escape_string($object->connect, $_POST["title"]);
    $genre = mysqli_real_escape_string($object->connect, $_POST["genre"]);
    $cast = mysqli_real_escape_string($object->connect, $_POST["cast"]);
    $description = mysqli_real_escape_string($object->connect, $_POST["description"]);
    $trailer = mysqli_real_escape_string($object->connect, $_POST["trailer"]);
    $director = mysqli_real_escape_string($object->connect, $_POST["director"]);
    $image = $object->upload_file($_FILES["poster_image"]);

    if ($image) {
        $query = "INSERT INTO admin (title, genre, cast, description, trailer, director, poster_image) VALUES ('$title', '$genre', '$cast', '$description', '$trailer', '$director', '$image' )";
        if ($object->execute_query($query)) {
            echo 'Movie Inserted';
        } else {
            echo 'Error: ' . mysqli_error($object->connect);
        }
    } else {
        echo 'Error uploading image';
    }
}

function handleDeleteAction($object) {
    if (isset($_POST['delete_id'])) {
        $delete_id = mysqli_real_escape_string($object->connect, $_POST['delete_id']);
        $query = "DELETE FROM admin WHERE id = '$delete_id'";
        if ($object->execute_query($query)) {
            echo 'Movie Deleted';
        } else {
            echo 'Error deleting data: ' . mysqli_error($object->connect);
        }
    }
}

function handleFetchSingleAction($object) {
    if (isset($_POST['update_id'])) {
        $update_id = mysqli_real_escape_string($object->connect, $_POST["update_id"]);
        $query = "SELECT title, genre, cast, description, trailer, director FROM admin WHERE id='$update_id'";
    
        $result = $object->execute_query($query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row); // Return user data as JSON
        } else {
            echo json_encode(["error" => "Failed to fetch user data"]); // Return an error in JSON format
        }
    }
}

function handleUpdateAction($object) {
    $update_id = $_POST["update_id"];
    $update_title = $_POST["update_title"];
    $update_genre = $_POST["update_genre"];
    $update_cast = $_POST["update_cast"];
    $update_description = $_POST["update_description"];
    $update_trailer = $_POST["update_trailer"];
    $update_director = $_POST["update_director"];

    $new_image = null;
    if (!empty($_FILES["update_user_image"]["name"])) {
        $new_image = $object->upload_file($_FILES["update_user_image"]);
    }

    echo $object->update_user_data($update_id, $update_title, $update_genre, $update_cast, $update_description, $update_trailer, $update_director, $new_image);
}


function handleGetDetailsAction($object) {
    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
        // Perform a query to fetch details for the selected title
        $query = "SELECT * FROM admin WHERE title = '$title'";
        $detailsData = $object->get_data_in_table($query);

        // Return the HTML table containing the detailed information
        echo $detailsData;
    } else {
        echo '<div class="details">No title received</div>';
    }
}

function handleSearchAction($object) {
$query = $_POST['query'];
    $result = $object->execute_query("SELECT * FROM admin WHERE title LIKE '%$query%' LIMIT 10");

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="suggest">' . $row['title'] . '</div>';
        }
    } else {
        echo '<div class="suggest">No movie title found.</div>';
    }
}

function handleSearchAndLoadDetailsAction($object) {
    // Perform a query to fetch details for the selected title
    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
        $query = "SELECT * FROM admin WHERE title = '$title'";
        $detailsData = $object->get_data_in_table($query);

        // Return the HTML table containing the detailed information
        echo $detailsData;
    } else {
        echo '<div class="details">No title received</div>';
    }
}
?>
