<?php

function autoload() {
    require_once('vendor/autoload.php');
}

function view(string $path) {
    require_once 'resources/views/'.$path;
}

function layout(string $path) {
    require_once 'resources/views/layouts/'.$path;
}

function asset(string $path) {
    return 'resources/inc/'.$path;
}

autoload();

layout('layout-header.php');

layout('layout-content.php');

layout('layout-footer.php');
