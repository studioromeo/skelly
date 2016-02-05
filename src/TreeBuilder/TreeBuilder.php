<?php

namespace RS\TreeBuilder;

class TreeBuilder implements TreeBuilderInterface
{
    /**
     * Build a tree using a flat array like the example
     *
     * [
     *      [
     *          'id' => 1
     *          'parent_id' => 0
     *      ],
     *      [
     *          'id' => 2
     *          'parent_id' => 1
     *      ],
     *      [
     *          'id' => 3
     *          'parent_id' => 1
     *      ]
     * ]
     *
     * @param array $nodes
     * @param int   $parentId
     *
     * @return array
     */
    public function build(array $nodes, int $parentId = 0) : array
    {
        $branch = [];

        foreach ($nodes as $node) {
            if ($node['parent_id'] == $parentId) {
                $children = $this->build($nodes, $node['id']);
                if ($children) {
                    $node['children'] = $children;
                }
                $branch[] = $node;
                unset($nodes[$node['id']]);
            }
        }

        return $branch;
    }
}
