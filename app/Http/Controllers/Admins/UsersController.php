<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admins.users');
    }
    public function getUsers(){
        $users = User::all();

        $html = '<table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="background-color: #ffbd59;">Name</th>
                <th style="background-color: #ffbd59;">Email</th>
                <th style="background-color: #ffbd59;">Action</th>
            </tr>
        </thead>
        <tbody>';
        foreach($users as $user){
            $html .= '<tr>
            <td>'.$user->name.'</td>
            <td>'.$user->email.'</td>
            <td class="action-buttons">
            <button type="button" name="delete" id="65" class="btn btn-danger"
                     onclick="deleteData('.$user->id.')">Delete</button>

            </td>
        </tr>';
        }

        $html .= '</tbody>
        </table>';


        foreach($users as $user){

        }

        return response()->json(['data' => $html]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $user = User::find($request->id);
        $user->delete();

        return response()->json(['data' => 'success']);
    }
}
