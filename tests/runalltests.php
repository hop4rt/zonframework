<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

$PHPUNIT = null;
if (!$PHPUNIT) {
    if (!$PHPUNIT && strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $PHPUNIT = `for %i in (phpunit.bat) do @echo.   %~\$PATH:i)`;
    } else {
        $PHPUNIT = trim(`echo \$PHPUNIT`);
        if (empty($PHPUNIT)) {
            $PHPUNIT = `which phpunit`;
            $PHPUNIT = trim($PHPUNIT);
        }
    }

    $PHPUNIT = trim($PHPUNIT);
    if (!$PHPUNIT) {
        echo 'PHPUnit was not found on your OS!' . PHP_EOL;
        exit(1);
    }
}

if (!is_executable($PHPUNIT)) {
    echo 'PHPUnit is not executable (' . $PHPUNIT . ')';
}

$PHPUNIT = '../bin/phpunit'; //PHPUnit from composer

// locate all tests
$files = glob('{Zend/*/AllTests.php,Zend/*Test.php}', GLOB_BRACE);
sort($files);

// we'll capture the result of each phpunit execution in this value, so we'll know if something broke
$result = 0;

// run through phpunit
while (list(, $file)=each($files)) {
    echo "Executing {$file}" . PHP_EOL;
    system(
        $PHPUNIT . ' -v --stderr -d memory_limit=-1 -d error_reporting=E_ALL\&E_STRICT -d display_errors=1 '
            . escapeshellarg($file),
        $commandResult
    );
    echo PHP_EOL . 'Finished executing ' . $file . PHP_EOL . PHP_EOL;
    
    if ($commandResult) {
        echo PHP_EOL . 'Result of ' . $file . ' is ' . $commandResult . PHP_EOL . PHP_EOL;
        $result = $commandResult;
    }
}


echo 'All done. Result: ' . $result . PHP_EOL;
exit($result);
