<?php

namespace App\Http\Requests\Timetable;

use Illuminate\Foundation\Http\FormRequest;

class TimetableStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lang_id' => 'required',
            'time_categories_id' => 'required',
            'title' => 'required|max:255',
             'image' => 'required',
            'date' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'trainer' => 'required',
            'color' => 'required',
            'content' => 'required',
           

            
        ];
        
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'The title field is required',
            'date.required' => 'The date field is required',
            'day.required' => 'The day field is required',
            'start_time.required' => 'Start Time field is required',
            'end_time.required' => 'The End Time name field is required',
            'trainer.required' => 'The Trainer field is required',
            'color.required' => 'The Color field is required',
            'content.required' => 'The Content field is required',
            'image.required' => 'The slider image field is required',
            'lang_id.required' => 'The language field is required',
            'time_categories_id.required' => 'The category field is required'
        ];
    }
}
