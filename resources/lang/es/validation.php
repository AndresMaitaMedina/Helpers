<?php

return [
    'required' => 'El campo :attribute es necesario.',
    'lte' => [
        'numeric' => ':attribute debe ser menor o igual que :value.',
    ],
    'url' => ':attribute formato no valido.',
    'regex' => 'El :attribute tiene un formato invalido.',

    'max' => [
        'numeric' => ':attribute no debe ser mayor que :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'El campo :attribute no puede tener mas de :max caracteres.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'min' => [
        'numeric' => ':attribute no debe ser menor que :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'El campo :attribute no puede tener menos de :min caracteres.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'between' => [
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'string' => 'El :attribute debe tener entre :min y :max caracteres',
    ],
    'digits' => 'El :attribute debe tener :digits digitos.',    
    'email' => 'El :attribute debe ser una direccion de correo valida.',
    'confirmed' => 'Error en la confirmacion del campo :attribute.',
    'string' => 'El campo :attribute debe ser una cadena de caracteres.',
    'unique' => 'El :attribute ya ha sido registrado antes en el sistema',
    'numeric' => 'El :attribute ya ha sido registrado antes en el sistema',
    'dimensions' => 'El :attribute no tiene dimensiones validas.',
    'after_or_equal' => 'El :attribute debe ser una fecha despues o igual a :date .',

];