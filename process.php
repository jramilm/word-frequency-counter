<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Frequency Results</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <h1>Word Frequency Results</h1>
        <table>
            <thead>
            <tr>
                <th>Word</th>
                <th>Frequency</th>
            </tr>
            </thead>
            <tbody>
            <?php
                include 'stop_words.php';
                function convertToWordArray(string $paragraph) : array {
                    /**
                     * converts the inputted paragraph into word chunks and removing all symbols and stop words
                     */
                    $paragraph = strtolower(str_replace( array( "&", "!", '"', ".", "'", ",", "?", "\r", "\n" ),
                        '', $paragraph));
                    $paragraph = explode(" ", $paragraph);
                    $paragraph = array_diff($paragraph, STOP_WORDS);

                    return array_filter($paragraph);
                }

                function countWordFrequency(array $paragraph) : array {
                    /**
                     * counts all the word occurrences in the word array
                     */
                    return array_count_values($paragraph);
                }

                $paragraph = '';
                $sort_order = 'desc';
                $word_limit = 0;

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $paragraph = $_POST['text'];
                    $sort_order = $_POST['sort'];
                    $word_limit = $_POST['limit'];
                }

                $words_used = convertToWordArray($paragraph);
                $word_occurrences = countWordFrequency($words_used);
                $words_used = array_unique($words_used);
                arsort($word_occurrences);

                if ($sort_order == 'asc') {
                    asort($word_occurrences);
                }
                $words_used = array_keys($word_occurrences);

                if ($word_limit < count($words_used)) {
                    $words_used = array_slice($words_used, 0, $word_limit);
                }

                foreach($words_used as $word) {
                    $frequency = $word_occurrences[$word];
                    echo '<tr>';
                    echo '<td>' . ucfirst($word) . '   </td>';
                    echo "<td>$frequency</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </body>
</html>
