<?php

namespace MatrixTest\Decomposition;

use Matrix\Decomposition\QR;
use Matrix\Matrix as Matrix;
use MatrixTest\BaseTestAbstract;

class QrTest extends BaseTestAbstract
{
    public function testBasicQRDecomposition()
    {
        $grid = [
            [1, -2],
            [-3, 4]
        ];

        $matrix = new Matrix($grid);
        new QR($matrix);

        // Verify that the original matrix remains unchanged
        $this->assertOriginalMatrixIsUnchanged($grid, $matrix);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testQRDecompositionQ($expected, $grid)
    {
        $matrix = new Matrix($grid);
        $decomposition = new QR($matrix);

        $Q = $decomposition->getQ();
        //    Must return an object of the correct type...
        $this->assertIsMatrixObject($Q);
        //    ... containing the correct data
        $this->assertMatrixValues($Q, count($expected['Q']), count($expected['Q'][0]), $expected['Q']);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testQRDecompositionR($expected, $grid)
    {
        $matrix = new Matrix($grid);
        $decomposition = new QR($matrix);

        $R = $decomposition->getR();
        //    Must return an object of the correct type...
        $this->assertIsMatrixObject($R);
        //    ... containing the correct data
        $this->assertMatrixValues($R, count($expected['R']), count($expected['R'][0]), $expected['R']);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testQRDecompositionResolve($expected, $grid)
    {
        $matrix = new Matrix($grid);
        $decomposition = new QR($matrix);

        $Q = $decomposition->getQ();
        $R = $decomposition->getR();
        $result = $Q->multiply($R);

        $this->assertEqualsWithDelta($matrix, $result, self::PRECISION);
    }

    /**
     * @dataProvider solveDataProvider
     */
    public function testQRDecompositionSolve($expected, $grid, $target)
    {
        $matrix = new Matrix($grid);
        $decomposition = new QR($matrix);
        $target = new Matrix($target);

        $result = $decomposition->solve($target);
        $this->assertEqualsWithDelta($expected, $result->toArray(), self::PRECISION);

        $resolve = $matrix->multiply($result);
        $this->assertEqualsWithDelta($target, $resolve, self::PRECISION);
    }

    public function solveDataProvider()
    {
        return [
            [
                [
                    [-4],
                    [4.5],
                ],
                [
                    [1, 2],
                    [3, 4],
                ],
                [
                    [5],
                    [6],
                ],
            ],
            [
                [
                    [-4, -6],
                    [4.5, 6.5],
                ],
                [
                    [1, 2],
                    [3, 4],
                ],
                [
                    [5, 7],
                    [6, 8],
                ],
            ],
            [
                [
                    [-4, -6, -18],
                    [4.5, 6.5, 13.5],
                ],
                [
                    [1, 2],
                    [3, 4],
                ],
                [
                    [5, 7, 9],
                    [6, 8, 0],
                ],
            ],
            [
                [
                    [5],
                    [3],
                    [-2]
                ],
                [
                    [1, 1, 1],
                    [0, 2, 5],
                    [2, 5, -1],
                ],
                [
                    [6],
                    [-4],
                    [27],
                ],
            ],
            [
                [
                    [-0.36363636363636476],
                    [0.9545454545454576],
                    [-0.31818181818182023]
                ],
                [
                    [-1, 2, 4],
                    [5, 6, 6],
                    [-3, 5, 9],
                ],
                [
                    [1],
                    [2],
                    [3],
                ],
            ],
            [
                [
                    [1.5],
                    [-3.5],
                    [0.5]
                ],
                [
                    [1, 0, 1],
                    [2, 0, 0],
                    [0, -1, 1],
                    [0, -2, 0],
                ],
                [
                    [2],
                    [3],
                    [4],
                    [7],
                ],
            ],
            [
                [
                    [1.5, 0.0],
                    [-3.5, -4.0],
                    [0.5, 1.0]
                ],
                [
                    [1, 0, 1],
                    [2, 0, 0],
                    [0, -1, 1],
                    [0, -2, 0],
                ],
                [
                    [2, 1],
                    [3, 0],
                    [4, 5],
                    [7, 8],
                ],
            ],
            [
                [
                    [0.47492549995617495],
                    [0.34208056076134497],
                ],
                [
                    [1.0, 1.0],
                    [1.0, 0.7408],
                    [1.0, 0.4493],
                    [1.0, 0.3329],
                    [1.0, 0.2019],
                    [1.0, 0.1003],
                ],
                [
                    [0.8170060607175199],
                    [0.7283387793681793],
                    [0.6286222959062473],
                    [0.5888041186336267],
                    [0.5439915651738905],
                    [0.5092361802005378],
                ],
            ],
        ];
    }

    public function dataProvider()
    {
        return [
            'Simple 2x2' => [
                [
                    'Q' => [
                        [-0.316227766016838, 0.948683298050514],
                        [-0.9486832980505138, -0.316227766016838],
                    ],
                    'R' => [
                        [-3.162277660168, -4.427188724236],
                        [0.0, 0.6324555320336751],
                    ],
                ],
                [
                    [1.0, 2.0],
                    [3.0, 4.0],
                ],
            ],
            'All the Ones' => [
                [
                    'Q' => [
                        [-0.5, -0.5, 0.5, 0.5],
                        [-0.5, -0.5, -0.5, -0.5],
                        [-0.5, 0.5, -0.5, 0.5],
                        [-0.5, 0.5, 0.5, -0.5],
                    ],
                    'R' => [
                        [-2.0, 0.0, 0.0, 0.0],
                        [0.0, -2.0, 0.0, 0.0],
                        [0.0, 0.0, 2.0, 0.0],
                        [0.0, 0.0, 0.0, 2.0],
                    ],
                ],
                [
                    [1, 1, 1, 1],
                    [1, 1, -1, -1],
                    [1, -1, -1, 1],
                    [1, -1, 1, -1],
                ],
            ],
            'Simple 3x3 Matrix' => [
                [
                    'Q' => [
                        [-0.12309149097933281, 0.9045340337332908, -0.40824829046386363],
                        [-0.4923659639173309, 0.30151134457776396, 0.8164965809277259],
                        [-0.8616404368553291, -0.30151134457776396, -0.4082482904638628],
                    ],
                    'R' => [
                        [-8.124038404635960, -9.601136296387950, -11.078234188139900],
                        [0.0, 0.904534033733293, 1.809068067466580],
                        [0.0, 0.0, -0.000000000000001],
                    ],
                ],
                [
                    [1, 2, 3],
                    [4, 5, 6],
                    [7, 8, 9],
                ],
            ],
            '3x3 Magic Square' => [
                [
                    'Q' => [
                        [-0.199007438041998, 0.972488642858958, 0.1210862465943296],
                        [-0.895533471188990, -0.230643324147080, 0.3805567750107504],
                        [-0.398014876083996, 0.032703157901452, -0.9167958670713532],
                    ],
                    'R' => [
                        [-10.049875621120900, -7.064764050490930, -5.273697108112940],
                        [0.0, 5.752313352981660, 5.865913796218280],
                        [0.0, 0.0, -6.227292681994097],
                    ],
                ],
                [
                    [2, 7, 6],
                    [9, 5, 1],
                    [4, 3, 8],
                ],
            ],
            'Another Simple 3x3' => [
                [
                    'Q' => [
                        [-0.408248290463863, 0.707106781186548, -0.5773502691896256],
                        [-0.816496580927726, 0.0, 0.5773502691896257],
                        [-0.408248290463863, -0.707106781186547, -0.5773502691896262],
                    ],
                    'R' => [
                        [-2.449489742783180, -4.898979485566360, -7.756717518813400],
                        [0.0, 1.414213562373100, 3.535533905932740],
                        [0.0, 0.0, 1.1547005383792528],
                    ],
                ],
                [
                    [1, 3, 5],
                    [2, 4, 7],
                    [1, 1, 0],
                ],
            ],
            '4x4 with positive and negative values' => [
                [
                    'Q' => [
                        [-0.294883912309794, 0.646908108895345, 0.655396891228784, -0.25496723686380474],
                        [0.147441956154897, -0.323454054447673, 0.647746343860355, 0.6738419831400553],
                        [-0.589767824619589, 0.344100057923056, -0.357025543860038, 0.637418092159512],
                        [-0.737209780774486, -0.598734100786117, 0.153010947368588, -0.27317918235407657],
                    ],
                    'R' => [
                        [-6.782329983125270, 0.294883912309793, 3.980932816182220, -2.211629342323460],
                        [0.0, 6.317677063467310, 0.763902128589184, -2.112774355647560],
                        [0.0, 0.0, 2.562933368423840, -1.007322070176540],
                        [0.0, 0.0, 0.0, 6.374180921595119],
                    ],
                ],
                [
                    [2, 4, 1, -3],
                    [-1, -2, 2, 4],
                    [4, 2, -3, 5],
                    [5, -4, -3, 1],
                ],
            ],
            '4x4 with positive and negative float values' => [
                [
                    'Q' => [
                        [-0.870388279778489, -0.225482237707286, 0.265273220832105, -0.34815531191139854],
                        [-0.348155311911396, -0.265273220832101, -0.225482237707296, 0.8703882797784915],
                        [0.0, -0.437700814372966, -0.828978815100310, -0.34815531191138704],
                        [0.348155311911396, -0.828978815100314, 0.437700814372966, -0.000000000000005],
                    ],
                    'R' => [
                        [2.872281323269010, 1.740776559556980, 1.392621247645580, 2.437087183379770],
                        [0.0, -2.284665614416470, -5.504419332266090, -13.024915142856100],
                        [0.0, 0.0, -0.109425203593242, 0.809083323537904],
                        [0.0, 0.0, 0.0, 0.0870388279778368],
                    ],
                ],
                [
                    [-2.5, -1, 0, 1],
                    [-1, 0, 1, 2.5],
                    [0, 1, 2.5, 5],
                    [1, 2.5, 5, 12],
                ],
            ],
            '4x4 Magic square' =>[
                [
                    'Q' => [
                        [-0.486664263392288, -0.025409618431111, 0.793825739600044, -0.36380343755449956],
                        [-0.216295228174350, -0.755583236958464, 0.121092061972888, 0.6063390625908325],
                        [-0.757033298610225, 0.463372625000684, -0.282548144603405, 0.3638034375544995],
                        [-0.378516649305113, -0.462313890899387, -0.524732268549182, -0.6063390625908323],
                    ],
                    'R' => [
                        [-18.493242008906900, -11.463647093240600, -14.599927901768600, -17.952503938471100],
                        [0.0, -16.570600330755600, -9.935160806564540, -0.011998986481357],
                        [0.0, 0.0, -5.489506809437590, 9.149178015729320],
                        [0.0, 0.0, 0.0, 0.0],
                    ],
                ],
                [
                    [9, 6, 3, 16],
                    [4, 15, 10, 5],
                    [14, 1, 8, 11],
                    [7, 12, 13, 2],
                ],
            ],
            'Asymetric - 2 rows 3 columns' => [
                [
                    'Q' => [
                        [-0.24253562503633308, 0.9701425001453319],
                        [-0.9701425001453319, -0.24253562503633308],
                    ],
                    'R' => [
                        [-4.123105625617661, -5.335783750799326, -6.5484618759809905],
                        [0.0, 0.7276068751089992, 1.4552137502179976],
                    ],
                ],
                [
                    [1, 2, 3],
                    [4, 5, 6],
                ],
            ],
            'Asymetric - 3 rows 2 columns' => [
                [
                    'Q' => [
                        [-0.169030850945703, 0.897085227145060],
                        [-0.507092552837110, 0.276026223736942],
                        [-0.845154254728517, -0.345032779671177],
                    ],
                    'R' => [
                        [-5.916079783099620, -7.437357441610940],
                        [0.0, 0.828078671210823],
                    ],
                ],
                [
                    [1, 2],
                    [3, 4],
                    [5, 6],
                ],
            ],
            'Asymetric - 3 rows 7 columns' => [
                [
                    'Q' => [
                        [-0.10783277320343831, 0.8235566226707017, 0.5568900989230126],
                        [-0.9704949588309455, 0.0343148592779462, -0.23866718525271913],
                        [0.2156655464068768, 0.56619517808611, -0.7955572841757288],
                    ],
                    'R' => [
                        // phpcs:disable Generic.Files.LineLength
                        [-9.273618495495706, -8.195290763461317, -7.116963031426934, -6.038635299392549, -4.960307567358166, -3.881979835323781, -2.803652103289398],
                        [0.0, 1.355436941478862, 2.7108738829577295, 4.066310824436593, 5.421747765915459, 6.7771847073943245, 8.13262164887319],
                        [0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0],
                        // phpcs:enable
                    ],
                ],
                [
                    [1, 2, 3, 4, 5, 6, 7],
                    [9, 8, 7, 6, 5, 4, 3],
                    [-2, -1, 0, 1, 2, 3, 4],
                ],
            ],
            'Asymetric - 7 rows 3 columns' => [
                [
                    'Q' => [
                        [-0.085749292571255, -0.3045082017063, 0.058918029340522],
                        [-0.34299717028502, -0.23977023756402, 0.27272366158654],
                        [-0.60024504799878, -0.5011197965088, -0.30268884489375],
                        [-0.60024504799878, 0.4771427727524, 0.51123032331553],
                        [-0.34299717028502, 0.41240480861011, -0.73839880757692],
                        [0.085749292571254, -0.34766684446783, -0.08361905882349],
                        [-0.17149858514251, -0.28292888032554, 0.13018657342253],
                    ],
                    'R' => [
                        [-11.661903789690601, -12.433647422831891, -10.032667230836765],
                        [0.0, -3.0666613384437933, -6.27958252180164],
                        [0.0, 0.0, 3.8616617649889395],
                    ],
                ],
                [
                    [1, 2, 3],
                    [4, 5, 6],
                    [7, 9, 8],
                    [7, 6, 5],
                    [4, 3, -2],
                    [-1, 0, 1],
                    [2, 3, 4],
                ],
            ],
        ];
    }
}
