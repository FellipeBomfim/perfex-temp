<?php

// Cost, Date purchased, End of the 1st period, Salvage, Period, Depreciation, Basis, Result

return [
    [
        776,
        2400, '2008-08-19', '2008-12-31', 300, 1, 0.15, 1,
    ],
    [
        776,
        2400, '2008-08-19', '2008-12-31', 300, 1, 0.15, 0,
    ],
    [
        776,
        2400, '2008-08-19', '2008-12-31', 300, 1, 0.15, null,
    ],
    [
        820,
        2400, '2008-08-19', '2008-12-31', 300, 1, 0.2, 1,
    ],
    [
        492,
        2400, '2008-08-19', '2008-12-31', 300, 2, 0.2, 1,
    ],
    [
        886,
        2400, '2008-08-19', '2008-12-31', 300, 1, 0.22, 1,
    ],
    [
        949,
        2400, '2008-08-19', '2008-12-31', 300, 1, 0.24, 1,
    ],
    [
        494,
        2400, '2008-08-19', '2008-12-31', 300, 2, 0.24, 1,
    ],
    [
        902,
        2400, '2008-08-19', '2008-12-31', 300, 1, 0.3, 1,
    ],
    [
        42,
        150, '2011-01-01', '2011-09-30', 20, 1, 0.2, 4,
    ],
    [
        25,
        150, '2011-01-01', '2011-09-30', 20, 2, 0.2, 4,
    ],
    [
        16,
        150, '2011-01-01', '2011-09-30', 20, 3, 0.15, 4,
    ],
    [
        42,
        150, '2011-01-01', '2011-09-30', 20, 1, 0.4, 4,
    ],
    [
        2813,
        10000, '2012-03-01', '2012-12-31', 1500, 1, 0.3, 1,
    ],
    [
        0.0,
        500, '2012-03-01', '2012-12-31', 500, 3, 0.3, 1,
    ],
    [
        '#VALUE!',
        'NaN', '2012-03-01', '2020-12-25', 20, 1, 0.2, 4,
    ],
    [
        '#VALUE!',
        550, 'notADate', '2020-12-25', 20, 1, 0.2, 4,
    ],
    [
        '#VALUE!',
        550, '2011-01-01', 'notADate', 20, 1, 0.2, 4,
    ],
    [
        '#VALUE!',
        550, '2012-03-01', '2020-12-25', 'NaN', 1, 0.2, 4,
    ],
    [
        '#VALUE!',
        550, '2012-03-01', '2020-12-25', 20, 'NaN', 0.2, 4,
    ],
    [
        '#VALUE!',
        550, '2012-03-01', '2020-12-25', 20, 1, 'NaN', 4,
    ],
    [
        '#VALUE!',
        550, '2012-03-01', '2020-12-25', 20, 1, 0.2, 'NaN',
    ],
    [
        '#NUM!',
        550, '2012-03-01', '2020-12-25', 20, 1, 0.2, 99,
    ],
];
