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

    'accepted' => ':attribute должен быть принят.',
    'accepted_if' => ':attribute должен быть принят когда :other = :value.',
    'active_url' => ':attribute не корректный URL.',
    'after' => ':attribute должен быть датой больше :date.',
    'after_or_equal' => ':attribute должен быть датой больше и равной :date.',
    'alpha' => ':attribute должен содержать только буквы.',
    'alpha_dash' => ':attribute должен содержать только буквы, цифры, дефисы и символы подчеркивания.',
    'alpha_num' => ':attribute должен содержать только буквы, цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => ':attribute должен быть датой меньше :date.',
    'before_or_equal' => ':attribute должен быть датой меньше или равной :date.',
    'between' => [
        'numeric' => ':attribute длжен быть между :min и :max.',
        'file' => ':attribute должен быть от :min до :max кБ.',
        'string' => ':attribute должен быть от :min до :max символов.',
        'array' => ':attribute долен иметь от :min до :max элементов.',
    ],
    'boolean' => ':attribute должен быть true или false.',
    'confirmed' => ':attribute подтверждение не совпадает.',
    'current_password' => 'Не верный пароль.',
    'date' => ':attribute не корректныя дата.',
    'date_equals' => ':attribute должен быть датой равной :date.',
    'date_format' => ':attribute не соответствует формату :format.',
    'declined' => ':attribute должен быть отклонен.',
    'declined_if' => ':attribute должен быть отклонен когда :other = :value.',
    'different' => ':attribute и :other должны отличаться.',
    'digits' => ':attribute должно быть :digits цифр.',
    'digits_between' => ':attribute должно быть от :min до :max цифр.',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => ':attribute имеет повторяющиеся значения.',
    'email' => ':attribute должен быть корректным email адресом.',
    'ends_with' => ':attribute должен заканчиваться одним из следующих: :values.',
    'enum' => 'Выбранный :attribute не верен.',
    'exists' => 'Выбранный :attribute не верен.',
    'file' => ':attribute должен быть файлом.',
    'filled' => ':attribute должен иметь значение.',
    'gt' => [
        'numeric' => ':attribute должен быть больше чем :value.',
        'file' => ':attribute должен быть больше чем :value кБ.',
        'string' => ':attribute должен быть больше чем :value символов.',
        'array' => ':attribute должен иметь больше :value элементов.',
    ],
    'gte' => [
        'numeric' => ':attribute должен быть больше или равен :value.',
        'file' => ':attribute должен быть больше или равен :value кБ.',
        'string' => ':attribute должен быть больше или равен :value символам.',
        'array' => ':attribute должен иметь :value элементов или более.',
    ],
    'image' => ':attribute должен быть изображением.',
    'in' => 'Выбранный :attribute не верен.',
    'in_array' => ':attribute поле не существует в :other.',
    'integer' => ':attribute должен быть целым числом.',
    'ip' => ':attribute должен быть корректным IP адресом.',
    'ipv4' => ':attribute должен быть корректным IPv4 адресом.',
    'ipv6' => ':attribute должен быть корректным IPv6 адресом.',
    'json' => ':attribute должена быть корректной JSON строкой.',
    'lt' => [
        'numeric' => ':attribute должен быть меньше :value.',
        'file' => ':attribute должен быть меньше :value кБ.',
        'string' => ':attribute должен быть меньше :value символов.',
        'array' => ':attribute должен иметь :value символов.',
    ],
    'lte' => [
        'numeric' => ':attribute должен быть меньше или равен :value.',
        'file' => ':attribute должен быть меньше или равен :value кБ.',
        'string' => ':attribute должен быть меньше или равен :value символов.',
        'array' => ':attribute должен иметь меньше чем :value элементов.',
    ],
    'mac_address' => ':attribute должен быть корректным MAC адресом.',
    'max' => [
        'numeric' => ':attribute не должен быть больше :max.',
        'file' => ':attribute не должен быть больше :max кБ.',
        'string' => ':attribute не должен быть больше :max символов.',
        'array' => ':attribute не должен иметь больше :max элементов.',
    ],
    'mimes' => ':attribute должен быть файлом типа: :values.',
    'mimetypes' => ':attribute должен быть файлом типа: :values.',
    'min' => [
        'numeric' => ':attribute должен быть не менее :min.',
        'file' => ':attribute должен быть не менее :min кБ.',
        'string' => ':attribute должен быть не менее :min символов.',
        'array' => ':attribute должен иметь не менее :min элментов.',
    ],
    'multiple_of' => ':attribute должно быть кратно :value.',
    'not_in' => 'Выбранный :attribute не верен.',
    'not_regex' => ':attribute формат не верен.',
    'numeric' => ':attribute должен быть числом.',
    'password' => 'Пароль не верный.',
    'present' => ':attribute поле должно присутствовать.',
    'prohibited' => ':attribute поле запрещено.',
    'prohibited_if' => ':attribute поле запрещено когда :other = :value.',
    'prohibited_unless' => ':attribute поле запрещено пока :other = :values.',
    'prohibits' => ':attribute поле запрещено :other из присутствующих.',
    'regex' => ':attribute формат не верен.',
    'required' => ':attribute обязательно.',
    'required_array_keys' => ':attribute поле должно содержать записи для: :values.',
    'required_if' => ':attribute обязательно при :other = :value.',
    'required_unless' => ':attribute обязательно пока :other = :values.',
    'required_with' => ':attribute обязательно когда :values присутствует.',
    'required_with_all' => ':attribute обязательно когда все :values присутствует.',
    'required_without' => ':attribute обязательно когда :values не присутствует.',
    'required_without_all' => ':attribute обязательно когда ни одно :values не присутствует.',
    'same' => ':attribute и :other должны быть равны.',
    'size' => [
        'numeric' => ':attribute должно быть :size.',
        'file' => ':attribute должно быть :size кБ.',
        'string' => ':attribute должно быть :size символов.',
        'array' => ':attribute должно иметь :size элементов.',
    ],
    'starts_with' => ':attribute должен начинаться одним из: :values.',
    'string' => ':attribute должно быть строкой.',
    'timezone' => ':attribute должен быть корректной timezone.',
    'unique' => ':attribute уже существует.',
    'uploaded' => ':attribute не загружен.',
    'url' => ':attribute должен быть корректным URL.',
    'uuid' => ':attribute должен быть корректным UUID.',

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
