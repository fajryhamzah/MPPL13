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

    'accepted'             => ':attribute harus diterima.',
    'active_url'           => ':attribute bukan URL yang valid.',
    'after'                => ':attribute harus berupa tanggal setelah: tanggal.',
    'after_or_equal'       => ':attribute harus berupa tanggal setelah atau sama dengan :tanggal.',
    'alpha'                => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'           => ':attribute hanya boleh berisi huruf, angka, dan tanda hubung.',
    'alpha_num'            => ':attribute hanya boleh berisi huruf dan angka.',
    'array'                => ':attribute harus berupa array.',
    'before'               => ':attribute harus berupa tanggal sebelum: tanggal.',
    'before_or_equal'      => ':attribute harus berupa tanggal sebelum atau sama dengan: tanggal.',
    'between'              => [
        'numeric' => ':attribute harus antara: menit dan :maks.',
        'file'    => ':attribute harus antara: menit dan: maks kilobyte.',
        'string'  => ':attribute harus antara: min dan: max kilobytesThe: atribut harus antara: min dan: karakter maks.',
        'array'   => ':attribute harus memiliki antara: menit dan: item maksimum.',
    ],
    'boolean'              => ':attribute harus benar atau salah.',
    'confirmed'            => ':attribute konfirmasi tidak cocok.',
    'date'                 => ':attribute bukan tanggal yang valid.',
    'date_format'          => ':attribute tidak cocok dengan format: format.',
    'different'            => ':attribute dan: lainnya harus berbeda.',
    'digits'               => ':attribute harus: digit digit.',
    'digits_between'       => ':attribute harus antara: menit dan: digit maks.',
    'dimensions'           => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct'             => ':attribute memiliki nilai duplikat.',
    'email'                => ':attribute harus berupa alamat email yang valid.',
    'exists'               => ':attribute yang dipilih: tidak valid.',
    'file'                 => ':attribute harus berupa file.',
    'filled'               => ':attribute harus memiliki nilai.',
    'image'                => ':attribute harus berupa gambar.',
    'in'                   => ':attribute yang dipilih: tidak valid.',
    'in_array'             => ':attribute tidak ada di: lainnya.',
    'integer'              => ':attribute harus berupa bilangan bulat.',
    'ip'                   => ':attribute harus berupa alamat IP yang valid.',
    'ipv4'                 => ':attribute harus merupakan alamat IPv4 yang valid.',
    'ipv6'                 => ':attribute harus merupakan alamat IPv6 yang valid.',
    'json'                 => ':attribute harus berupa string JSON yang valid.',
    'max'                  => [
        'numeric' => ':attribute mungkin tidak lebih besar dari: maks.',
        'file'    => ':attribute mungkin tidak lebih besar dari: max kilobyte.',
        'string'  => ':attribute mungkin tidak lebih besar dari: karakter maks.',
        'array'   => ':attribute mungkin tidak memiliki lebih dari: item maksimum.',
    ],
    'mimes'                => ':attribute harus berupa file bertipe:: nilai.',
    'mimetypes'            => ':attribute harus berupa file bertipe:: nilai.',
    'min'                  => [
        'numeric' => ':attribute harus minimal: mnt.',
        'file'    => ':attribute harus setidaknya: min kilobyte.',
        'string'  => ':attribute harus setidaknya: karakter min.',
        'array'   => ':attribute harus memiliki setidaknya: item min.',
    ],
    'not_in'               => ':attribute yang dipilih: tidak valid.',
    'numeric'              => ':attribute harus berupa angka.',
    'present'              => ':attribute harus ada.',
    'regex'                => ':attribute Format yang tidak valid.',
    'required'             => ':attribute diperlukan.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

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
        'g-recaptcha-response' => [
            'required' => 'Buktikan bahwa anda bukan robot',
          'captcha' => 'Captcha error! try again later or contact site admin.',
         ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
