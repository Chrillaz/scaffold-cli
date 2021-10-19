<?php

namespace Scaffold\Cli;

use Scaffold\Cli\Template;

class Block implements Template {

    protected $directory;

    protected $filename;

    protected $path;

    public function __construct( string $directory, string $filename, string $path )
    {

        $this->directory = $directory . 's';

        $this->filename = $filename;

        $this->path = \str_replace( '/src', '/resources/scripts', $path );
    }

    public function getFile(): string
    {
        
        if ( ! \file_exists( $dir = $this->path . '/' . $this->directory . '/' . $this->filename ) ) {

            $dir = \mkdir( $dir );
        }

        return $dir . '/index.tsx';
    }

    public function getName( string $type ): string {

        $nameparts = explode( '-', $this->filename );

        switch( $type ) {

            case 'camel': {

                return array_reduce( $nameparts, function( $acc, $part ) {

                    return $acc .= ( $acc === '' ? \strtolower( $part ) : \ucfirst( $part ) );
                }, '');
            }
            
            case 'spaced': {

                return array_reduce( $nameparts, function( $acc, $part ) {

                    return $acc .= \ucfirst( $part ) . ' ';
                }, '');
            }
        }
    }

    public function getContent(): string
    {

        $camelname = $this->getName( 'camel' );

        $spacedname = \rtrim( $this->getName( 'spaced' ) );

        $content = <<<END
        const { React } = window;

        const $camelname = {
            apiVersion: 1,
            title: '$spacedname',
            category: 'scaffold-theme-blocks',
            icon: 'block-default', //without dashicons prefix https://developer.wordpress.org/resource/dashicons/#plugins-checked
            description: 'Example description',
            keywords: [],
            attributes: {},
            providesContext: {},
            usesContext: [],
            supports: {},
            example: {},
            edit: ( props: IBlockProps ) => <div>$spacedname</div>,
            save: ( props: IBlockProps ) => <div>$spacedname</div>
        }

        export {
            $camelname
        }
        END;
        
        return $content;
    }
}