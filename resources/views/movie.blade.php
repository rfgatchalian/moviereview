@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('users/assets/css/index.css') }}">
    <style>
        * {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            box-sizing: border-box;
            margin: 0;
        }

        body {

            background-repeat: repeat;

        }

        .search-container {
            width: 81%;
            margin-top: 75px;
            margin-left: 145px;
            position: relative;
            box-shadow: 0 8px 32px 0 rgba(170, 163, 163, 0.37);

        }

        #searchInput {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        #suggestionBox {
            display: none;
            position: absolute;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-top: none;
            background-color: #fff;
            /* Background color for suggestions */
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }

        .suggest {
            padding: 10px;
            cursor: pointer;
        }

        .suggest:hover {
            background-color: #f0f0f0;
            /* Background color on hover */
        }

        #movie-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 100px;
        }

        .custom-card {
            width: 300px;
            height: 600px;
            margin: 5px;
            margin-top: 20px;
            padding: 10px;
            display: flex;
            border-radius: 10px;
            flex-direction: column;
            justify-content: flex-start;
            border: 1px dashed #ccc;
            box-sizing: border-box;
            box-shadow: 0 8px 32px 0 rgba(170, 163, 163, 0.37);
            backdrop-filter: blur(100px);
            -webkit-backdrop-filter: blur(4px);
        }

        .custom-card:hover img {
            transform: scale(0.95);
            /* Make only the image slightly smaller on hover */
        }


        .card-img-container {
            flex: 1;
            /* Let the image container take up remaining space */
            display: flex;
            align-items: stretch;
            /* Align the image to stretch vertically */
            justify-content: center;
            margin-bottom: 1px;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            /* Adjust as needed */
        }


        .movie-title a {
            font-weight: bold;
            font-size: medium;
            color: #ffbd59;
            margin-top: 0px;
            margin-bottom: 5px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-decoration: none;
            cursor: pointer;
            /* Add cursor pointer for better UX */
        }


        .card-text {
            font-size: small;
            color: white;
            text-align: justify;
            margin-bottom: 10px;
            /* Adjust as needed */
            overflow: hidden;
            /* Hide overflow to prevent extra space */
            text-overflow: ellipsis;
            /* Add ellipsis for long text */
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Show up to 3 lines of text */
            -webkit-box-orient: vertical;
        }
    </style>
@endsection
@section('content')
    <div class="search-container fixed-top">
        <input type="text" id="searchInput" onchange="handleInputChange()" placeholder="Search..." class="form-control me-2">
        <div id="suggestionBox"></div>
    </div>
    <div id="movie-container">

    </div>
@endsection
@section('scripts')
<script>
     $('#searchInput').keyup(function() {
                var query = $(this).val().trim();

                if (query !== '') {
                    $.ajax({
                        url: '{{route('user.searchMovie')}}',
                        method: 'GET',
                        data: {
                            search: query
                        },
                        success: function(data) {
                            console.log(data);
                            $('#suggestionBox').fadeIn();
                            $('#suggestionBox').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#suggestionBox').fadeOut();
                    $('#suggestionBox').html(''); // Clear the suggestion box content
                }
            });
    function getMovies(search) {
        $.ajax({
            url: '/get-movies?search='+search+'',
            type: 'GET',
            success: function(response) {

                $('#movie-container').html(response.html);
                // $('#update-modal-container').append(response.updatemodal);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        getMovies(null);

    });
    function handleInputChange() {
        var inputValue = document.getElementById('searchInput').value;
            getMovies(inputValue);
        }

        </script>
@endsection
