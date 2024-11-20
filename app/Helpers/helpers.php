<?php


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

if (!function_exists('timeNow')) {
    function timeNow(): string
    {
        $tz = 'Europe/Warsaw';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        return $dt->format('Y-m-d H:i:s');
    }
}


if (!function_exists('getMonths')) {
    function getMonths()
    {
        return DB::connection('sqlsrv')->select(
            "SELECT * FROM [dbo].[months] ORDER BY [id]",
        );
    }
}

if (!function_exists('getYears')) {
    function getYears()
    {
        return DB::connection('sqlsrv')->select(
            "SELECT * FROM [dbo].[years] ORDER BY [id]",
        );
    }
}


if (!function_exists('matchArrayParameters')) {
    /**
     * match array
     * only keys from $defParams array are updated
     * all extra parameters from $params are discarded
     * @param $defParams array
     * @param $params array
     * @return array
     */
    function matchArrayParameters(array $defParams, array $params): array
    {
        return array_slice(array_merge($defParams, $params), 0, count($defParams));
    }
}









if (!function_exists('getModelByTableName')) {
    function getModelByTableName($tableName): mixed
    {
        return Str::studly(Str::singular($tableName));
        //$className = 'App\\Models\\' . Str::studly(Str::singular($tableName));
        //return $className;
        //if (class_exists($className)) {
        //    return new $className;
        //}
        //return false;
    }
}
