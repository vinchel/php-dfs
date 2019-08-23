<?php

/**
 * DFS算法
 * @param $pathList
 * @param $start
 * @param $end
 * @param array $visited
 * @param array $path
 * @return array
 */
function dfs($pathList, $start, $end, $visited = [], $path = []){
    static $result = [];
    $visited[$start] = true;
    $path[] = $start;

    if ($start == $end){
        //echo implode(',', $path).'<br>';
        $result[] = $path;
    }else{
        foreach ($pathList[$start] AS $point){
            if (!$visited[$point]){
                dfs($pathList, $point, $end, $visited, $path);
            }
        }
    }
    array_pop($path);
    $visited[$start] = false;

    return $result;
}

/**
 * 计算所有节点的邻节点
 * @param $pathList
 * @return array
 */
function calculate_near($pathList){
    $pathInfo = [];
    foreach ($pathList AS $list){
        foreach ($list AS $value){
            $k = array_search($value, $list);

            //将前后两节点加入记录
            isset($list[$k - 1]) && $pathInfo[$value][] = $list[$k - 1];
            isset($list[$k + 1]) && $pathInfo[$value][] = $list[$k + 1];
        }
    }
    //去重
    foreach ($pathInfo AS $key => $list){
        $pathInfo[$key] = array_unique($list); //去重
    }
    return $pathInfo;
}

//测试程序
$pathList = [
    [1, 2, 4],
    [1, 3],
    [2, 5],
    [3, 5],
    [3, 1],
];
$start = 4; //开始节点
$end = 5; //结束节点
$pathInfo = calculate_near($pathList);

$path = dfs($pathInfo, $start, $end);
print_r($path);