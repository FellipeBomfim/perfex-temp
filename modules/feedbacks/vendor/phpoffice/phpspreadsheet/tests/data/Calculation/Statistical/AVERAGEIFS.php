<?php

return [
    'no argument' => [
        'exception',
    ],
    [
        80.5,
        [75, 94, 86, 'incomplete'],
        [75, 94, 86, 'incomplete'],
        '>70',
        [75, 94, 86, 'incomplete'],
        '<90',
    ],
    [
        '#DIV/0!',
        [85, 80, 93, 75],
        [85, 80, 93, 75],
        '>95',
    ],
    [
        87.5,
        [87, 88, 'incomplete', 75],
        [87, 88, 'incomplete', 75],
        '<>incomplete',
        [87, 88, 'incomplete', 75],
        '>80',
    ],
    [
        174000,
        [223000, 125000, 456000, 322000, 340000, 198000, 310000, 250000, 460000, 261000, 389000, 305000],
        [1, 1, 1, 2, 2, 2, 3, 3, 3, 4, 4, 4],
        1,
        ['North', 'North', 'South', 'North', 'North', 'South', 'North', 'North', 'South', 'North', 'North', 'South'],
        'North',
    ],
    [
        285500,
        [223000, 125000, 456000, 322000, 340000, 198000, 310000, 250000, 460000, 261000, 389000, 305000],
        [1, 1, 1, 2, 2, 2, 3, 3, 3, 4, 4, 4],
        '>2',
        ['Jeff', 'Chris', 'Carol', 'Jeff', 'Chris', 'Carol', 'Jeff', 'Chris', 'Carol', 'Jeff', 'Chris', 'Carol'],
        'Jeff',
    ],
];
