<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    public function getList() {
        $company = DB::table("companies") ->join('companies', 'company_id', '=', 'companies.id')
                                         ->select('comapanies.*', 'companies.company_name')
                                         ->where('companies.id', '=', $id) ->first();
}
}