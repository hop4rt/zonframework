<?php

require_once __DIR__ . '/../../common.php';


system('clear');

print(Demos_Zend_Service_LiveDocx_Helper::wrapLine(
    PHP_EOL . 'Checking For Remotely Stored Images' .
    PHP_EOL .
    PHP_EOL)
);

$mailMerge = new Zend_Service_LiveDocx_MailMerge();

$mailMerge->setUsername(DEMOS_ZEND_SERVICE_LIVEDOCX_USERNAME)
          ->setPassword(DEMOS_ZEND_SERVICE_LIVEDOCX_PASSWORD);

print('Checking whether an image is available... ');
if (true === $mailMerge->imageExists('image-1.png')) {
    print('EXISTS. ');
} else {
    print('DOES NOT EXIST. ');
}
print('DONE' . PHP_EOL);

print(PHP_EOL);

unset($mailMerge);
