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

    public function update($table, $data, $where, $id)
    {
        foreach ($data as $key => $value) {
            $modify[] = "$key = '$value'";
        }
        $query = "UPDATE $table SET " . implode(", ", $modify) . " WHERE $where = $id";
        $this->connect()->query($query);
    }

    public function delete($table, $where, $id)
    {
        $query = "DELETE FROM $table WHERE $where = $id";
        $this->connect()->query($query);
    }
}
