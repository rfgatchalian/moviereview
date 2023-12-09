<?php

namespace App\Http\Requests;

use App\Models\Genre;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGenreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('genre_edit');
    }

    public function rules()
    {
        return [
            'genre_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
