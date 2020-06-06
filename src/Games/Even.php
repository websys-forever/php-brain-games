<?php

declare(strict_types=1);

namespace BrainGames\Games\Even;

const GAME_DESCRIPTION = <<<MESSAGE
Answer "yes" if the number is even, otherwise answer "no".\n
MESSAGE;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 100;

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
 * Get game's question
 *
 * @return int
 */
function getQuestionValues(): int
{
    return rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
}

/**
 * Get game's right answer
 *
 * @param int $questionNumber question's number
 *
 * @return string
 */
function getRightAnswer(int $questionNumber): string
{
    return ($questionNumber % 2) === 0 ? 'yes' : 'no';
}
