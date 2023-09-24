<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute が未承認です',
    'accepted_if'          => ':other が :value であるとき :attribute を承認してください',
    'active_url'           => ':attribute は有効なURLではありません',
    'after'                => ':attribute は :date より後の日付にしてください',
    'after_or_equal'       => ':attribute は :date 以降の日付にしてください',
    'alpha'                => ':attribute は英字のみ有効です',
    'alpha_dash'           => ':attribute は「英字」「数字」「-(ダッシュ)」「_(下線)」のみ有効です',
    'alpha_num'            => ':attribute は「英字」「数字」のみ有効です',
    'array'                => ':attribute は配列タイプのみ有効です',
    'ascii'                => ':attribute はASCIIに含まれる文字のみ有効です',
    'before'               => ':attribute は :date より前の日付にしてください',
    'before_or_equal'      => ':attribute は :date 以前の日付にしてください',
    'between'              => [
        'numeric' => ':attribute は :min ～ :max までの数値まで有効です',
        'file'    => ':attribute は :min ～ :max キロバイトまで有効です',
        'string'  => ':attribute は :min ～ :max 文字まで有効です',
        'array'   => ':attribute は :min ～ :max 個まで有効です',
    ],
    'boolean'              => ':attribute の値は true もしくは false のみ有効です',
    'confirmed'            => ':attribute を確認用と一致させてください',
    'current_password'     => 'パスワードが一致しません',
    'date'                 => ':attribute を有効な日付形式にしてください',
    'date_equals'          => ':attribute を :date と一致させてください',
    'date_format'          => ':attribute を :format 書式と一致させてください',
    'decimal'              => ':attribute は 小数点以下が:decimal桁含まれなければなりません.',
    'declined'             => ':attribute は 否定する必要があります.',
    'declined_if'          => ':attribute は :other が :valueであるときに否定する必要があります.',
    'different'            => ':attribute を :other と違うものにしてください',
    'digits'               => ':attribute は :digits 桁のみ有効です',
    'digits_between'       => ':attribute は :min ～ :max 桁のみ有効です',
    'dimensions'           => ':attribute ルールに合致する画像サイズのみ有効です',
    'distinct'             => ':attribute に重複している値があります',
    'doesnt_end_with'      => ':attribute は :values のいずれかが末尾になってはいけません',
    'doesnt_start_with'    => ':attribute は :values のいずれかで始まってはいけません',
    'email'                => ':attribute メールアドレスの書式のみ有効です',
    'ends_with'            => ':attribute は :values のいずれかが末尾である必要があります',
    'enum'                 => ':attribute というクラスはありません',
    'exists'               => ':attribute 無効な値です',
    'file'                 => ':attribute アップロード出来ないファイルです',
    'filled'               => ':attribute 値を入力してください',
    'gt'                   => [
        'numeric' => ':attribute は :value より大きい必要があります。',
        'file'    => ':attributeは :value キロバイトより大きい必要があります。',
        'string'  => ':attribute は :value 文字より多い必要があります。',
        'array'   => ':attribute には :value 個より多くの項目が必要です。',
    ],
    'gte'                  => [
        'numeric' => ':attribute は :value 以上である必要があります。',
        'file'    => ':attribute は :value キロバイト以上である必要があります。',
        'string'  => ':attribute は :value 文字以上である必要があります。',
        'array'   => ':attribute には value 個以上の項目が必要です。',
    ],
    'image'                => ':attribute 画像は「jpg」「png」「bmp」「gif」「svg」のみ有効です',
    'in'                   => ':attribute 無効な値です',
    'in_array'             => ':attribute は :other と一致する必要があります',
    'integer'              => ':attribute は整数のみ有効です',
    'ip'                   => ':attribute IPアドレスの書式のみ有効です',
    'ipv4'                 => ':attribute IPアドレス(IPv4)の書式のみ有効です',
    'ipv6'                 => ':attribute IPアドレス(IPv6)の書式のみ有効です',
    'json'                 => ':attribute 正しいJSON文字列のみ有効です',
    'lowercase'            => ':attribute は小文字のみ有効です',
    'lt'                   => [
        'numeric' => ':attribute は :value 未満である必要があります。',
        'file'    => ':attribute は :value キロバイト未満である必要があります。',
        'string'  => ':attribute は :value 文字未満である必要があります。',
        'array'   => ':attribute は :value 未満の項目を持つ必要があります。',
    ],
    'lte'                  => [
        'numeric' => ':attribute は :value 以下である必要があります。',
        'file'    => ':attribute は :value キロバイト以下である必要があります。',
        'string'  => ':attribute は :value 文字以下である必要があります。',
        'array'   => ':attribute は :value 以上の項目を持つ必要があります。',
    ],
    'mac_address' => ':attribute は有効なMACアドレスである必要があります。',
    'max'                  => [
        'numeric' => ':attribute は :max 以下のみ有効です',
        'file'    => ':attribute は :max KB以下のファイルのみ有効です',
        'string'  => ':attribute は :max 文字以下のみ有効です',
        'array'   => ':attribute は :max 個以下のみ有効です',
    ],
    'max_digits'  => ':attribute は :max 桁以下の値のみ有効です',
    'mimes'                => ':attribute は :values タイプのみ有効です',
    'mimetypes'            => ':attribute は :values タイプのみ有効です',
    'min'                  => [
        'numeric' => ':attribute は :min 以上のみ有効です',
        'file'    => ':attribute は :min KB以上のファイルのみ有効です',
        'string'  => ':attribute は :min 文字以上のみ有効です',
        'array'   => ':attribute は :min 個以上のみ有効です',
    ],
    'min_digits' => ':attribute は :max 桁以上の値のみ有効です',
    'missing' => ':attribute は存在しない必要があります',
    'missing_if' => ':attribute は :other が:value であるときに存在しない必要があります',
    'missing_unless' => ':attribute は :other が:value ではないときに存在しない必要があります',
    'missing_with' => ':attribute は :other のいずれかが入力されているときに存在しない必要があります',
    'missing_with_all' => ':attribute は :other のすべてが入力されているときに存在しない必要があります',
    'multiple_of' => ':attribute は :value の倍数である必要があります',
    'not_in'               => ':attribute は無効な値です',
    'not_regex'            => ':attribute は無効な値です',
    'numeric'              => ':attribute は数字のみ有効です',
    'password' => [
        'letters' => ':attribute は1文字以上必要です',
        'mixed' => ':attribute は大文字と小文字がそれぞれ必要です',
        'numbers' => ':attribute は1文字以上の数字が必要です',
        'symbols' => ':attribute は1文字以上の記号が必要です',
        'uncompromised' => ':attribute は流出している可能性があります。別の値を入力してください',
    ],
    'present'              => ':attribute が存在しません',
    'prohibited'           => ':attribute は無入力である必要があります',
    'prohibited_if'        => ':attribute は :other が :value である場合に無入力である必要があります',
    'prohibited_unless'    => ':attribute は :other が :value ではない場合に無入力である必要があります',
    'prohibits'            => ':attribute を入力する場合 :other が無入力である必要があります',
    'regex'                => ':attribute 無効な値です',
    'required'             => ':attribute は必須です',
    'required_array_keys'  => ':attribute は配列であり、:values が含まれていなければなりません',
    'required_if'          => ':attribute は :other が :value には必須です',
    'required_if_accepted' => ':attribute は :other が認可されている場合は必須です',
    'required_unless'      => ':attribute は :other が :values でなければ必須です',
    'required_with'        => ':attribute は :values が入力されている場合は必須です',
    'required_with_all'    => ':attribute は :values が入力されている場合は必須です',
    'required_without'     => ':attribute は :values が入力されていない場合は必須です',
    'required_without_all' => ':attribute は :values が入力されていない場合は必須です',
    'same'                 => ':attribute は :other と同じ場合のみ有効です',
    'size'                 => [
        'numeric' => ':attribute は :size のみ有効です',
        'file'    => ':attribute は :size KBのみ有効です',
        'string'  => ':attribute は :size 文字のみ有効です',
        'array'   => ':attribute は :size 個のみ有効です',
    ],
    'starts_with'          => ':attribute は :values のいずれかから始まっている必要があります',
    'string'               => ':attribute は文字列のみ有効です',
    'timezone'             => ':attribute 正しいタイムゾーンのみ有効です',
    'unique'               => ':attribute は既に存在します',
    'uploaded'             => ':attribute アップロードに失敗しました',
    'uppercase'            => ':attribute は大文字のみ有効です',
    'url'                  => ':attribute は正しいURL書式のみ有効です',
    'ulid'                 => ':attribute はULIDのみ有効です',
    'uuid'                 => ':attribute はUUIDのみ有効です',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
