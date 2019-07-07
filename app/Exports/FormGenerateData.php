<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Model\FormGenerateDetail;
use App\Model\FormGenerate;

class FormGenerateData implements FromView
{
    public function __construct(int $id, string $startDate, string $endDate)
    {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        // columns
        $columnsHeader = FormGenerate::query()->where('id',$this->id)->get();
        $dataColumns = json_decode($columnsHeader[0]->form,true);
        $columns = array_column($dataColumns,'label');
        $newValue = [];
        $newCreated = [];
        $allData = [];

        if(!empty($this->startDate) && !empty($this->endDate)) {
            $dateAll = convertDate($this->startDate,$this->endDate);
            
            // value form
            $data = FormGenerateDetail::select('created_at','value')
            ->whereBetween('created_at',[$dateAll['startDate'],$dateAll['endDate']])
            ->where('form_id',$this->id)->get()->toArray();
            $newData = array_chunk($data,COUNT($columns));
            
            
            foreach($newData as $keynew => $value) {
                $newValue['value'] = array_column($value,'value');
                $newCreated['created_at'] = array_column($value,'created_at');
                $allData[] = array_merge($newValue,$newCreated);
            }
            
            return view('exports.form-generate', [
                'formValue' => $allData,
                'formColumns' => $columns
            ]);
        }
        
        // value form
        $data = FormGenerateDetail::select('created_at','value')->where('form_id',$this->id)->get()->toArray();
        $newData = array_chunk($data,COUNT($columns));
        
       
        foreach($newData as $keynew => $value) {
           $newValue['value'] = array_column($value,'value');
           $newCreated['created_at'] = array_column($value,'created_at');
           $allData[] = array_merge($newValue,$newCreated);
        }
        
        return view('exports.form-generate', [
            'formValue' => $allData,
            'formColumns' => $columns
        ]);
    }
}
