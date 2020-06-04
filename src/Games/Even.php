<?php

declare(strict_types=1);

namespace BrainGames\Games\Even;

use function cli\out;
use function cli\prompt;

const GAME_DESCRIPTION = <<<MESSAGE
Answer "yes" if the number is even, otherwise answer "no".\n
MESSAGE;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 100;
const WIN_ASNWER_COUNT = 3;
const CORRECT_ANSWER_MESSAGE = "Correct!\n";

/**
 * Get wrong answer message
 *
 * @param $userName       string user's name
 * @param $needAnswer     string correct answer
 * @param $receivedAnswer string user's answer
 *
 * @return string
 */
function getWrongAnswerMessage($userName, $needAnswer, $receivedAnswer): string
{
    $message = <<<MESSAGE
'{$receivedAnswer}' is wrong answer ;(. Correct answer was '{$needAnswer}'.
Let's try again, {$userName}!\n
MESSAGE;

    return $message;
}

/**
 * Get game win message
 *
 * @param $userName string user's name
 *
 * @return string
 */
function getWinMessage($userName): string
{
    $message = <<<MESSAGE
Congratulations, {$userName}!\n
MESSAGE;

    return $message;
}

/**
 * Get game's description
 *
 * @return string
 */
function getDescription(): string
{
    return GAME_DESCRIPTION;
}

/**
 * Get game's description
 *
 * @param $userName string user's name
 *
 * @return string
 */
function runGameProcess($userName): string
{
    $rightAnswersCount = 0;

    while ($rightAnswersCount < WIN_ASNWER_COUNT) {
        $questionNumber = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
        $needAnswer = ($questionNumber % 2) === 0 ? 'yes' : 'no';

        $receivedAnswer = prompt("Question: {$questionNumber}");

        if ($needAnswer === $receivedAnswer) {
            $rightAnswersCount += 1;
            out(CORRECT_ANSWER_MESSAGE);
        } else {
            return getWrongAnswerMessage($userName, $needAnswer, $receivedAnswer);
        }
    }

    return getWinMessage($userName);
}
