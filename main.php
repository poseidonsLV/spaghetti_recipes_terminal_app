<?php
// get user inputs

// make sure the input is in the format we want, let it be all uppercases or lower cases
$recipeDifficultyLevel = ucfirst(strtolower(readline('Recipe level of difficulty ( Hard/Intermediate/Easy/All ): ')));

$classes = include __DIR__ . '/Spaghetti.php';
$recipes = include __DIR__ . '/recipes.php';

$spaghetti = new Spaghetti($recipes);

if (in_array($recipeDifficultyLevel, ['Hard', 'Intermediate', 'Easy', 'All'])) {
    $spaghetti->setDifficultyLevel($recipeDifficultyLevel);
}

$spaghetti->run();
