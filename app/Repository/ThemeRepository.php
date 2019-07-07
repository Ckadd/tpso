<?php

namespace App\Repository;

use App\Model\Theme;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Service\FileConfigService;

class ThemeRepository
{
    protected $themeModel;

    protected $fileConfigService;

    public function __construct(
        Theme $themeModel,
        FileConfigService $fileConfigService
    ) {
        $this->themeModel        = $themeModel;
        $this->fileConfigService = $fileConfigService;
    }

    /**
     * Find by id.
     *
     * @param int $id
     *
     * @return array
     */
    public function findById($id)
    {
        try {
            return $this->themeModel
                ->where('id', $id)
                ->firstOrFail()
                ->toArray();
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    /**
     * Set current active theme.
     *
     * @param array $theme
     *
     * @return mixed
     */
    public function setActive(array $theme)
    {
        if (empty($theme['is_active'])) {
            return false;
        }

        $this->themeModel->where('is_active', 1)
            ->update(['is_active' => 0]);

        try {
            $theme = $this->themeModel->where('id', $theme['id'])
                ->firstOrFail();

            $theme->is_active = 1;
            $theme->save();

            $this->fileConfigService->set('theme.active', $theme->slug);
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    /**
     * Restore active thtme.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function restoreActive($id)
    {
        try {
            $theme = $this->themeModel
                ->where('id', $id)
                ->where('is_active', 1)
                ->firstOrFail();

            $this->fileConfigService->set('theme.active', '');
        } catch (ModelNotFoundException $e) {
            return true;
        }
    }

    /**
     * Update updated at field.
     *
     * @param mixed $id
     *
     * @return void
     */
    public function updateUpdatedAt($id)
    {
        try {
            $theme = $this->themeModel
                ->where('id', $id)
                ->firstOrFail();

            $theme->updated_at = now();

            return $theme->save();
        } catch (ModelNotFoundException $e) {
            return true;
        }
    }
}
