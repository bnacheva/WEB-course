<?php

error_reporting (E_ALL ^ E_NOTICE);

$students = [
    [ 'name' => 'Мария Георгиева', 'fn' => 62543, 'mark' => 5.25],
    [ 'name' => 'Иван Иванов', 'fn' => 62555, 'mark' => 6.00],
    [ 'name' => 'Петър Петров', 'fn' => 62549, 'mark' => 5.00],
    ['name' => 'Петя Димитрова', 'fn' => 62559, 'mark' => 6.00]
];

$post = (!empty($_POST)) ? true : false;

if ($post) {
    $studentName = trim($_POST['nameStudent']);
    $studentFn = trim($_POST['fnStudent']);
    $studentGrade = trim($_POST['gradeStudent']);
    $error = '';

    if (empty($studentName)) {
        $error .= "Името на студента е задължително поле.<br/>";
    }
    if (!empty($studentName) && strlen($studentName) > 200) {
        $error .= "Името на студента трябва да бъде с максимална дължина 200 символа.<br/>";
    }
    if (empty($studentFn)) {
        $error .= "Факултетният номер на студента е задължително поле.<br/>";
    }
    if (!empty($studentFn) && ($studentFn < 62000 || $studentFn > 62999) && !is_numeric($studentFn)) {
        $error .= "Факултетният номер на студента трябва да бъде между 62000 и 62999.<br/>";
    }
    if (empty($studentGrade)) {
        $error .= "Оценката на студента е задължително поле.<br/>";
    }
    if (!empty($studentGrade) && ($studentGrade < 2 || $studentGrade > 6) && !is_numeric($studentGrade)) {
        $error .= "Оценката на студента трябва да бъде между 2,00 и 6,00.<br/>";
    } else {
        $error .= "";
    }
    if (!$error) {
        array_push($students, [
            'name' => $studentName,
            'fn' => $studentFn,
            'mark' => $studentGrade
        ]);
        array_multisort(array_column($students, 'fn'), SORT_ASC, $students);
        array_multisort(array_column($students, 'mark'), SORT_DESC, $students);
        echo json_encode($students, true, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['error_msg' => $error], JSON_UNESCAPED_UNICODE);
    }
}

 