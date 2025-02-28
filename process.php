<?php
session_start();
require_once 'MatrixCalculator.php';

if (isset($_POST['generate'])) {
    $rows = (int)$_POST['rows'];
    $cols = (int)$_POST['cols'];
    $operation = $_POST['operation'];

    $_SESSION['rows'] = $rows;
    $_SESSION['cols'] = $cols;
    $_SESSION['operation'] = $operation;

    if ($operation !== 'transposeB') {
        $_SESSION['matrices']['A'] = generateMatrix($rows, $cols);
    }

    if ($operation !== 'transposeA') {
        $_SESSION['matrices']['B'] = generateMatrix($rows, $cols);
    }

    header('Location: index.php');
}

if (isset($_POST['calculate'])) {
    $matrixA = $_POST['matrixA'] ?? [];
    $matrixB = $_POST['matrixB'] ?? [];
    $operation = $_SESSION['operation'];

    if (!empty($matrixA) || !empty($matrixB)) {
        $calculator = new MatrixCalculator($matrixA, $matrixB);

        switch ($operation) {
            case "add":
                $_SESSION['result'] = $calculator->add();
                break;
            case "subtract":
                $_SESSION['result'] = $calculator->subtract();
                break;
            case "multiply":
                $_SESSION['result'] = $calculator->multiply();
                break;
            case "transposeA":
                $_SESSION['result'] = $calculator->transposeA();
                break;
            case "transposeB":
                $_SESSION['result'] = $calculator->transposeB();
                break;
        }
    } else {
        $_SESSION['result'] = "Помилка: Жодна з матриць не задана.";
    }

    header('Location: index.php');
}

if (isset($_POST['clean'])) {
    session_unset();

    header('Location: index.php');
}

function generateMatrix($rows, $cols): array
{
    $matrix = [];
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $matrix[$i][$j] = rand(1, 10);
        }
    }
    return $matrix;
}
