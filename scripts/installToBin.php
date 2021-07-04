<?php
declare(strict_types=1);


checkCreateFolder(CURRENT_WORKIN_DIR.'/bin');

$lastWd = getcwd();
chdir(CURRENT_WORKIN_DIR.'/bin');

/**
 * @return bool
 */
function codeceptInstalled(): bool
{
    return is_file(CURRENT_WORKIN_DIR . '/bin/codecept.phar');
}

function installCodecept()
{
    exec('wget https://codeception.com/codecept.phar');

    if (codeceptInstalled()) {
        echo "codecept успешно установлен в 'bin/codecept.phar'\n";
    } else {
        throw new Exception("codecept не установлен:(");
    }
}

if(codeceptInstalled()){
    echo "codecept уже установлен в bin/codecept.phar'\n";
} else {
    installCodecept();
}

chdir($lastWd);