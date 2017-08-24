<?php
    $arr = [
        '0' => [
            '124' => [
                'id' => 124,
                'name' => 'a',
                'pid' => '0'
            ],
            '162' => [
                'id' => 162,
                'name' => 'b',
                'pid' => '0'
            ]
        ],
        '124' => [
            '159' => [
                'id' => '159',
                'name' => 'c',
                'pid' => '124'
            ],
            '171' => [
                'id' => '171',
                'name' => 'f',
                'pid' => '124'
            ],
        ],
        '159' => [
            '160' => [
                'id' => '160',
                'name' => 'd',
                'pid' => '159'
            ]
        ],
        '162' => [
            '170' => [
                'id' => '170',
                'name' => 'e',
                'pid' => '162'
            ]
        ]
    ];
    /**
    *   处理查询出的无限分类数组
    *   @param arr 传入的无限分类数组,不会因为递归而改变
    *          arr2 要处理的数组,会随着递归传入而改变
    *          pid  父id
    */
    function func(&$arr, &$arr2, $pid = 0){
        if(isset($arr2[$pid])){
            foreach($arr2[$pid] as $k => $v){
                if(isset($arr[$k])){
                    foreach($arr[$k] as $val){
                        $arr2[$pid][$k]['child'][$val['pid']][$val['id']] = $val;
                        func($arr, $arr2[$pid][$k]['child'], $val['pid']);
                    }
                }
            }
        }
    }
    func($arr, $arr);
    echo '<pre>';
    print_r($arr[0]);
