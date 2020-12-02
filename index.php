<?php

$handle = fopen('data.txt', "r");
$categories = [];

while ($line = fgets($handle)) {
    list ($nodeId, $parentId, $name) = explode('|', $line);
    $categories[$parentId][] = [
        'nodeId' => $nodeId,
        'parentId' => $parentId,
        'nodeName' => trim($name)
    ];
}
fclose($handle);

build(0, 0, $categories);

function build($parentId, $level, &$categories)
{
    if (isset($categories[$parentId])) {
        foreach ($categories[$parentId] as $value) {
            $line = sprintf("%s%s", str_repeat('-', $level), $value['nodeName']) . "<br>";
            echo $line;
            $level++;
            build($value["nodeId"], $level, $categories);
            $level--;
        }
    }
}
