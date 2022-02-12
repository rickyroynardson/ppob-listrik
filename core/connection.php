<?php
class Connection
{
    public function connect()
    {
        $connection = new mysqli('localhost', 'root', '', 'ppob_listrik');
        return $connection;
    }
}
