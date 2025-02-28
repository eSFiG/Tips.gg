<?php session_start(); ?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Matrix Calculator</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>Matrix Calculator</h2>
    <form action="process.php" method="POST">
        <label for="rows">Кількість рядків:</label>
        <input type="number" name="rows" id="rows" min="1" max="10" value="<?php echo $_SESSION['rows'] ?? ""; ?>"
            <?php echo isset($_SESSION['operation']) ? "readonly" : "" ?> required>

        <label for="cols">Кількість стовпців:</label>
        <input type="number" name="cols" id="cols" min="1" max="10" value="<?php echo $_SESSION['cols'] ?? ''; ?>"
            <?php echo isset($_SESSION['operation']) ? "readonly" : "" ?> required>

        <label for="operation">Операція:</label>
        <select name="operation" id="operation" required>
            <option value="add"
                <?php echo isset($_SESSION['operation']) && $_SESSION['operation'] == "add" ? "selected" : "" ?>>
                Додавання
            </option>
            <option value="subtract"
                <?php echo isset($_SESSION['operation']) && $_SESSION['operation'] == "subtract" ? "selected" : "" ?>>
                Віднімання
            </option>
            <option value="multiply"
                <?php echo isset($_SESSION['operation']) && $_SESSION['operation'] == "multiply" ? "selected" : "" ?>>
                Множення
            </option>
            <option value="transposeA"
                <?php echo isset($_SESSION['operation']) && $_SESSION['operation'] == "transposeA" ? "selected" : "" ?>>
                Транспонування матриці A
            </option>
            <option value="transposeB"
                <?php echo isset($_SESSION['operation']) && $_SESSION['operation'] == "transposeB" ? "selected" : "" ?>>
                Транспонування матриці B
            </option>
        </select>

        <button type="submit" name="generate">Згенерувати матриці</button>
    </form>

    <?php if (isset($_SESSION['matrices'])): ?>
        <form action="process.php" method="POST">
            <?php if ($_SESSION['operation'] !== 'transposeB'): ?>
                <h3>Матриця A</h3>
                <?php foreach ($_SESSION['matrices']['A'] as $i => $row): ?>
                    <div class="row">
                        <?php foreach ($row as $j => $value): ?>
                            <input type="number" name="matrixA[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo $value; ?>" required>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($_SESSION['operation'] !== 'transposeA'): ?>
                <h3>Матриця B</h3>
                <?php foreach ($_SESSION['matrices']['B'] as $i => $row): ?>
                    <div class="row">
                        <?php foreach ($row as $j => $value): ?>
                            <input type="number" name="matrixB[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo $value; ?>" required>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <button type="submit" name="calculate">Обчислити</button>
            <button type="submit" name="clean">Очистити</button>
        </form>
    <?php endif; ?>

    <?php if (isset($_SESSION['result'])): ?>
        <h3>Результат</h3>
        <?php if (is_array($_SESSION['result'])): ?>
            <table>
                <?php foreach ($_SESSION['result'] as $row): ?>
                    <tr>
                        <?php foreach ($row as $value): ?>
                            <td><?php echo $value; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <?php if (is_string($_SESSION['result'])): ?>
            <p><?php echo $_SESSION['result'] ?></p>
        <?php endif; ?>

        <?php unset($_SESSION['result']); ?>
    <?php endif; ?>
</body>
</html>
