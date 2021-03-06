<?php

namespace Fp;
/**
 * @param Callable*
 * @return Closure
 */
function compose() {
    $functions_list = array_reverse(func_get_args());
    $composed = function() use ($functions_list) {
        $first_function = array_shift($functions_list);
        return array_reduce(
            $functions_list,
            function ($carry, $item) {
                return $item($carry);
            },
            call_user_func_array($first_function, func_get_args())
        );
    };

    return $composed;
}