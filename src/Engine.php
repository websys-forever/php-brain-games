<?php

declare(strict_types=1);

namespace BrainGames\Engine;

use function Cli\{out, prompt};

const GAME_ROUNDS_COUNT = 3;

/**
 * Process game flow
 *
 * @param $gameDescription string game's description
 * @param $gameRounds      array  game's data (questions messages and right answers)
 *
 * @return void
 */
function runGamesEngine(string $gameDescription, array $gameRounds)
{
    out("Welcome to the Brain Games!\n");
    out("{$gameDescription}\n");

    $userName = prompt("May I have your name?");
    out("Hello, {$userName}\n");

    foreach ($gameRounds as ['question' => $question, 'right_answer' => $rightAnswer]) {
        $receivedAnswer = prompt("Question: {$question}");

        ['result' => $result, 'message' => $message] = getResult($rightAnswer, $receivedAnswer, $userName);

        out($message);

        if (!$result) {
            break;
        }
    }

    if ($result) {
        out("Congratulations, {$userName}!\n");
    }
}

function getResult($rightAnswer, $receivedAnswer, $userName): array
{
    $result = [];
    if ($rightAnswer == $receivedAnswer) {
        $result['message'] = "Correct!\n";
        $result['result']  = true;
    } else {
        $result['message'] = <<<MESSAGE
'{$receivedAnswer}' is wrong answer ;(. 
Correct answer was '{$rightAnswer}'.
Let's try again, {$userName}!\n
MESSAGE;
        $result['result']  = false;
    }

    return $result;
}
