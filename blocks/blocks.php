<?php

use TenUpScaffold\Blocks\StaticBlock\StaticBlock;

require_once 'classes/Block.php';
require_once 'static-block/StaticBlock.php';

$staticBlock = new StaticBlock;
add_action('init', [$staticBlock, 'init'] );
