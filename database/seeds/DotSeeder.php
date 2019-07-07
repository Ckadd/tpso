<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class DotSeeder extends Seeder
{
    use Seedable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('InstallOrganizationTableSeeder');
        $this->seed('InstallThemeTableSeeder');
        $this->seed('MainMenuTableSeeder');
        $this->seed('MenuSubItemTableSeeder');
        $this->seed('InstallContensharingTableSeeder');
        $this->seed('InstallContensharingViewTableSeeder');
        $this->seed('MockupUsersTableSeeder');
        $this->seed('InstallFaqCategoriesTableSeeder');
        $this->seed('InstallFaqsTableSeeder');
        $this->seed('InstallFaqViewTableSeeder');
        $this->seed('InstallKnowledgebaseTableSeeder');
        $this->seed('InstallKnowledgebaseViewTableSeeder');
        $this->seed('InstallCalendarCagegoryTableSeeder');
        $this->seed('InstallCalendarDetailTableSeeder');
        $this->seed('InstallArticleTableSeeder');
        $this->seed('InstallArticleViewTableSeeder');
        $this->seed('InstallBannerTableSeeder');
        $this->seed('InstallOrganizationChartTableSeeder');
        $this->seed('InstallLibrariesTableSeeder');
        $this->seed('InstallLibraryViewTableSeeder');
        $this->seed('InstallAnnualbudgetTableSeeder');
        $this->seed('InstallAnnualBudgetCategoryTableSeeder');
        $this->seed('InstallAnnualbudgetViewTableSeeder');
        $this->seed('InstallMissionStatmentTableSeeder');
        $this->seed('InstallMissionStatementViewTableSeeder');
        $this->seed('InstallOrganizationalStructureTableSeeder');
        $this->seed('InstallLawRegulationCategoriesTableSeeder');
        $this->seed('InstallLawRegulationTableSeeder');
        $this->seed('InstallLawRegulationViewTableSeeder');
        $this->seed('InstallStategicTableSeeder');
        $this->seed('InstallMisstionAuthorityTableSeeder');
        $this->seed('InstallMisstionAuthorityViewTableSeeder');
        $this->seed('InstallStandardTourismPersonnelTableSeeder');
        $this->seed('InstallFormDownloadTableSeeder');
        $this->seed('InstallFormDownloadViewTableSeeder');
        $this->seed('InstallJobPostingTableSeeder');
        $this->seed('InstallJobPostingViewsTableSeeder');
        $this->seed('InstallChartStatisticTableSeeder');
        $this->seed('InstallFormGenerateTableSeeder');
        $this->seed('InstallFormGenerateDetailTableSeeder');
        $this->seed('InstallNewsletterSubScribeTableSeeder');
        $this->seed('InstallNewletterCategoryTableSeeder');
        $this->seed('InstallNewletterTemplateTableSeeder');
        $this->seed('InstallNewletterSubscribeDetailTableSeeder');
        $this->seed('InstallGalleryCategoryTableSeeder');
        $this->seed('InstallGalleryTableSeeder');
        $this->seed('InstallGalleryItemTableSeeder');
        $this->seed('InstallLandmarkStandardTableSeeder');
        $this->seed('InstallLandmarkStandardViewTableSeeder');
        $this->seed('InstallLibraryBookSeeder');
        $this->seed('InstallLibraryBookViewSeeder');
        $this->seed('InstallPublicGuideTableSeeder');
        $this->seed('InstallPublicGuideViewTableSeeder');
        $this->seed('InstallTourStandardTableSeeder');
        $this->seed('InstallTourStandardViewTableSeeder');
        $this->seed('InstallTravelTipTableSeeder');
        $this->seed('InstallTravelTipViewTableSeeder');
        $this->seed('InstallEbookCategoryTableSeeder');
        $this->seed('InstallEbooksTableSeeder');
        $this->seed('InstallDefaultTheme');
        $this->seed('InstallNewsTableSeeder');
        $this->seed('InstallNewsCategoryTableSeeder');
        $this->seed('InstallNewViewsTableSeeder');
        $this->seed('InstallDepartmentTableSeeder');
        $this->seed('CreateLanguages');
        $this->seed('InstallDepartmentTableSeeder');
        $this->seed('InstallLangAdminMenuItemTableSeeder');
        $this->seed('InstallPollReportAdminMenuItemTableSeeder');
        $this->seed('InstallChartTypeTableSeeder');
        $this->seed('InstallChartListTableSeeder');
        $this->seed('InstallChartDataTableSeeder');
        $this->seed('InstallAuditLogTableSeeder');
        $this->seed('InstallPagesOraganizationTableSeeder');
        $this->seed('InstallPagesTableSeeder');
        $this->seed('InstallDepartmentMenuTableSeeder');
        $this->seed('InstallServiceTableSeeder');
        $this->seed('InstallContactViewTableSeeder');
        $this->seed('InstallVisitorLogsTableSeeder');
        $this->seed('InstallFormDownloadCategoryTableSeeder');
        $this->seed('InstallCategoryLibraryBookTableSeeder');
        $this->seed('InstallCustomPermissionTableSeeder');
        $this->seed('InstallFeedTableSeeder');
        $this->seed('InstallBannerViewSeederTable');
        $this->seed('InstallMappingNewsletterTableSeeder');
        $this->seed('CreateIntranetToOrganizationTableSeeder');
        $this->seed('CreateNameNewsCategoryIntranetTableSeeder');
        $this->seed('InstallDotStatGroupTableSeeder');
        $this->seed('InstallDotStatCategoryTableSeeder');
        $this->seed('InstallDotStatDataTableSeeder');
    }
}
