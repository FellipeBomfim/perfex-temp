<?php

use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

return [
    [ExcelError::VALUE(), '2007-1-10', 'ABC'],
    [ExcelError::VALUE(), 'DEF', '2007-1-1'],
    [9, '2007-1-10', '2007-1-1'],
    [-9, '2007-1-1', '2007-1-10'],
    [364, '2007-12-31', '2007-1-1'],
    [547, '2008-7-1', '2007-1-1'],
    [30, '2007-1-31', '2007-1-1'],
    [31, '2007-2-1', '2007-1-1'],
    [58, '2007-2-28', '2007-1-1'],
    [1, '2007-2-1', '2007-1-31'],
    [29, '2007-3-1', '2007-1-31'],
    [59, '2007-3-31', '2007-1-31'],
    [244, '2008-9-1', '2008-1-1'],
    [425, '2008-4-1', '2007-2-1'],
    [17358, '2008-6-28', '1960-12-19'],
    [9335, '2008-6-28', '1982-12-7'],
    [32, '2000-3-31', '2000-2-28'],
    [31, '2000-3-31', '2000-2-29'],
    [31, 36616, 36585],
    [-31, 36585, 36616],
];
