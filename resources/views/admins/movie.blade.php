@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/adminIndex.css')}}">

@endsection
@section('content')

    <div class="container box" style="margin-top: 7%;">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" id="openAddModal">Add Movie</button>
        <br><br>
        <input type="text" id="searchInput" placeholder="Search" onchange="handleInputChange()" class="form-control">
        <div id="suggestionBox"></div>
        <div id="searchResult"></div>
        <br>
        <div id="user_table" class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="background-color: #ffbd59; text-align: center;">Image</th>
                        <th style="background-color: #ffbd59; text-align: center;">Title</th>
                        <th style="background-color: #ffbd59; text-align: center;">Genre</th>
                        <th style="background-color: #ffbd59; text-align: center;">Director</th>
                        <th style="background-color: #ffbd59; text-align: center;">Main Cast</th>
                        <th style="background-color: #ffbd59; text-align: center;" >Description</th>
                        <th style="background-color: #ffbd59; text-align: center;">Trailer</th>
                        <th style="background-color: #ffbd59; text-align: center;">Actions
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <div class="update-modal-container" id="update-modal-container">

    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 80px;">
            <div class="modal-content">
                <form id="user_form" >
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-weight: bold">Add Movie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control" required="">

                        <label>Genre</label>
                        <input type="text" name="genres" id="genres" class="form-control" required="">

                        <label>Director</label>
                        <input type="text" name="director" id="director" class="form-control" required="">

                        <label>Main Cast</label>
                        <input type="text" name="cast" id="cast" class="form-control" required="">

                        <label>Description</label><br>
                        <textarea name="description" id="description" style="width: 100%; height:auto" required=""></textarea><br>

                        <label>Trailer</label>
                        <input type="text" name="trailer" id="trailer" class="form-control" required="">

                        <label>Select Poster Image</label><br>
                        <input type="file" name="file" id="file" required="">

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" value="Insert">
                        <input type="submit" name="button_action" class="btn btn-info btn-md" value="Add">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function getMovies(search) {
            $.ajax({
                url: '/admins/get-movies?search='+search+'',
                type: 'GET',
                success: function(response) {
                    console.log(response.test);
                    $('#user_table').html(response.data);
                    $('#update-modal-container').append(response.updatemodal);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    $(document).ready(function() {
        getMovies(null);
        $('#user_form').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '{{ route('admins.createMovie') }}',
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log($(this).serialize());
                        console.log(response.data)
                        getMovies(null);


                        $('#addModal').modal('hide');

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
        function updateData(id) {
        // Use AJAX to send a POST request to the update route
        console.log(id);
        $.ajax({
            url: "{{ route('admins.updateMovie') }}",
            type: 'POST',
            data: $('#update_user_form'+id).serialize(),
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            success: function (response) {
                console.log(response.data)
                // Handle success, for example, close the modal and show a success message
                getMovies(null);

                $('#updateModal'+id).modal('hide');

            },
            error: function (xhr) {
                // Handle errors, for example, display an error message
                alert('Error updating data. Please try again.');
            }
        });
    }

    function handleInputChange() {
        var inputValue = document.getElementById('searchInput').value;
            getMovies(inputValue);
        }

</script>
@endsection
