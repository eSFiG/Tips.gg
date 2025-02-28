<?php

class MatrixCalculator {
    private array $matrixA = [];
    private array $matrixB = [];
    private int $rowsA = 0;
    private int $colsA = 0;
    private int $rowsB = 0;
    private int $colsB = 0;

    public function __construct(array $matrixA, array $matrixB)
    {
        if (!empty($matrixA)) {
            $this->matrixA = $matrixA;
            $this->rowsA = count($matrixA);
            $this->colsA = count($matrixA[0] ?? []);
        }

        if (!empty($matrixB)) {
            $this->matrixB = $matrixB;
            $this->rowsB = count($matrixB);
            $this->colsB = count($matrixB[0] ?? []);
        }
    }

    public function add(): array|string
    {
        if ($this->rowsA !== $this->rowsB || $this->colsA !== $this->colsB) {
            return "Помилка: Матриці повинні бути однакового розміру для додавання.";
        }

        $result = [];
        for ($i = 0; $i < $this->rowsA; $i++) {
            for ($j = 0; $j < $this->colsA; $j++) {
                $result[$i][$j] = $this->matrixA[$i][$j] + $this->matrixB[$i][$j];
            }
        }
        return $result;
    }

    public function subtract(): array|string
    {
        if ($this->rowsA !== $this->rowsB || $this->colsA !== $this->colsB) {
            return "Помилка: Матриці повинні бути однакового розміру для віднімання.";
        }

        $result = [];
        for ($i = 0; $i < $this->rowsA; $i++) {
            for ($j = 0; $j < $this->colsA; $j++) {
                $result[$i][$j] = $this->matrixA[$i][$j] - $this->matrixB[$i][$j];
            }
        }
        return $result;
    }

    public function multiply(): array|string
    {
        if ($this->colsA !== $this->rowsB) {
            return "Помилка: Кількість стовпців першої матриці повинна дорівнювати кількості рядків другої матриці.";
        }

        $result = array_fill(0, $this->rowsA, array_fill(0, $this->colsB, 0));
        for ($i = 0; $i < $this->rowsA; $i++) {
            for ($j = 0; $j < $this->colsB; $j++) {
                for ($k = 0; $k < $this->colsA; $k++) {
                    $result[$i][$j] += $this->matrixA[$i][$k] * $this->matrixB[$k][$j];
                }
            }
        }
        return $result;
    }

    public function transposeA(): array|string
    {
        if (empty($this->matrixA)) {
            return "Помилка: Матриця A не задана.";
        }
        return $this->transpose($this->matrixA);
    }

    public function transposeB(): array|string
    {
        if (empty($this->matrixB)) {
            return "Помилка: Матриця B не задана.";
        }
        return $this->transpose($this->matrixB);
    }

    private function transpose(array $matrix): array
    {
        $result = [];
        foreach ($matrix as $i => $row) {
            foreach ($row as $j => $value) {
                $result[$j][$i] = $value;
            }
        }
        return $result;
    }
}
