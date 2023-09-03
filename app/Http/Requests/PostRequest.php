<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'post.title' => 'required|string|max:100',
            'post.body' => 'required|string|max:2000',
            'post.category_id' => 'required|numeric|max:1000',
            'post.university_id' => 'required|numeric|max:1000',
        ];
    }
    /*
    *バリデーションに追加の条件を課す関数
    */
    public function withValidator(\Illuminate\Contracts\Validation\Validator $validator)
    {
    //時刻設定を使うボタンがオンであるならバリデーションをする
    //オフならしない
    //dd($this->post);
    //めっちゃ詰まったのでここに記す：$thisで入力内容が取れるけど->postにしないとnullが見えるよ
    
        $validator->sometimes(['post.stdate','post.endate'], 'required | date', function ($input) {
            return !empty($this->post['use_time']);
        });
        $validator->sometimes(['post.sttime','post.entime'], 'required | date_format:H:i', function ($input) {
            return !empty($this->post['use_time']);
        });
        $validator->sometimes('post.start_time', 'date_format:"Y/m/d H:i:s"', function ($input) {
            return !empty($this->post['use_time']);
        });
        $validator->sometimes('post.end_time', 'date_format:"Y/m/d H:i:s"|after:post.start_time', function ($input) {
            return !empty($this->post['use_time']);
        });
    }


    /*
    *バリデーションの前に動作する関数
    */
    protected function prepareForValidation()
    {
    if(!empty($this->post['use_time'])){
    $start_time = $this->post['stdate'] .' '. $this->post['sttime']. ":00"; //文字列結合をする
    $end_time = $this->post['endate'] .' '. $this->post['entime']. ":00"; 
    $this->post += ['start_time' => $start_time,'end_time' => $end_time,];
        }
    }
}
