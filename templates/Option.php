<?php

namespace AppNameSpace;

use \Scaffold\Essentials\Essentials;

use \Scaffold\Essentials\Abstracts\Option;

use \Scaffold\Essentials\Contracts\OptionInterface;

final class ClassName extends Option implements OptionInterface {

  public static function register ( Essentials $container ): OptionInterface {

    return new Self( 
      $container[],
      $container[],
      $container[]
     );
  }
}