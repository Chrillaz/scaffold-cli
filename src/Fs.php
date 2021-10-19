<?php

namespace Scaffold\Cli;

final class Fs {

    protected $template;

    protected $file;

    public function __construct( Template $template )
    {

        $this->template = $template;
    }

    public function exists(): bool
    {

        return \file_exists( $this->template->getFile() );
    }

    public function create(): void
    {

        $this->file = \fopen( $this->template->getFile(), 'w' );
    }

    public function write(): void
    {

        \fwrite( $this->file, $this->template->getContent() );
        \fclose( $this->file );
    }
}