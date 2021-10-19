<?php

namespace Scaffold\Cli;

interface Template {
    
    public function getFile(): string;

    public function getContent(): string;
}