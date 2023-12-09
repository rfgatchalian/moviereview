<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Review & Rating System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../assets/css/add_review.css">
 
</head>

<body>
    <div class="container">
        <a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-outline-light" style="position: fixed; top: 10px; left: 10px;">Back</a>
        <div class="card">
            <?php
            require_once '../global-includes/crud.php';
            $crud = new Crud(); // Instantiate your CRUD class

            // Check if 'id' is set in the URL parameters
            if (isset($_GET['id'])) {
                // Get the movie ID from the URL
                $movie_id = $_GET['id'];

                // Fetch movie details based on the ID using your CRUD method
                $movie_details = $crud->getMovieDetails($movie_id); // Modify this method based on your implementation

                // Check if movie details were found
                if ($movie_details) {
                    $image_path = $movie_details['poster_image'];


                    echo '<table>';
                    echo '<tr>';
                    echo '<td style="vertical-align: top;">';
                    echo '<img src="../upload/' . $image_path . '" alt="Movie Poster"  width="300" height="450">';
                    echo '</td>';
                    echo '<td style="padding: 0 70px 70px 70px;">';
                    echo '<h1 class="title mb-0 mt-0 "> ' . $movie_details['title'] . '</h1>';
                    echo '<p><strong class="sub-title">Genre:</strong> ' . $movie_details['genre'] . '</p>';
                    echo '<p cl<p><strong class="sub-title">Director:</strong> ' . $movie_details['director'] . '</p>';
                    echo '<p><strong class="sub-title">Main Cast:</strong> ' . $movie_details['cast'] . '</p>';
                    echo '<p style="text-align:justify;"><strong class="sub-title">Description:</strong> ' . $movie_details['description'] . '</p>';
                    // Check if the trailer is available
                    if (!empty($movie_details['trailer'])) {
                        echo '<p><strong>Trailer:</strong> <a href="' . $movie_details['trailer'] . '" target="_blank">Watch Trailer</a></p>';
                    } else {
                        echo '<p><strong>Trailer:</strong> Not available</p>';
                    }

                    echo '</td>';
                    echo '</tr>';
                    echo '</table>';
                } else {
                    echo 'Movie details not found';
                }
            }
            ?>

            <div class="card-header" style="font-size: 20px; font-weight:bolder; color:black;">Ratings & Reviews</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating">0.0</span> / 5</b>
                        </h1>
                        <div class="mb-3">
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                        </div>
                        <h3><span id="total_review">0</span> Review</h3>
                    </div>
                    <div class="col-sm-4">
                        <p>
                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                        </div>
                        </p>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3 class="mt-4 mb-3">Write Review Here</h3>
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary" style="background-color: #d9a500; color:black; font-weight:bold;">Review</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5" id="review_content"></div>
    </div>
</body>

</html>

<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="review_form" class="modal-body">
                <h4 class="text-center mt-2 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                </h4>
                <div class="form-group">
                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
                </div>
                <div class="form-group">
                    <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                </div>
                <div class="form-group text-center mt-4">
                    <button type="button" class="btn btn-primary" id="save_review" style="background-color: #d9a500; color:black; font-weight:bold;">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }

    .progress-label-right {
        float: right;
        margin-right: 0.3em;
        line-height: 1em;
    }

    .star-light {
        color: #e9ecef;
        /* Define the desired color or styling */
    }
</style>

<script>
    var rating_data = 0;

    function getQueryParam(paramName) {
        var queryString = window.location.search.substring(1);
        var params = queryString.split('&');

        for (var i = 0; i < params.length; i++) {
            var pair = params[i].split('=');
            if (pair[0] === paramName) {
                return decodeURIComponent(pair[1]);
            }
        }

        return null; // Parameter not found
    }

    $('#add_review').click(function() {

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function() {

        var rating = $(this).data('rating');

        reset_background();

        for (var count = 1; count <= rating; count++) {

            $('#submit_star_' + count).addClass('text-warning');

        }

    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {

            $('#submit_star_' + count).addClass('star-light');

            $('#submit_star_' + count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function() {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

            $('#submit_star_' + count).removeClass('star-light');

            $('#submit_star_' + count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function() {
        rating_data = $(this).data('rating');
    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {
            $('#submit_star_' + count).addClass('star-light');
            $('#submit_star_' + count).removeClass('text-warning');
        }
    }

    $('#save_review').click(function() {
        var user_name = $('#user_name').val();
        var user_review = $('#user_review').val();
        const id = getQueryParam('id');

        var currentDateTime = new Date().toISOString().slice(0, 19).replace('T', ' ');

        if (user_name == '' || user_review == '') {
            alert("Please Fill Both Fields");
            return false;
        } else {
            $.ajax({
                url: "../users/submit_rating.php",
                method: "POST",
                data: {
                    action: rating_data,
                    rating_data: rating_data,
                    user_name: user_name,
                    user_review: user_review,
                    id: id,
                    datetime: currentDateTime
                },
                success: function(data) {
                    $('#review_modal').modal('hide');
                    $('#user_name').val('');
                    $('#user_review').val('');
                    reset_background();
                    alert("Review submitted successfully!");
                    load_rating_data();
                    // Update the review content automatically
                    loadReviewContent();
                    alert(data);
                }
            });
        }
    });

    load_rating_data();

    function load_rating_data() {
        $.ajax({
            url: "../users/submit_rating.php",
            method: "POST",
            data: {
                action: 'load_data',
                id: getQueryParam('id')
            },
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function() {
                    count_star++;
                    if (Math.ceil(data.average_rating) >= count_star) {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                if (data.review_data.length > 0) {
                    var html = '';

                    for (var count = 0; count < data.review_data.length; count++) {
                        html += '<div class="row mb-3">';

                        html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">' + data.review_data[count].user_name.charAt(0) + '</h3></div></div>';

                        html += '<div class="col-sm-11">';

                        html += '<div class="card">';

                        html += '<div class="card-header"><b>' + data.review_data[count].user_name + '</b></div>';

                        html += '<div class="card-body">';

                        for (var star = 1; star <= 5; star++) {
                            var class_name = '';

                            if (data.review_data[count].rating >= star) {
                                class_name = 'text-warning';
                            } else {
                                class_name = 'star-light';
                            }

                            html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                        }

                        html += '<br />';

                        html += data.review_data[count].user_review;

                        html += '</div>';

                        html += '<div class="card-footer text-right">On ' + data.review_data[count].datetime + '</div>';

                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    }

                    $('#review_content').html(html);
                }
            }
        })

        $(document).on('submit', '#review_form', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Collect form data
            var formData = {
                rating: rating_data,
                user_name: $('#user_name').val(),
                user_review: $('#user_review').val(),
                movie_id: getQueryParam('id') // Assuming you have a function for getting query parameters
            };
        });

    }
</script>