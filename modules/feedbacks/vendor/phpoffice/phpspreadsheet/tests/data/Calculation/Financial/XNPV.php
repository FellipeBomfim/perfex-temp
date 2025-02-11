<?php

// result, message, rate, values, dates

return [
    'If rate is not numeric, returns the #VALUE! error value' => [
        '#VALUE!',
        'xyz',
        [0, 120000, 120000, 120000, 120000, 120000, 120000, 120000, 120000, 120000, 120000],
        ['2018-06-30', '2018-12-31', '2019-12-31', '2020-12-31', '2021-12-31', '2022-12-31', '2023-12-31', '2024-12-31', '2025-12-31', '2026-12-31', '2027-12-31'],
    ],
    'Okay to specify values and dates as non-array' => [
        1000.0,
        0.10,
        1000.0,
        '2018-06-30',
    ],
    'If different number of elements in values and dates, return NUM' => [
        '#NUM!',
        0.10,
        [1000.0, 1000.1],
        '2018-06-30',
    ],
    'If minimum value > 0, return NUM' => [
        '#NUM!',
        0.10,
        [1000.0, 1000.1],
        ['2018-06-30', '2018-07-30'],
    ],
    'If maximum value < 0, return NUM' => [
        '#NUM!',
        0.10,
        [-1000.0, -1000.1],
        ['2018-06-30', '2018-07-30'],
    ],
    'If any value is non-numeric, return VALUE' => [
        '#VALUE!',
        0.10,
        [-1000.0, 1000.1, 'x'],
        ['2018-06-30', '2018-07-30', '2018-08-30'],
    ],
    'If first date is non-numeric, return VALUE' => [
        '#VALUE!',
        0.10,
        [-1000.0, 1000.1, 1000.2],
        ['2018-06x30', '2018-07-30', '2018-08-30'],
    ],
    'If any other date is non-numeric, return VALUE' => [
        '#VALUE!',
        0.10,
        [-1000.0, 1000.1, 1000.2],
        ['2018-06-30', '2018-07-30', '2018-08z30'],
    ],
    'If any date is before first date, return NUM' => [
        '#NUM!',
        0.10,
        [-1000.0, 1000.1, 1000.2],
        ['2018-06-30', '2018-07-30', '2018-05-30'],
    ],
    'XNPV calculation #1 is incorrect' => [
        772830.734,
        0.10,
        [0, 120000, 120000, 120000, 120000, 120000, 120000, 120000, 120000, 120000, 120000],
        ['2018-06-30', '2018-12-31', '2019-12-31', '2020-12-31', '2021-12-31', '2022-12-31', '2023-12-31', '2024-12-31', '2025-12-31', '2026-12-31', '2027-12-31'],
    ],
    'Gnumeric gets this right, Excel returns #NUM, Libre now gets it right' => [
        22.257507852701,
        -0.10,
        [-100.0, 110.0],
        ['2019-12-31', '2020-12-31'],
    ],
    'Issue 3297 another case where Excel goes wrong' => [
        0,
        -0.6118824173,
        [-1000000.706, 947003.58],
        ['2018-09-05', '2018-09-26'],
    ],
    'Issue 3297 using correct XIRR calculation' => [
        0,
        -.379332733303311,
        [-19646.10172, -22288.58964, -1483.5, -12597.54406, -46629.45777, -2472.769, 0, -25616.37076, -30055.68344, 1038.5, -13621.9742, 13629.539, -36736.0694, -944.605609, -49020.77156, 27308.87082, -63912.64722, 8764.136, 3162, -23946.7257, -5428.8, -83899.24172, 58242.82346, -11147.78101, 287092.5749],
        ['2022-05-02', '2022-05-31', '2022-06-01', '2022-06-26', '2022-06-30', '2022-07-01', '2022-07-15', '2022-07-31', '2022-09-02', '2022-09-05', '2022-09-27', '2022-09-28', '2022-09-29', '2022-10-03', '2022-10-06', '2022-10-10', '2022-11-01', '2022-11-03', '2022-11-04', '2022-12-01', '2022-12-02', '2022-12-28', '2022-12-30', '2023-01-02', '2023-01-13'],
    ],
    'Issue 3297 using incorrect Excel XIRR calculation' => [
        -50210.188872963656,
        2.98023223876953E-09,
        [-19646.10172, -22288.58964, -1483.5, -12597.54406, -46629.45777, -2472.769, 0, -25616.37076, -30055.68344, 1038.5, -13621.9742, 13629.539, -36736.0694, -944.605609, -49020.77156, 27308.87082, -63912.64722, 8764.136, 3162, -23946.7257, -5428.8, -83899.24172, 58242.82346, -11147.78101, 287092.5749],
        ['2022-05-02', '2022-05-31', '2022-06-01', '2022-06-26', '2022-06-30', '2022-07-01', '2022-07-15', '2022-07-31', '2022-09-02', '2022-09-05', '2022-09-27', '2022-09-28', '2022-09-29', '2022-10-03', '2022-10-06', '2022-10-10', '2022-11-01', '2022-11-03', '2022-11-04', '2022-12-01', '2022-12-02', '2022-12-28', '2022-12-30', '2023-01-02', '2023-01-13'],
    ],
];
