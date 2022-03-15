<?php

class Spaghetti {

    /**
     * @var array
     */
    private array $recipes;

    /**
     * @var string
     */
    private string $recipeChosen;

    /**
     * @var string|null
     */
    private ?string $recipeDifficultyLevel = null;

    /**
     * @param $recipes
     */
    public function __construct($recipes)
    {
        $this->recipes = $recipes;
    }

    public function run() {
        $this->modifyRecipesBasedOnDifficultyLevel();
        $this->displaySpaghettiRecipes();
        $this->getUserSpaghettiRecipeChoose();
        $this->displayRecipeInfo();
    }

    public function modifyRecipesBasedOnDifficultyLevel() : void {
        if ($this->recipeDifficultyLevel !== 'All') {
            $newRecipes = [];

            foreach($this->recipes as $key => $recipe) {
                if ($recipe['difficulty_level'] === $this->recipeDifficultyLevel) {
                    $newRecipes[$key] = $recipe;
                }
            }

            $this->recipes = $newRecipes;
        }
    }

    public function displaySpaghettiRecipes() : void {
        $recipesNamesList = array_column($this->recipes, 'recipe_name');

        echo 'Recipes:';
        foreach ($recipesNamesList as $key => $recipeName) {
            $key++;
            echo "\n  $key) " . $recipeName;
        }
    }

    public function getUserSpaghettiRecipeChoose() : void {
        echo "\n";
        $this->recipeChosen = readline("Choose recipe by name: ");
    }

    public function displayRecipeInfo() : void {
        $recipe = $this->recipes[$this->recipeChosen];

        echo "\n";
        echo "\n";

        echo "Introduction information about recipe: \n";

        echo 'Recipe Title: ' . $recipe['recipe_title'] . "\n";
        echo 'Recipe Name: ' . $recipe['recipe_name'] . "\n";
        echo 'Recipe Desc: ' . $recipe['recipe_desc'] . "\n";
        echo 'Difficulty Level: ' . $recipe['difficulty_level'] . "\n";

        echo "\n";

        echo 'Serves: ' . $recipe['serves'] . "\n";
        echo 'Preparation: ' . $recipe['preparation'] . "\n";
        echo 'Cooking Time: ' . $recipe['cooking_time'] . "\n";
        echo 'Ratings Count: ' . $recipe['ratings_count'] . "\n";
        echo 'Rating: '. $this->displayRatingAsStars($recipe['rating']) . "\n";

        echo 'Alright! Lets finally start creating the ' . $recipe['recipe_name'] . "!\n";

        $this->displayIngredients($recipe['ingredients']);
        $this->displayInstructions($recipe['instructions']);
    }

    /**
     * @param $instructons
     */
    public function displayInstructions($instructons) : void {
        echo "\n" . 'Instructions: ' . "\n";

        foreach($instructons as $step => $instruction) {
            $step = explode('_', $step)[1];

            echo "$step)". $instruction . "\n";
        }
    }

    /**
     * @param $ingredients
     */
    public function displayIngredients($ingredients) : void {
        echo "\n" . 'Ingredients: ' . "\n";

        foreach($ingredients as  $ingredient) {
            echo "". $ingredient . "\n";
        }
    }

    /**
     * @param $level
     */
    public function setDifficultyLevel($level) : void {
        $this->recipeDifficultyLevel = $level;
    }

    /**
     * @param $rating
     * @return string
     */
    public function displayRatingAsStars($rating) : string {
        $stars = '';

        for ($i = 1; $i <= $rating; $i++) {
            $stars .= '★';
        }

        if ($rating !== 5) {
            for ($i = 1; $i <= 5 - $rating; $i++) {
                $stars .= '✩';
            }
        }

        return $stars;
    }

}