<?php
declare(strict_types=1);

$lastWd = getcwd();
chdir(dirname(CURRENT_WORKIN_DIR));

$projectFolder = basename(CURRENT_WORKIN_DIR);
$testsFolder = $projectFolder."/tests";
$codeceptPath = CURRENT_WORKIN_DIR . '/bin/codecept.phar';
/**
 * @param string $projectFolder
 */
function initTests(string $projectFolder)
{
    chdir($projectFolder);
    exec("php bin/codecept.phar bootstrap");

    file_put_contents('codeception.yml','bootstrap:
    bootstrap.php', FILE_APPEND);

    $fileToCopy = [
        'tests/bootstrap.php' => dirname(__DIR__).'filesToCopy/bootstrapRoot.php',
        'tests/unit/bootstrap.php' => dirname(__DIR__).'filesToCopy/bootstrap.php',
        'tests/functional/bootstrap.php' => dirname(__DIR__).'filesToCopy/bootstrap.php',
    ];

    foreach ($fileToCopy as $copyTo => $copyFrom){
        copy($copyFrom, $copyTo);
    }

    echo 'успешно инициализировали codecept';
}

if(is_dir($testsFolder)){
    echo "папка tests уже существует, желаете переинициализировать папку?(y/n): ";
    $answer = readline();
    if(in_array($answer, ['y', 'Y', 'yes', 'Yes'])){
        deleteDir($testsFolder);
        initTests($projectFolder);
    }
} else {
    initTests($projectFolder);
}

chdir($lastWd);