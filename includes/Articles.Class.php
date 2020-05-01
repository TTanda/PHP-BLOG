<?php // include_once is used to ensure this code is not included/run multiple times.
// In the case of a class declaration, it would cause an error to run multiple times!
include_once dirname(__FILE__) . '/Articles.Class.php';
class Articles
{
    // Properties.
    private $allArticles = array();

    // Methods.

    function __construct($jsonFilePath = '')
    { // Check if the file exists.
        if (file_exists($jsonFilePath)) { // Will retrieve the file contents as a string.
            $jsonString = file_get_contents($jsonFilePath);
            // Convert the JSON string to a PHP object.
            $jsonObject = json_decode($jsonString);
            // Check if the "articles" are an array.
            if (is_array($jsonObject->articles)) { 
                $this->allArticles = $jsonObject->articles;
            }
            // If articles are NOT an array.
            else { // Show a warning in the browser.
                echo '<p>WARNING: The articles appear to be missing!</p>';
            }
        }
        // If file doesn't exist.
        else { // Show a warning in the browser.
            echo '<p>WARNING: Your file doesn\'t exist!</p>';
        }
    }

    // Output all of the articles.
    public function output()
    { // If there ARE articles.
        if (is_array($this->allArticles) && !empty($this->allArticles)) { // Heading, and open our unordered list.
            echo '<h2>Article List</h2><ol>';
            // Loop through the articles
            foreach ($this->allArticles as $articles) { // Create an instance of our OTHER class: Snack! Pass in the values.
                $newArticles = new Articles($articles->id, $articles->title, $articles->content);
                // Echo out our result.
                echo '<li>' . $newArticles->output(FALSE) . '</li>';
            } // Close the unordered list.
            echo '</ul>';
        }
    }


    // Find a particular article.
    public function findArticleById($id = FALSE)
    { // Check if the submission is a number (integer.)
        if (is_integer($id)) { // Check if the article at this INDEX even EXISTS
            if (isset($this->allArtilces[$id])) {
                $foundArticle = new Articles(
                    $this->allArticles[$id]->id,
                    $this->allArticles[$id]->title,
                    $this->allArticles[$id]->content
                );

                $foundArticle->output();
            } else { // Output a warning for the user.
                echo '<p>Sorry, we couldn\'t find a article at ID: ' . $id . '!</p>';
            }
        }
        // No ID, or an invalid ID was passed.
        else { // Output a warning for the user.
            echo '<p>No ID, or an invalid ID was passed; unable to find article for ID: ' . $id . '.</p>';
        }
    }
}
