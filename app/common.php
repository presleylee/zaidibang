<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 列表转目录树
 *
 * @param array $list;
 * @param string $pk;
 * @param string $pid;
 * @param string $child;
 * @param bool   $root;
 *
 * @return array;
*/
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer [$data [$pk]] = &$list [$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data [$pid];
            if ($root == $parentId) {
                $tree [] = &$list [$key];
            } else {
                if (isset($refer [$parentId])) {
                    $parent = &$refer [$parentId];
                    $parent [$child] [] = &$list [$key];
                }
            }
        }
    }
    return $tree;
}