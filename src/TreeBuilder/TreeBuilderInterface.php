<?php

namespace RS\TreeBuilder;

interface TreeBuilderInterface
{
    public function build(array $nodes, int $parentId = 0) : array;
}
