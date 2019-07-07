<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Model\FormGenerateDetail;
use App\Model\FormGenerate;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormgenerateExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return FormGenerateDetail::query()->select('created_at','value')->where('form_id',$this->id);
    }

    public function headings(): array
    {
        $columnsHeader = FormGenerate::query()->where('id',$this->id)->get();
        $data = json_decode($columnsHeader[0]->form,true);
        $columns = array_column($data,'label');
        array_unshift($columns,'date');
        array_unshift($columns,'NO');
        return $columns;
    }
}