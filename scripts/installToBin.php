<?php
declare(strict_types=1);

checkCreateFolder(CURRENT_WORKIN_DIR.'/bin');

$lastWd = getcwd();
chdir(CURRENT_WORKIN_DIR.'/bin');

exec('wget https://codeception.com/codecept.phar');

if(is_file(CURRENT_WORKIN_DIR.'/bin/codecept.phar')){
    echo "codecept installed successfully to 'bin/codecept.phar'\n";
}

chdir($lastWd);