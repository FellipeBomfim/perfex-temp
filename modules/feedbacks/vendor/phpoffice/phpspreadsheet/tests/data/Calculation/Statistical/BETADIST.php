<?php

return [
    [
        0.4059136,
        0.4, 4, 5,
    ],
    [
        0.99596045887,
        3, 5, 10, 1, 4,
    ],
    [
        0.960370937542,
        3, 7.5, 9, 1, 4,
    ],
    [
        0.960370937542,
        3, 7.5, 9, 4, 1,
    ],
    [
        0.598190307617,
        7.5, 8, 9, 5, 10,
    ],
    [
        0.685470581054,
        2, 8, 10, 1, 3,
    ],
    [
        0.4059136,
        0.4, 4, 5,
    ],
    [
        0.4059136,
        0.4, 4, 5, null, null,
    ],
    [
        '#VALUE!',
        'NAN', 8, 10, 1, 3,
    ],
    [
        '#VALUE!',
        2, 'NAN', 10, 1, 3,
    ],
    [
        '#VALUE!',
        2, 8, 'NAN', 1, 3,
    ],
    [
        '#VALUE!',
        2, 8, 10, 'NAN', 3,
    ],
    [
        '#VALUE!',
        2, 8, 10, 1, 'NAN',
    ],
    'alpha < 0' => [
        '#NUM!',
        2, -8, 10, 1, 3,
    ],
    'alpha = 0' => [
        '#NUM!',
        2, 0, 10, 1, 3,
    ],
    'beta < 0' => [
        '#NUM!',
        2, 8, -10, 1, 3,
    ],
    'beta = 0' => [
        '#NUM!',
        2, 8, 0, 1, 3,
    ],
    'value < Min' => [
        '#NUM!',
        0.5, 8, 10, 1, 3,
    ],
    'value > Max' => [
        '#NUM!',
        3.5, 8, 10, 1, 3,
    ],
    'Min = Max' => [
        '#NUM!',
        2, 8, 10, 2, 2,
    ],
];
