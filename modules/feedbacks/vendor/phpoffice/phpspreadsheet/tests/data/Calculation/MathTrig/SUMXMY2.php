<?php

return [
    [
        6,
        [5, 2, 3],
        [3, 1, 2],
    ],
    [
        79,
        [2, 3, 9, 1, 8, 7, 5],
        [6, 5, 11, 7, 5, 4, 4],
    ],
    [
        64,
        [[1, 2], [3, 4]],
        [[5, 6], [7, 8]],
    ],
    [8, [1, 2], [3, 4]],
    [8, [1, '=2'], [3, 4]],
    [4, [1, ''], [3, 4]],
    [4, [1, '2'], [3, 4]],
    [4, [1, '="2"'], [3, 4]],
    [4, [1, 'X'], [3, 4]],
    [4, [1, false], [3, 4]],
    [4, [1, 2], [null, 4]],
    [4, [1, 2], [true, 4]],
    ['#N/A', [1, 2], [3, 4, 5]], // different dimensions
];
