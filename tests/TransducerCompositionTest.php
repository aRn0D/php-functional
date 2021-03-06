<?php
/**
 * Created by IntelliJ IDEA.
 * User: alemaire
 * Date: 25/06/2015
 * Time: 15:42
 */

namespace Fp\Test;

use Fp;

class TransducerCompositionTest extends \PHPUnit_Framework_TestCase
{

    public function testMappingAndFilteringComposition()
    {
        $transformed =  Fp\transduce(
                            Fp\compose(
                                Fp\mapping(square_makker()),
                                Fp\filtering(is_even_makker())
                            ),
                            Fp\appending(), range(1, 6));

        $this->assertEquals([4, 16, 36], $transformed);
    }

    public function testMappingAndFilteringAndEnumeratingComposition()
    {
        $transformed = Fp\transduce(
            Fp\compose(
              Fp\mapping(square_makker()),
              Fp\filtering(is_even_makker()),
              Fp\enumerating()
            ),
            Fp\appending(), range(1, 6));

        $this->assertEquals([[0, 4], [1, 16], [2, 36]], $transformed);
    }

    public function testMappingAndBatching()
    {
        $transformed = Fp\transduce(
            Fp\compose(
                Fp\mapping(square_makker()),
                Fp\batching(3)
            ),
            Fp\appending(), range(1, 6));
        $this->assertEquals([[1, 4, 9], [16, 25, 36]], $transformed);
    }

    public function testMappingAndFirst()
    {
        $transformed = Fp\transduce(
            Fp\compose(
                Fp\mapping(square_makker()),
                Fp\first(function($x) { return $x > 6; })
            ),
            Fp\single_result(), range(1,6));

        $this->assertEquals(9, $transformed);
    }
}
