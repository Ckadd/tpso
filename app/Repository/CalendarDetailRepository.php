<?php

namespace App\Repository;

use App\Model\CalendarDetail;
use App\Model\MappingLang;
use App;
use Illuminate\Support\Facades\DB;

class CalendarDetailRepository
{

    protected $calendarDetailRepository;

    public function __construct(CalendarDetail $calendarDetailRepository)
    {
        $this->calendarDetailRepository = $calendarDetailRepository;
    }

    public function listAllData()
    {

        $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
        $queryData->where('carlendar_id', '!=', null);
        $queryData->where('calendar_details.status', 1);
        $queryData->where('mapping_langs.code_lang', App::getLocale());
        $queryData->where('mapping_langs.module', 'calendar-details');
        $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
        $queryData = $queryData->get();

        if (count($queryData) > 0) {
            $queryData = $queryData->toArray();
        } else {
            $queryData = MappingLang::join('calendar_details', 'mapping_langs.master_id', '=', 'calendar_details.id')
                ->where('mapping_langs.code_lang', App::getLocale())
                ->where('mapping_langs.module', 'calendar-details')
                ->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
                ->get();

            if (count($queryData) > 0) {
                $queryData = $queryData->toArray();
            }
        }
        if (count($queryData) <= 0) {
            $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
            $queryData->where('carlendar_id', '!=', null);
            $queryData->where('calendar_details.status', 1);
            $queryData->where('mapping_langs.code_lang', 'th');
            $queryData->where('mapping_langs.module', 'calendar-details');
            $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
            $queryData = $queryData->get()->toArray();
        }
        return $queryData;
    }

    public function getDataById(int $id)
    {

        $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
        $queryData->where('calendar_details.id', $id);
        $queryData->where('mapping_langs.code_lang', App::getLocale());
        $queryData->where('mapping_langs.module', 'calendar-details');
        $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
        $queryData = $queryData->first();

        if (isset($queryData)) {
            $queryData = $queryData->toArray();
        } else {
            $f_queryData = MappingLang::join('calendar_details', 'mapping_langs.master_id', '=', 'calendar_details.id')
                ->where('mapping_langs.master_id', $id)
                //->where('mapping_langs.code_lang',App::getLocale())
                ->where('mapping_langs.module', 'calendar-details')
                ->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
                ->first();

            $queryData = MappingLang::join('calendar_details', 'mapping_langs.master_id', '=', 'calendar_details.id')
                ->where('mapping_langs.master_id', $f_queryData->parent_id)
                ->where('mapping_langs.code_lang', App::getLocale())
                ->where('mapping_langs.module', 'calendar-details')
                ->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
                ->first();
            if (count($queryData) > 0) {
                $queryData = $queryData->toArray();
            }
        }

        if (empty($queryData)) {
            $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
            $queryData->where('calendar_details.id', $id);
            $queryData->where('mapping_langs.code_lang', 'th');
            $queryData->where('mapping_langs.module', 'calendar-details');
            $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
            $queryData = $queryData->first()->toArray();
        }
        return $queryData;
    }

    public function listDataIdAndMonth(int $idCategory, int $idMonth)
    {

        $data = DB::table('calendar_details')
            ->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id')
            ->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
            ->where('calendar_details.status', 1)
            ->where('calendar_details.carlendar_id', $idCategory)
            ->whereRaw('MONTH(calendar_details.datetime) =' . $idMonth)
            ->where('mapping_langs.code_lang', App::getLocale())
            ->where('mapping_langs.module', 'calendar-details')
            ->get()
            ->toArray();
        if (count($data) <= 0) {
            $data = DB::table('calendar_details')
                ->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id')
                ->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id')
                ->where('calendar_details.status', 1)
                ->where('calendar_details.carlendar_id', $idCategory)
                ->whereRaw('MONTH(calendar_details.datetime) =' . $idMonth)
                ->where('mapping_langs.code_lang', 'th')
                ->where('mapping_langs.module', 'calendar-details')
                ->get()
                ->toArray();
        }

        return $data;


    }

    public function listDataById(int $idCategory)
    {

        $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
        $queryData->where('calendar_details.status', 1);
        $queryData->where('mapping_langs.code_lang', App::getLocale());
        $queryData->where('mapping_langs.module', 'calendar-details');
        $queryData->where('calendar_details.carlendar_id', $idCategory);
        $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
        $queryData = $queryData->get()->toArray();
        if (count($queryData) <= 0) {
            $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
            $queryData->where('calendar_details.status', 1);
            $queryData->where('mapping_langs.code_lang', 'th');
            $queryData->where('mapping_langs.module', 'calendar-details');
            $queryData->where('calendar_details.carlendar_id', $idCategory);
            $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
            $queryData = $queryData->get()->toArray();
        }
        return $queryData;
    }

    public function listDataByMonth(int $idMonth)
    {

        $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
        $queryData->where('calendar_details.status', 1);
        $queryData->where('mapping_langs.code_lang', App::getLocale());
        $queryData->where('mapping_langs.module', 'calendar-details');
        $queryData->whereRaw('MONTH(calendar_details.datetime) =' . $idMonth);
        $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
        $queryData = $queryData->get()->toArray();

        if (count($queryData) <= 0) {
            $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
            $queryData->where('calendar_details.status', 1);
            $queryData->where('mapping_langs.code_lang', 'th');
            $queryData->where('mapping_langs.module', 'calendar-details');
            $queryData->whereRaw('MONTH(calendar_details.datetime) =' . $idMonth);
            $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
            $queryData = $queryData->get()->toArray();
        }

        return $queryData;
    }

    public function listDataByOrganizationId(int $id)
    {

        $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
        $queryData->where('calendar_details.status', 1);
        $queryData->where('calendar_details.organization_id', $id);
        $queryData->where('mapping_langs.code_lang', App::getLocale());
        $queryData->where('mapping_langs.module', 'calendar-details');
        $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
        $queryData = $queryData->orderBy('order', 'DESC')->take(3)->get()->toArray();
        if (count($queryData) <= 0) {
            $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
            $queryData->where('calendar_details.status', 1);
            $queryData->where('calendar_details.organization_id', $id);
            $queryData->where('mapping_langs.code_lang', 'th');
            $queryData->where('mapping_langs.module', 'calendar-details');
            $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
            $queryData = $queryData->orderBy('order', 'DESC')->take(3)->get()->toArray();
        }
        return $queryData;
    }

    public function listAllDataByOrganization(int $id)
    {

        $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
        $queryData->where('calendar_details.status', 1);
        $queryData->where('calendar_details.organization_id', $id);
        $queryData->where('calendar_details.carlendar_id', '!=', null);
        $queryData->where('mapping_langs.code_lang', App::getLocale());
        $queryData->where('mapping_langs.module', 'calendar-details');
        $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
        $queryData = $queryData->orderBy('order', 'ASC')->get()->toArray();
        if (count($queryData) <= 0) {
            $queryData = $this->calendarDetailRepository->leftJoin('mapping_langs', 'calendar_details.id', '=', 'mapping_langs.master_id');
            $queryData->where('calendar_details.status', 1);
            $queryData->where('calendar_details.organization_id', $id);
            $queryData->where('calendar_details.carlendar_id', '!=', null);
            $queryData->where('mapping_langs.code_lang', 'th');
            $queryData->where('mapping_langs.module', 'calendar-details');
            $queryData->select('calendar_details.*', 'mapping_langs.code_lang', 'mapping_langs.master_id', 'mapping_langs.parent_id');
            $queryData = $queryData->orderBy('order', 'ASC')->get()->toArray();
        }
        return $queryData;
    }
}
