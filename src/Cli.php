<?php

declare(strict_types=1);

namespace BrainGames\Cli;

use function Cli\{out, prompt};

/**
 * Process game flow
 *
 * @param $gameDescription string game's description
 * @param $gameRounds      array  game's data (questions messages and right answers)
 *
 * @return void
 */
function processGameFlow(string $gameDescription, array $gameRounds)
{
    out("Welcome to the Brain Games!\n");
    out("{$gameDescription}\n");

    $userName = prompt("May I have your name?");
    out("Hello, {$userName}\n");

    $playGameRounds = function (array $gameRounds) use ($userName): string {
        foreach ($gameRounds as $round) {
            $receivedAnswer = prompt("Question: {$round['question']}");

            if ($round['right_answer'] == $receivedAnswer) {
                out("Correct!\n");
            } else {
                return <<<MESSAGE
'{$receivedAnswer}' is wrong answer ;(. 
Correct answer was '{$round['right_answer']}'.
Let's try again, {$userName}!\n
MESSAGE;
            }
        }

        return "Congratulations, {$userName}!\n";
    };

    out($playGameRounds($gameRounds));
}
