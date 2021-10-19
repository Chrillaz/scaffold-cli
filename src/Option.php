<?php

namespace Scaffold\Cli;

use Scaffold\Cli\Template;

class Option implements Template {

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
        
        use \Scaffold\Essentials\Essentials;
        
        use \Scaffold\Essentials\Abstracts\Option;
        
        use \Scaffold\Essentials\Contracts\OptionInterface;
        
        final class $this->filename extends Option implements OptionInterface {
            
            public static function register ( Essentials \$container ): OptionInterface 
            {
                
                // Ref option settings in Config.php from the \$container
                // Ex. 
                // \$conntainer['option.OPTION.name]
                // \$conntainer['option.OPTION.capability]
                // \$conntainer['option.OPTION.default]
                return new Self( 
                \$container[],
                \$container[],
                \$container[]
                );
            }
        }
        END;
        
        return $content;
    }
}