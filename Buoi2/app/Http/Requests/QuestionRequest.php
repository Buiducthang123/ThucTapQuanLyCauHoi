<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Content' => 'required|string|min:6|max:255',
            'OptionA' => 'required|string|max:255|not_in:' . implode(',', [$this->input('OptionB'), $this->input('OptionC'), $this->input('OptionD')]),
            'OptionB' => 'required|string|max:255|not_in:' . implode(',', [$this->input('OptionA'), $this->input('OptionC'), $this->input('OptionD')]),
            'OptionC' => 'required|string|max:255|not_in:' . implode(',', [$this->input('OptionA'), $this->input('OptionB'), $this->input('OptionD')]),
            'OptionD' => 'required|string|max:255|not_in:' . implode(',', [$this->input('OptionA'), $this->input('OptionB'), $this->input('OptionC')]),
            // 'CorrectOption' => 'required|string|in:' . implode(',', [$this->input('OptionA'), $this->input('OptionB'), $this->input('OptionC'), $this->input('OptionD')]),

        ];
    }

    public function messages() {
        return [
            'Content.required' => 'Trường Nội dung là bắt buộc.',
            'Content.string' => 'Trường Nội dung phải là một chuỗi.',
            'Content.min' => 'Độ dài trường Nội dung phải ít nhất :min ký tự.',
            'Content.max' => 'Độ dài trường Nội dung không được vượt quá :max ký tự.',
            'OptionA.required' => 'Đáp án A là bắt buộc.',
            'OptionA.string' => 'Đáp án A phải là một chuỗi.',
            'OptionA.not_in' => 'Giá trị của Đáp án A không được trùng với các giá trị của các trường đáp án khác.',
            'OptionB.required' => 'Đáp án B là bắt buộc.',
            'OptionB.string' => 'Đáp án B phải là một chuỗi.',
            'OptionB.not_in' => 'Giá trị của Đáp án B không được trùng với các giá trị của các trường Đáp án khác.',
            'OptionC.required' => 'Đáp án C là bắt buộc.',
            'OptionC.string' => 'Đáp án C phải là một chuỗi.',
            'OptionC.not_in' => 'Giá trị của Đáp án C không được trùng với các giá trị của các trường Đáp án khác.',
            'OptionD.required' => 'Đáp án D là bắt buộc.',
            'OptionD.string' => 'Đáp án D phải là một chuỗi.',
            'OptionD.not_in' => 'Giá trị của trường OptionD không được trùng với các giá trị của các trường Option khác.',
            'CorrectOption.required' => 'Vui lòng chọn đáp án đúng',
            'CorrectOption.string' => 'Trường đáp án đúng phải là một chuỗi.',
            'CorrectOption.in' => 'Giá trị của trường đáp án đúng phải là một trong các tùy chọn.',
        ];
    }
    // protected function failedValidation(Validator $validator)
    // {
    //     echo("hii");
    //     $this->redirector->back()
    //         ->withErrors($validator)
    //         ->withInput($this->input());
    // }

}
