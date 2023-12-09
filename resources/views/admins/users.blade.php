@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/adminIndex.css') }}">
@endsection

@section('content')
    <div class="container" style="margin-top: 90px">
        <div id="usersTable" class="table-responsive">
        <table class="table table-bordered table-striped table-hover" >
            <thead>
                <tr>
                    <th style="background-color: #ffbd59;">Name</th>
                    <th style="background-color: #ffbd59;">Email</th>
                    <th style="background-color: #ffbd59;">Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    </div>
@endsection

@section('scripts')
<script>
    function getUser() {
        $.ajax({
            url: '/admins/get-users',
            type: 'GET',
            success: function(response) {
                console.log(response.test);
                $('#usersTable').html(response.data);
                // $('#update-modal-container').append(response.updatemodal);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        getUser(null);

    });

    function deleteData(id) {

var result = confirm("Are you sure to delete?");
if(result){
    $.ajax({
    url: "{{ route('admins.deleteUser') }}",
    type: 'POST',
    data: {id: id},
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
    success: function (response) {
        // Handle success, for example, close the modal and show a success message
        getMovies(null);
    },
    error: function (xhr) {
        // Handle errors, for example, display an error message
        alert('Error updating data. Please try again.');
    }
});
}
}
</script>
@endsection
