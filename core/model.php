<?php
class Model extends Connection
{
    public function get($query)
    {
        $data = [];
        $sql = $this->connect()->query($query);
        while ($row = $sql->fetch_object()) {
            $data[] = $row;
        }
        return $data;
    }

    public function create($table, $data)
    {
        foreach ($data as $key => $value) {
            $fields[] = $key;
            $values[] = "'{$value}'";
        }
        $query = "INSERT INTO $table (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $values) . ")";
        $this->connect()->query($query);
    }
}
