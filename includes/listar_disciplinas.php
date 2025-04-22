<?php
function getDisciplinas($conn) {
    $sql = "SELECT * FROM disciplinas";
    $result = $conn->query($sql);
    $disciplinas = [];
    
    while ($row = $result->fetch_assoc()) {
        $disciplinas[] = $row;
    }
    
    return $disciplinas;
}