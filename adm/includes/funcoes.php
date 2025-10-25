<?php
// Funções administrativas (PDO)
function db_query($sql, $params = []) {
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}
function db_fetch_assoc($stmt) {
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function db_fetch_all($stmt) {
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function db_last_insert_id() {
    global $conn;
    return $conn->lastInsertId();
}
function db_affected_rows($stmt) {
    return $stmt->rowCount();
}
function db_escape($str) {
    global $conn;
    return substr($conn->quote($str), 1, -1);
}
