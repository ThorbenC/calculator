<?php

function reken($operator, $num1, $num2)
{
    switch ($operator) {
        case "Add":
            return $num1 + $num2;

        case "Subtract":
            return $num1 - $num2;

        case "Multiply":
            return $num1 * $num2;

        case "Divide":
            return $num1 / $num2;

        case "Modulo":
            return floatval($num1) % floatval($num2);
    }
}

function valideernummers($operator, $num1, $num2)
{
    $errors = [
        "error1" => '',
        "error2" => '',
        "other" => ''
    ];

    if (!is_numeric($num1)) {
        $errors['error1'] = "Number 1 is not a number!";
    }
    if (!is_numeric($num2)) {
        $errors['error2'] = "Number 2 is not a number!";
    }

    if ($operator == 'Divide' || $operator == 'Modulo') {
        if ($num1 == 0 || $num2 == 0) {
            $errors['other'] = "Division by zero is not allowed!";
        }
    }
    return $errors;
}

$operator = '';
$num1 = '';
$num2 = '';
$resultaat = '';
$errors = [];
$error1 = '';
$error2 = '';
$other = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $operator = $_POST['operator'];
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];

    floatval("modulo");

    $errors = valideernummers($operator, $num1, $num2);

    if (!$errors['error1'] && !$errors['error2'] && !$errors['other']) {
        $resultaat = reken($operator, $num1, $num2);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
</head>

<body>
    <?php echo "<h1>Calculator</h1>"; ?>
    <form method="POST">
        <label for="num1" id="num1"> Number 1 </label>
        <input type="text" name="num1" value="<?= $num1 ?>">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $errors['error1'];
        } ?>
        <br> <br>
        <label for="num2" id="num2"> Number 2 </label>
        <input type="text" name="num2" value="<?= $num2 ?>">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $errors['error2'];
        } ?>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $errors['other'];
        } ?>
        <br>

        <h3>Operation: <?= $operator ?></h3>
        <h3>Result: <?= $resultaat ?></h3>

        <input type="submit" name="operator" value="Add">
        <input type="submit" name="operator" value="Subtract">
        <input type="submit" name="operator" value="Multiply">
        <input type="submit" name="operator" value="Divide">
        <input type="submit" name="operator" value="Modulo">
    </form>
</body>

</html>