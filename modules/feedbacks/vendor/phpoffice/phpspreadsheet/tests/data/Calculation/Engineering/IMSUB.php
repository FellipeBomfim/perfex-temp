<?php

use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

return [
    [
        ExcelError::NAN(),
        '12.34+5.67j',
        '123.45+67.89i',
    ],
    [
        ExcelError::NAN(),
        '12.34+5.67j',
        'Invalid Complex Number',
    ],
    [
        '111.11+62.22j',
        '123.45+67.89j',
        '12.34+5.67j',
    ],
    [
        '-111.11-62.22j',
        '12.34+5.67j',
        '123.45+67.89j',
    ],
    [
        '-111.11-62.22i',
        '12.34+5.67i',
        '123.45+67.89i',
    ],
    [
        '-135.79+62.22i',
        '-12.34-5.67i',
        '123.45-67.89i',
    ],
    [
        '135.79+62.22i',
        '12.34-5.67i',
        '-123.45-67.89i',
    ],
    [
        '111.11+62.22i',
        '-12.34-5.67i',
        '-123.45-67.89i',
    ],
    [
        '111.11+67.89i',
        '-12.34',
        '-123.45-67.89i',
    ],
    [
        '111.11-67.89i',
        '-12.34',
        '-123.45+67.89i',
    ],
];
