<?php

use Illuminate\Database\Seeder;


class FixUserDataRowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data_rows_users = DB::table('data_rows')
                ->join('data_types', 'data_rows.data_type_id', '=', 'data_types.id')
                ->where('data_types.name', '=', 'users')
                ->select(array('data_rows.*'))
                ->get();

        $this->deleteByColumn($data_rows_users, 'organization_id');
        $this->deleteByColumn($data_rows_users, 'user_belongsto_organization_relationship');
        
    }

    public function deleteByColumn($data_rows_users, $column) {
        $count_organization_id = 0;
        $ids = array();
        foreach($data_rows_users as $row) {
            if ($row->field == $column) {
                $count_organization_id++;
                array_push($ids, $row->id);
                
            }
        }

        unset($ids[0]);
        $ids = array_values($ids);

        // print_r($ids);
        if (!empty($ids)) {
            $delete = DB::table('data_rows')->whereIn('id', $ids)->delete();
            print_r("Deleted " . $column. "\n");
        } 
    }
    
}
