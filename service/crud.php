<?php

function insert($conn, $sql)
{
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

function selectAll($conn, $sql)
{

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function updatedata($conn, $sql)
{
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
function delete($conn, $sql)
{

    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
?>