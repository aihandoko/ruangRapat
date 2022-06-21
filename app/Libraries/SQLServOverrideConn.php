<?php

namespace App\Libraries;

use CodeIgniter\Database\SQLSRV\Connection;

class SQLServerOverrideConn extends Connection
{
	public function connect(bool $persistent = false)
    {
        $charset = in_array(strtolower($this->charset), ['utf-8', 'utf8'], true) ? 'UTF-8' : SQLSRV_ENC_CHAR;

        $connection = [
            'UID'                  => empty($this->username) ? '' : $this->username,
            'PWD'                  => empty($this->password) ? '' : $this->password,
            'Database'             => $this->database,
            'ConnectionPooling'    => $persistent ? 1 : 0,
            'CharacterSet'         => $charset,
            'Encrypt'              => $this->encrypt === true ? 1 : 0,
            'ReturnDatesAsStrings' => 1,
        ];

        // If the username and password are both empty, assume this is a
        // 'Windows Authentication Mode' connection.
        if (empty($connection['UID']) && empty($connection['PWD'])) {
            unset($connection['UID'], $connection['PWD']);
        }

        sqlsrv_configure('WarningsReturnAsErrors', 0);
        // $this->connID = sqlsrv_connect($this->hostname, $connection);

        // $connectionInfo = array( "UID" => "ITDev", "PWD" => "ITDev#2022", "Database"=>"BekalDB");
        $this->connID = sqlsrv_connect($this->hostname . ', ' . $this->port, $connection);

        if ($this->connID !== false) {
            // Determine how identifiers are escaped
            $query = $this->query('SELECT CASE WHEN (@@OPTIONS | 256) = @@OPTIONS THEN 1 ELSE 0 END AS qi');
            $query = $query->getResultObject();

            $this->_quoted_identifier = empty($query) ? false : (bool) $query[0]->qi;
            $this->escapeChar         = ($this->_quoted_identifier) ? '"' : ['[', ']'];

            return $this->connID;
        }

        $errors = [];

        foreach (sqlsrv_errors(SQLSRV_ERR_ERRORS) as $error) {
            $errors[] = preg_replace('/(\[.+\]\[.+\](?:\[.+\])?)(.+)/', '$2', $error['message']);
        }

        throw new DatabaseException(implode("\n", $errors));
    }
}