<?php

function helloworld(){
    return 'Hello World';
}


function groupByArray($arr, $criteria): array
{
    return array_reduce($arr, function($accumulator, $item) use ($criteria) {
        $key = (is_callable($criteria)) ? $criteria($item) : $item[$criteria];
        if (!array_key_exists($key, $accumulator)) {
            $accumulator[$key] = [];
        }

        array_push($accumulator[$key], $item);
        return $accumulator;
    }, []);
}




?>