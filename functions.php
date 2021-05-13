<?php
function add($pdo) {
    $start_date = trim(filter_input(INPUT_POST, 'start_date'));
    $tax_rate = trim(filter_input(INPUT_POST, 'tax_rate'));
    if($start_date !== '' && $tax_rate !== '') {
        $stmt = $pdo->prepare(
            "INSERT INTO
                taxes (start_date, tax_rate)
            VALUES
                (:start_date, :tax_rate)
            "
        );
        $stmt->bindValue('start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindValue('tax_rate', $tax_rate, PDO::PARAM_INT);
        $stmt->execute();
    }
}

function delete($pdo) {
    $id_datas = filter_input(INPUT_POST, 'id_datas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    if(isset($id_datas)) {
        $stmt = $pdo->prepare(
            "DELETE FROM taxes WHERE id = :id_data"
        );
        foreach($id_datas as $id_data) {
            $stmt->bindValue('id_data', $id_data, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
    
}