<?php

namespace Scaffold\Cli;

use Scaffold\Cli\Template;

class Hook implements Template {

    protected $directory;

    protected $filename;

    protected $path;

    protected $namespace;

    public function __construct( string $directory, string $filename, string $path, string $namespace )
    {

        $this->directory = \ucfirst( $directory ) . 's';

        $this->filename = $filename;

        $this->path = $path;

        $this->namespace = $namespace;
    }

    public function getFile(): string
    {
        
        return $this->path . '/' . $this->directory . '/' . $this->filename . '.php';
    }

    public function getContent(): string
    {
        
        $namespace = $this->namespace . '\\' . $this->directory;
        
        $content = <<<END
        <?php
        
        namespace $namespace;

        use \Scaffold\Essentials\Abstracts\Hooks;

        use \Scaffold\Essentials\Services\HookLoader;

        final class $this->filename extends Hooks {

            /**
             * Callback for hook registered in register method
             * 
             * @param // ref callback args by searching hook documentation on https://developer.wordpress.org
             *
             * @return mixed
             */
            public function callback_name()
            {

            }

            public function register(HookLoader \$hooks): void 
            {

                // \$hooks->addFilter( 'filter_name', 'callback_name', \$this );

                // \$hooks->addAction( 'action_name', 'callback_name', \$this );

                // \$hooks->load();
            }
        }
        END;
        
        return $content;
    }
}