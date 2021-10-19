<?php

namespace Scaffold\Cli;

use Scaffold\Cli\{
  Option,
  Block,
  Hook,
};

final class Console {

  protected $commands = [
    'hook',
    'option',
    'block'
  ];

  protected $namespace;

  protected $basepath;

  public function __construct ( $namespace, $basepath ) {
    
    $this->namespace = ltrim( $namespace, '\\' );

    $this->basepath = $basepath;
  }

  protected function getCommand ( string $command ) {

    if ( ! \in_array( $command, $this->commands ) ) {

      echo "ERROR: Command \"$command\" not found. \n\n";

      exit;
    }

    return $command;
  }

  protected function make ( Fs $fs ) {

    if ( ! $fs->exists() ) {

      $fs->create();

      $fs->write();
    }
  }

  public function runCommand ( array $args ) {

    if ( isset( $args[1] ) && $command = $this->getCommand( $args[1] ) ) {

      $filename = $args[2];

      $template = NULL;

      switch ( $command ) {

        case 'hook':

          $template = new Hook( $command, $filename, $this->basepath, $this->namespace );
          break;
        
        case 'option':

          $template = new Option( $command, $filename, $this->basepath, $this->namespace );
          break;

        case 'block':

          $template = new Block( $command, $filename, $this->basepath );
          break;
        
        default:
          echo "\n\n \"$command\" $filename already exists \n\n";
      }

      $this->make( new Fs( $template ) );
      
      echo "\n\n Yeey! \"$command\" $filename created.\n\n";
      
      exit;
    }
  }
}