<?php

namespace App\Repository;

use App\Model\FormGenerate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FormGenerateRepository
{
    protected $formGenerateRepository;

    public function __construct(FormGenerate $formGenerateRepository)
    {
        $this->formGenerateRepository = $formGenerateRepository;
    }

    public function listdataById(int $id) { 
        try {
            $data = $this->formGenerateRepository::find($id)->toArray();
            
            if(!empty($data['start_date'] && !empty($data['end_date']))) {
                $allDate = convertDate($data['start_date'],$data['end_date']);
                $dateNow = date('Y-m-d');
                (($allDate['startDate'] <= $dateNow) && ($allDate['endDate'] >= $dateNow) == true) 
                                                        ?  $data = $data : $data = []; 
            }
           
            return $data;
        }catch(ModelNotFoundException $e) {
            
            return [];
        }
    }

    public function addDetail(Request $request,array $formGenerate) { 
        try {
            $request  = $request->all();
            $idForm = $request['idForm'];
            foreach($formGenerate as $keyform => $valform) {

                $this->formGenerateRepository->insert([
                    'form_id' => $idForm,
                    'type'    => $valform['type'],
                    'name'    => $valform['name'],
                    'value'   => $request[$valform['name']],
                ]);
            }
            $success = 'success';
            return $success;
        }catch(ModelNotFoundException $e) {
            return [];
        }
    }

    /**
     * list data all relation from formgenerateDetail.
     *
     * @param mixed $id
     *
     * @return array
     */
    public function findDetailInFormgenerate($id)
    {
        try {
            return $this->formGenerateRepository->where('id', $id)
                ->with('formDetail')
                ->firstOrFail()
                ->toArray();
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    public function sumDataDetailInFormgenerate($id)
    {
        try {
            $formGenerate = $this->formGenerateRepository->where('id', $id)
                ->with('formDetail')
                ->firstOrFail()
                ->toArray();
            $formGenerateDecode = json_decode($formGenerate['form'],true);
            $countFormGenerate = count($formGenerateDecode);

            $formGenerateChunk = array_chunk($formGenerate['form_detail'],$countFormGenerate);
            return count($formGenerateChunk);
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }
}
