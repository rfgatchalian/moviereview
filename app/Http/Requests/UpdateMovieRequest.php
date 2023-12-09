<?php

namespace App\Http\Requests;

use App\Models\Movie;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMovieRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('movie_edit');
    }

    public function rules()
    {
        return [
            'genres.*' => [
                'integer',
            ],
            'genres' => [
                'array',
            ],
            'title' => [
                'string',
                'nullable',
            ],
            'cast' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'trailer' => [
                'string',
                'nullable',
            ],
            'director' => [
                'string',
                'nullable',
            ],
        ];
    }
}
