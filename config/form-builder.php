<?php

return [

    'inputTypes' => [
        'text',
        'email',
        'password',
        'number',
        'file',
        'submit',
        'button',
        'radio',
        'checkbox',
        'hidden',
        'date',
        'select',
    ],

    'bootstrapClasses' => [
        'text' => 'form-control',
        'email' => 'form-control',
        'password' => 'form-control',
        'number' => 'form-control',
        'file' => 'form-control-file',
        'submit' => 'btn',
        'button' => 'btn',
        'radio' => 'form-check-input',
        'checkbox' => 'form-check-input',
        'hidden' => '',
        'date' => 'form-control',
        'select' => 'form-control',
    ],

    'tailwindClasses' => [
        'text' => 'block w-full px-4 py-2 border rounded-md',
        'email' => 'block w-full px-4 py-2 border rounded-md',
        'password' => 'block w-full px-4 py-2 border rounded-md',
        'number' => 'block w-full px-4 py-2 border rounded-md',
        'file' => 'block w-full px-4 py-2 border rounded-md',
        'submit' => 'px-4 py-2 rounded-md',
        'button' => 'px-4 py-2 rounded-md',
        'radio' => 'form-radio',
        'checkbox' => 'form-checkbox',
        'hidden' => '',
        'date' => 'block w-full px-4 py-2 border rounded-md',
        'select' => 'block w-full px-4 py-2 border rounded-md',
    ],

    'bootstrapButtonColors' => [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'success' => 'btn-success',
        'danger' => 'btn-danger',
        'warning' => 'btn-warning',
        'info' => 'btn-info',
        'light' => 'btn-light',
        'dark' => 'btn-dark',
    ],

    'tailwindButtonColors' => [
        'primary' => 'bg-blue-500 text-white',
        'secondary' => 'bg-gray-500 text-white',
        'success' => 'bg-green-500 text-white',
        'danger' => 'bg-red-500 text-white',
        'warning' => 'bg-yellow-500 text-black',
        'info' => 'bg-teal-500 text-white',
        'light' => 'bg-gray-100 text-black',
        'dark' => 'bg-gray-800 text-white',
    ],

    'fileTypes' => [
        'documents' => 'doc,docx,pdf',
        'images' => 'jpg,jpeg,png,gif',
        'videos' => 'mp4,mkv,avi',
    ],
];
