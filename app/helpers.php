<?php

if (!function_exists('tt')) {
    /**
     * Translate from current theme.
     *
     * @param string $translateKey
     *
     * @return string|null
     */
    function tt(string $translateKey) : ?string
    {
        $themeService = app()->make('ThemeService');

        return $themeService->themeTranslator($translateKey) ?? $translateKey;
    }
}

if (!function_exists('slugify')) {

    /**
     * Create slug name
     *
     * @param string $slugName slug name
     *
     * @return string
     */
    function slugify($slugName)
    {
        return strtolower(preg_replace([
            '/\s+/', '/\^/', '/\*/', '/\(/', '/\)/', '/\&/', '/\%/', '/\!/', '/\@/', '/\#/', '/\$/', '/\^/',
            '/\_/', '/\+/', '/\=/', '/\{/', '/\}/', '/\[/', '/\]/', '/\|/', '/\</', '/\>/', '/\?/', '/\:/',
            '/\;/', '/\'/', '/\"/', '/\//', '/\\\/'
        ], ['-', ''], $slugName));
    }
}


function getCountLog(string $dbname) {

    $logType = ['view','facebook','twitter','googleplus'];
        
        
    $countlog = DB::table($dbname)->selectRaw('type,COUNT(id) as count')
        ->groupBy('type')
        ->orderBy('type','ASC')
        ->get()->toArray();

    return $countlog;
}

function getCountLogInDate(string $dbname,string $startDate,string $endDate) {
   
    $logType = ['view','facebook','twitter','googleplus'];
        
        
    $countlog = DB::table($dbname)->selectRaw('type,COUNT(id) as count')
        ->whereBetween('created_at',[$startDate,$endDate])
        ->groupBy('type')
        ->orderBy('type','ASC')
        ->get()->toArray();

    return $countlog;
}

function getModuleCountLog(string $module) {

    $countlog = DB::table('audit_logs')->selectRaw('action,COUNT(id) as count')
        ->where('module',$module)
        ->groupBy('action')
        ->orderBy('action','ASC')
        ->get()->toArray();

    return $countlog;
}

function getModuleCountType(string $module) {
    $countType = DB::table('audit_logs')->selectRaw('action')
    ->where('module',$module)    
    ->groupBy('action')
    ->orderBy('action','ASC')
    ->get()->toArray();

    return $countType;
}

function convertDate(string $startDate,string $endDate) {
        
    // convert date
    $explodeStartDate = explode(" ",$startDate); 
    $startDate = date("Y-m-d", strtotime($explodeStartDate[0]));
    
    $explodeEndDate = explode(" ",$endDate); 
    $endDate = date("Y-m-d", strtotime($explodeEndDate[0]));

    $data['startDate'] = $startDate;
    $data['endDate'] = $endDate;

    return $data;
}