<?php

return [
    'required' => ':attributeは必須項目です。',
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
    ],
    'custom' => [
        'post.title' => [
            'required' => 'タイトルは必須です。',
        ],
        'post.body' => [
            'required' => '本文は必須です。',
        ],
    ],
    'attributes' => [
        'post.title' => 'タイトル',
        'post.body' => '本文',
    ],
];
