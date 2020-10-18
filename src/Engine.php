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
 * @return bool
 */
function runEngine(string $gameDescription, array $gameRounds): bool
{
    out("Welcome to the Brain Games!\n");
    out("{$gameDescription}\n");

    $userName = prompt("May I have your name?");
    out("Hello, {$userName}\n");

    foreach ($gameRounds as ['question' => $question, 'right_answer' => $rightAnswer]) {
        $receivedAnswer = prompt("Question: {$question}");

        if ($rightAnswer == $receivedAnswer) {
            out("Correct!\n");
        } else {
            $message = <<<MESSAGE
'{$receivedAnswer}' is wrong answer ;(. 
Correct answer was '{$rightAnswer}'.
Let's try again, {$userName}!\n
MESSAGE;

            out($message);

            return false;
        }
    }

    out("Congratulations, {$userName}!\n");

    return true;
}
