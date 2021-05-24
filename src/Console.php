<?php

namespace Scaffold\Cli;

final class Console {

  protected $commands = [
    'hook',
    'option'
  ];

  protected $namespace;

  protected $basepath;

  public function __construct ( $namespace, $basepath ) {
    
    $this->namespace = $namespace;

    $this->basepath = $basepath;
  }

  protected function getCommand ( string $command ) {

    if ( ! \in_array( $command, $this->commands ) ) {

      echo "ERROR: Command \"$command\" not found.";

      exit;
    }

    return $command;
  }

  protected function make ( string $command, array $args ) {

    if ( isset( $args[2] ) ) {
      
      if ( ! \file_exists( $dir = $this->basepath . \ucfirst( '/' . $command . 's/' ) ) ) {

        $dir = \mkdir( $dir );
      }

      $filename = $dir . trim( $name = $args[2] ) . '.php';

      $content = \file_get_contents( __DIR__ . "/templates/$command" . ".php" );

      $content = str_replace( 'AppNameSpace', $this->namespace . '\\' . \ucfirst( $command ) . 's', $content );

      $content = str_replace( 'ClassName', $name, $content );

      \file_put_contents( $filename, $content );

      echo $name . " created. \n\n";
    }

    exit;
  }

  public function runCommand ( array $args ) {

    if ( isset( $args[1] ) && $command = $this->getCommand( $args[1] ) ) {

      $this->make( $command, $args );
    }
  }
}