<?php

include '../vendor/autoload.php';

use Botsphere\DetermineSpeechOrderForEvenSessionCommand;

ob_start();

include 'tpl/form.php';

if (isset($_POST['member_ids'])) {
    $commandArgs = array_map('trim', explode("\n", $_POST['member_ids']));

    $command = new DetermineSpeechOrderForEvenSessionCommand();

    $evenSessionSpeechOrder = call_user_func_array([$command, 'execute'], $commandArgs);

    echo 'Results:<br/>';

    echo implode("<br/>", $evenSessionSpeechOrder);
}

$content = ob_get_clean();

include 'tpl/layout.php';