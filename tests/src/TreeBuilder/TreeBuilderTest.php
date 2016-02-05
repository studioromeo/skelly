<?php

namespace RS\Tests\Timer;

use RS\TreeBuilder\TreeBuilder;

class TreeBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildTree()
    {
        $flatTree = [
            [
                'id' => 1,
                'title' => 'Root',
                'parent_id' => 0,
            ],
            [
                'id' => 2,
                'title' => 'Child 1',
                'parent_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Child 2',
                'parent_id' => 1,
            ],
        ];

        $expected = [
            [
                'id' => 1,
                'title' => 'Root',
                'parent_id' => 0,
                'children' => [
                    [
                        'id' => 2,
                        'title' => 'Child 1',
                        'parent_id' => 1,
                    ],
                    [
                        'id' => 3,
                        'title' => 'Child 2',
                        'parent_id' => 1,
                    ]
                ]
            ]
        ];
        $treeBuilder = new TreeBuilder();

        $actual = $treeBuilder->build($flatTree);

        $this->assertSame($expected, $actual);
    }
}
