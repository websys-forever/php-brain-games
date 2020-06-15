<?php

declare(strict_types=1);

namespace BrainGames\Cli;

use function Cli\{out, prompt};

use const BrainGames\Common\{WIN_ANSWER_COUNT, CORRECT_ANSWER_MESSAGE};

/**
 * Process game flow
 *
 * @param $getDescription     string game's description
 * @param $getQuestionValues  mixed  get questions values
 * @param $getRightAnswer     mixed  get right question's answer
 * @param $getQuestionMessage string get question's message
 *
 * @return void
 */
function processGameFlow($getDescription, $getQuestionValues, $getRightAnswer, $getQuestionMessage)
{
    out("Welcome to the Brain Games!\n");
    out($getDescription);

    $userName = prompt("May I have your name?");
    out("Hello, {$userName}\n");

    $rightAnswersCount = 0;
    $errorAnswer = false;
    while ($rightAnswersCount < WIN_ANSWER_COUNT && false === $errorAnswer) {
        $questionValues = $getQuestionValues();
        $rightAnswer = $getRightAnswer($questionValues);
        $questionMessage = $getQuestionMessage($questionValues);

        $receivedAnswer = prompt("Question: {$questionMessage}");

        if ($rightAnswer == $receivedAnswer) {
            $rightAnswersCount += 1;
            out(CORRECT_ANSWER_MESSAGE);
        } else {
            $errorAnswer = true;
        }
    }

    $result = $errorAnswer ?
        getWrongAnswerMessage($userName, $rightAnswer, $receivedAnswer)
        : getWinMessage($userName);

    out($result);
}

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
