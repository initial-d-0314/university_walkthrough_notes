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
            //日時に関するバリデーション部分,
        ];
    }
    /*
    *バリデーションに追加の条件を課す関数
    */
    public function withValidator(\Illuminate\Contracts\Validation\Validator $validator)
    {
    //時刻設定を使うボタンがオンであるならバリデーションをする、オフならしないという記述
    //めっちゃ詰まったのでここに記す：$thisで入力内容が取れるけど->post['~']にしないとnullが取得される
        $validator->sometimes(['post.stdate','post.endate'], 'required | date', function ($input) {
            return !empty($this->post['use_time']);
        });
        $validator->sometimes(['post.sttime','post.entime'], 'required | date_format:H:i', function ($input) {
            return !empty($this->post['use_time']);
        });
        $validator->sometimes(['start_time','end_time'], 'required | date_format:Y/m/d H:i:s', function ($input) {
            return !empty($this->post['use_time']);
        });
        $validator->sometimes(['end_time'], 'after:start_time', function ($input) {
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
        $this->merge(['start_time' => $start_time,'end_time' => $end_time,]);
        }
    }
    
    public function attributes()
    {
        return [
            'post.title' => 'タイトル',
            'post.body' => '本文',
            'post.category_id' => 'カテゴリ',
            'post.university_id' => '大学',
            'post.stdate' => '開始日',
            'post.endate' => '終了日',
            'post.sttime' => '開始時刻',
            'post.entime' => '終了時刻',
            'start_time' => '開始日時',
            'end_time'=> '終了日時',
        ];
    }
}
