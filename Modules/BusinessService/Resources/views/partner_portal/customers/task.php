<?php

// Below arrays detail all eight possible movements from a cell
// (top, right, bottom, left, and four diagonal moves)
$row = [-1, -1, -1, 0, 1, 0, 1, 1];
$col = [-1, 1, 0, -1, -1, 1, 0, 1];

// Function to check if it is safe to go to cell (x, y) from the current cell.
// The function returns false if (x, y) is not valid matrix coordinates
// or cell (x, y) is already processed.
function isSafe($x, $y, $processed)
{
    return $x >= 0 && $x < count($processed) && $y >= 0 && $y < count($processed[0]) && !$processed[$x][$y];
}

// Recursive function to generate all possible words in a boggle
function searchBoggle($board, $words, &$result, &$processed, $i, $j, $path = '')
{
    global $row, $col;

    // Mark the current node as processed
    $processed[$i][$j] = true;

    // Update the path with the current character
    $path .= $board[$i][$j];

    // Check if the path is present in the input set
    if (in_array($path, $words)) {
        $result[$path] = $path;
    }

    // Check for all eight possible movements from the current cell
    for ($k = 0; $k < count($row); $k++) {
        // Skip if a cell is invalid, or it is already processed
        if (isSafe($i + $row[$k], $j + $col[$k], $processed)) {
            searchBoggle($board, $words, $result, $processed, $i + $row[$k], $j + $col[$k], $path);
        }
    }

    // Backtrack: mark the current node as unprocessed
    $processed[$i][$j] = false;
}

function searchInBoggle($board, $words)
{
    $result = [];

    // Base case
    if (empty($board)) {
        return $result;
    }

    // `M × N` board
    $M = count($board);
    $N = count($board[0]);

    // Construct a boolean matrix to store whether a cell is processed or not
    $processed = array_fill(0, $M, array_fill(0, $N, false));

    // Generate all possible words in a boggle
    for ($i = 0; $i < $M; $i++) {
        for ($j = 0; $j < $N; $j++) {
            // Consider each character as a starting point and run DFS
            searchBoggle($board, $words, $result, $processed, $i, $j);
        }
    }

    return $result;
}

// Example usage:
$board = [
    ['M', 'S', 'E'],
    ['R', 'A', 'T'],
    ['L', 'O', 'N']
];

$words = ['STAR', 'NOTE', 'SAND', 'STONE'];

$validWords = searchInBoggle($board, $words);
print_r(array_keys($validWords)); // array_keys are used to get the words as values from the associative array
