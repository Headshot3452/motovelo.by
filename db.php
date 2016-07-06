<?php
return array('connectionString' => 'mysql:host=localhost;dbname=freshtou_motovelo24',
             'emulatePrepare' => true,
            'username' => 'freshtou_motovel',
            'password' => 'hkC@chSH9V&3',
            'charset' => 'utf8',
            'tablePrefix' => '',
            // включаем профайлер
            'enableProfiling'=>true,
            // показываем значения параметров
            'enableParamLogging' => true,
            'driverMap'=>array(
                'pgsql'=>'CPgsqlSchema',    // PostgreSQL
                'mysqli'=>'application.components.MySqlSchema',   // MySQL
                'mysql'=>'application.components.MySqlSchema',    // MySQL
                'sqlite'=>'CSqliteSchema',  // sqlite 3
                'sqlite2'=>'CSqliteSchema', // sqlite 2
                'mssql'=>'CMssqlSchema',    // Mssql driver on windows hosts
                'dblib'=>'CMssqlSchema',    // dblib drivers on linux (and maybe others os) hosts
                'sqlsrv'=>'CMssqlSchema',   // Mssql
                'oci'=>'COciSchema',        // Oracle driver
            ),
 );
?>