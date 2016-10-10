<?php

namespace PDODblibModule\Doctrine\DBAL\Platforms;

use Doctrine\DBAL\Platforms\SQLServer2008Platform;

class SqlServerPlatform extends SQLServer2008Platform
{
    /**
     * {@inheritDoc}
     */
    public function getListTableColumnsSQL($table, $database = null)
    {
        return "SELECT    CAST(col.name AS text) as name,
                          CAST(type.name AS text) AS type,
                          CAST(col.max_length AS real) AS length,
                          cast(~col.is_nullable as bit) AS notnull,
                          cast(def.definition as bit) AS [default],
                          cast(col.scale as real) as scale,
                          cast(col.precision as real) as precision,
                          cast(col.is_identity as bit) AS autoincrement,
                          cast(col.collation_name as text) AS collation
                FROM      sys.columns AS col
                JOIN      sys.types AS type
                ON        col.user_type_id = type.user_type_id
                JOIN      sys.objects AS obj
                ON        col.object_id = obj.object_id
                LEFT JOIN sys.default_constraints def
                ON        col.default_object_id = def.object_id
                AND       col.object_id = def.parent_object_id
                WHERE     obj.type = 'U'
                AND       obj.name = '$table'";
    }

    /**
     * {@inheritDoc}
     */
    public function getDateTimeFormatString()
    {
        return 'Y-m-d H:i:s';
    }
}
