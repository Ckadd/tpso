<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Voyager\CustomVoyagerBaseController as VoyagerBaseController;
use App\Service\ThemeService;
use App\Service\JsonResponseSchema;
use App\Repository\ThemeRepository;
use App\Validator\ThemeValidator;
use Voyager;

class ThemeController extends VoyagerBaseController
{
    protected $themeService;

    protected $jsonResponseSchema;

    protected $themeRepository;

    protected $themeValidator;

    public function __construct(
        ThemeService $themeService,
        JsonResponseSchema $jsonResponseSchema,
        ThemeRepository $themeRepository,
        ThemeValidator $themeValidator
    ) {
        $this->themeService       = $themeService;
        $this->jsonResponseSchema = $jsonResponseSchema;
        $this->themeRepository    = $themeRepository;
        $this->themeValidator     = $themeValidator;
    }

    /**
     * Save theme.
     *
     * @param Request $request
     *
     * @return \TCG\Voyager\Http\Controllers\VoyagerBaseController
     */
    public function store(Request $request)
    {
        if ($this->themeValidator->validateStore($request)) {
            return $this->themeValidator->redirectBack();
        }

        try {
            $themeContent = $this->themeService->uploadTheme($request);
        } catch (\Exception $e) {
            return redirect()->back()->with(
                [
                    'message'    => $e->getMessage(),
                    'alert-type' => 'error',
                ]
            );
        }

        $request->merge([
            'name'    => $themeContent['name'],
            'slug'    => $themeContent['slug'],
            'user_id' => auth()->user()->id,
        ]);

        return parent::store($request);
    }

    /**
     * Update theme.
     *
     * @param Request $request
     * @param mixed   $id
     *
     * @return \TCG\Voyager\Http\Controllers\VoyagerBaseController
     */
    public function update(Request $request, $id)
    {
        $theme            = $request->all();
        $theme['id']      = $id;
        $theme['user_id'] = auth()->user()->id;

        $this->themeRepository->setActive($theme);

        return parent::update($request, $id);
    }

    /**
     * Destroy.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \TCG\Voyager\Http\Controllers\VoyagerBaseController
     */
    public function destroy(Request $request, $id)
    {
        $theme     = $this->themeRepository->findById($id);
        $isDeleted = $this->themeService->deleteTheme($theme['slug']);

        $this->themeRepository->restoreActive($id);

        if (!$isDeleted) {
            return redirect()->back()->with([
                'message'    => __('voyager::generic.delete_fail'),
                'alert-type' => 'error',
            ]);
        }

        return parent::destroy($request, $id);
    }

    /**
     * Read theme fiel.
     *
     * @param string $path
     *
     * @return App\Service\JsonResponseSchema
     */
    public function readThemeFile(string $path)
    {
        if (!Voyager::can('edit_themes')) {
            return $this->jsonResponseSchema->status('unauthorized')
                ->message('cannot_edit_theme')
                ->send();
        }

        $fileContent = $this->themeService->readFileFromTheme($path);

        if (!$fileContent) {
            return $this->jsonResponseSchema->status('internal_error')
                ->message('file_not_found')
                ->send();
        }

        return $this->jsonResponseSchema->status('ok')
            ->message('read_content_success')
            ->data(['content' => $fileContent])
            ->send();
    }

    /**
     * Update theme file.
     *
     * @param Request $request
     *
     * @return App\Service\JsonResponseSchema
     */
    public function updateThemeFile(Request $request)
    {
        if (!Voyager::can('edit_themes')) {
            return $this->jsonResponseSchema->status('unauthorized')
                ->message('cannot_edit_theme')
                ->send();
        }

        $request = array_only($request->all(), ['id', 'path', 'content']);

        $updateThemeFile = $this->themeService->writeToThemeFile($request['path'], $request['content']);

        if (empty($updateThemeFile)) {
            return $this->jsonResponseSchema->status('internal_error')
                ->message('file_not_found')
                ->send();
        }

        $this->themeRepository->updateUpdatedAt($request['id']);

        return $this->jsonResponseSchema->status('ok')
            ->message('update_file_success')
            ->send();
    }
}
