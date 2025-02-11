<?php

use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

return [
    [5, '24-Oct-1968'],
    [5, '24-Oct-1968', 1],
    [4, '24-Oct-1968', 2],
    [3, '24-Oct-1968', 3],
    [ExcelError::NAN(), '24-Oct-1968', 4],
    [ExcelError::NAN(), '24-Oct-1968', 0],
    [ExcelError::NAN(), '24-Oct-1968', -1],
    [4, '2000-06-14'],
    [3, '2000-06-14', 2],
    [2, '2000-06-14', 3],
    [4, '1996-07-24'],
    [3, '1996-07-24', 2],
    [2, '1996-07-24', 3],
    [7, '1996-07-27'],
    [6, '1996-07-27', 2],
    [5, '1996-07-27', 3],
    [1, '1977-7-31'],
    [7, '1977-7-31', 2],
    [6, '1977-7-31', 3],
    [2, '1977-8-1'],
    [1, '1977-8-1', 2],
    [0, '1977-8-1', 3],
    [7, '1900-2-5', 2],
    [4, '1900-2-1'],
    [6, 38093],
    [6, 38093, 1],
    [5, 38093, 2],
    [4, 38093, 3],
    [ExcelError::VALUE(), '3/7/1977', 'A'],
    [ExcelError::NAN(), '3/7/1977', 0],
    [ExcelError::VALUE(), 'Invalid', 1],
    [ExcelError::NAN(), -1],
    [1, false],
    [2, true],
    [1, '1900-01-01'],
    [7, '1900-01-01', 2],
    [7, '1900-02-05', 2],
];
