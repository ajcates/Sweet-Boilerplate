<?php
TasteTest::includeCollection(array(
  'setUp' => function() {
    SweetFramework::loadFile(LOC . 'sweet-framework/helpers/', 'functional.php');
  },
  'f_first' => function() {
    $test = array(1, 2, 3, 4);

    Taste::assertEquals(f_first($test), 1);

    Taste::assertNotEquals(f_first($test), 2);

    return true;
  },
  'f_last' => function() {

    $test = array(1, 2, 3, 4);

    Taste::assertEquals(f_last($test), 4);

    Taste::assertNotEquals(f_last($test), 2);
    return true;
  },
  'f_call' => function() {
    $func1 = function() {
      return 5;
    };

    $func2 = function($arg) {
      return $arg;
    };

    Taste::assertEquals(f_call($func1), 5);
    Taste::assertEquals(f_call($func2, 'test'), 'test');

    return true;
  },
  'f_callable' => function() {
    return true;
  }
), 'f');
