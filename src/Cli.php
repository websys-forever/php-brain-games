<?php

declare(strict_types=1);

namespace BrainGames\Cli;

use function Cli\{out, prompt};
use const BrainGames\Common\{WIN_ANSWER_COUNT, CORRECT_ANSWER_MESSAGE};


/**
 * Run CLI application
 *
 * @param $gameName games's name
 *
 * @return void
 */
function run($gameName)
{
    try {
        $getDescription = "BrainGames\Games\\{$gameName}\getDescription";
        $getQuestionValues = "BrainGames\Games\\{$gameName}\getQuestionValues";
        $getRightAnswer = "BrainGames\Games\\{$gameName}\getRightAnswer";

        out("Welcome to the Brain Games!\n");
        out($getDescription());

        $userName = prompt("May I have your name?");
        out("Hello, {$userName}\n");

        $result = processGame($userName, $getQuestionValues, $getRightAnswer);
        out($result);
    } catch (\Throwable $e) {
        out("Error: {$e->getMessage()}\n");
        return $e->getCode();
    }
}

/**
 * Process game
 *
 * @param $userName          string user's name
 * @param $getQuestionValues string game's function which return question
 * @param $getRightAnswer    string game's function which return right answer
 *
 * @return string
 */
function processGame($userName, $getQuestionValues, $getRightAnswer)
{
    $rightAnswersCount = 0;
    while ($rightAnswersCount < WIN_ANSWER_COUNT) {
        $questionValues = $getQuestionValues();
        $rightAnswer = $getRightAnswer($questionValues);
        $questionString = getQuestionString($questionValues);

        $receivedAnswer = prompt("Question: {$questionString}");

        if ($rightAnswer == $receivedAnswer) {
            $rightAnswersCount += 1;
            out(CORRECT_ANSWER_MESSAGE);
        } else {
            return getWrongAnswerMessage($userName, $rightAnswer, $receivedAnswer);
        }
    }

    return getWinMessage($userName);
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

/**
 * Get question string
 *
 * @param $questionValues mixed question values
 *
 * @return string
 */
function getQuestionString($questionValues): string
{
    return is_array($questionValues) ?
        implode(' ', $questionValues)
        : (string) $questionValues;
}
