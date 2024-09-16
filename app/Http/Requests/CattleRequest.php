<?php

// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Rule;

// class CattleRequest extends FormRequest
// {
//     public function rules(): array
//     {
//         return [
//             'tagId' => ['unique:cattle,tagId'],
//             'type' => ['required'],
//             'sex' => ['required',Rule::in(['male','female'])],
//             'marketValue' => ['nullable', 'numeric'],
//             'bodyWeight' => ['nullable', 'numeric'],
//             'dateOfBirth' => ['date','before_or_equal:today'],
//             'breed' => ['nullable'],
//             'coatColor' => ['nullable'],
//             'entryDate' => ['nullable', 'date','before_or_equal:today'],
//             'source' => ['nullable'],
//             'purchaseAmount' => ['nullable', 'numeric'],
//             'parents' => ['nullable'],
//             'parentM' => ['nullable'],
//             'status' => ['required',Rule::in(['Available', 'Quarantined', 'Leased', 'Sold', 'Missing', 'Dead', 'Unspecified'])],
//         ];
//     }

//     public function authorize(): bool
//     {
//         return true;
//     }
// }