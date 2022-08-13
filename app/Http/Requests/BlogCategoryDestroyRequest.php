<?php
// Command: php artisan make:request BlogCategoryDestroyRequest

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     public function authorize()
    {
        return !($this->route('blog_category') == config('cms.default_category_id'));
    }

    public function forbiddenResponse()
    {
        return redirect()->back()->with('error-message', 'You cannot delete default category!');
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
