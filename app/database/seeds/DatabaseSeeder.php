<?php

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('PostsSeeder');
        $this->call('CommentsSeeder');
    	$this->call('TweetsTableSeeder');
		$this->call('EventsTableSeeder');
		$this->call('OdoosTableSeeder');
		$this->call('IdeasTableSeeder');
		$this->call('CategoriesTableSeeder');
		$this->call('SectorsTableSeeder');
		$this->call('Workflow_categoriesTableSeeder');
		$this->call('Workflow_stepsTableSeeder');
		$this->call('Workflow_step_activitiesTableSeeder');
		$this->call('Idea_stepsTableSeeder');
		$this->call('Idea_step_activitiesTableSeeder');
		$this->call('Activity_formsTableSeeder');
		$this->call('Idea_step_historiesTableSeeder');
		$this->call('Idea_step_activity_historiesTableSeeder');
		$this->call('Idea_capitalizationsTableSeeder');
		$this->call('Form_lookupsTableSeeder');
		$this->call('Form_lookup_dataTableSeeder');
		$this->call('Idea_step_activity_attachmentsTableSeeder');
		$this->call('Form_concept_papersTableSeeder');
		$this->call('Form_concept_paper_featuresTableSeeder');
		$this->call('Form_budgetsTableSeeder');
		$this->call('Form_fundsTableSeeder');
		$this->call('Form_scoresTableSeeder');
		$this->call('Form_timesTableSeeder');
		$this->call('Form_idea_approvalsTableSeeder');
		$this->call('Form_activitiesTableSeeder');
		$this->call('Sif_roundsTableSeeder');
		$this->call('NewsTableSeeder');
		$this->call('MediaTableSeeder');
		$this->call('AnnouncementsTableSeeder');
		$this->call('Form_richtextsTableSeeder');
		$this->call('Form_evaluationsTableSeeder');
		$this->call('Form_visitsTableSeeder');
		$this->call('Form_payment_disbursmentsTableSeeder');
		$this->call('Form_stack_holdersTableSeeder');
		$this->call('Form_payment_schedulesTableSeeder');
		$this->call('Form_deliverablesTableSeeder');
		$this->call('Form_sp_panelsTableSeeder');
		$this->call('Form_fund_itemsTableSeeder');
		$this->call('Form_score_itemsTableSeeder');
		$this->call('Form_time_itemsTableSeeder');
		$this->call('Form_evaluation_itemsTableSeeder');
		$this->call('Form_visit_itemsTableSeeder');
		$this->call('Form_payment_disbursment_itemsTableSeeder');
		$this->call('Form_stack_holder_itemsTableSeeder');
		$this->call('Form_payment_schedule_itemsTableSeeder');
		$this->call('Form_deliverable_itemsTableSeeder');
		$this->call('Form_sp_panel_itemsTableSeeder');
		$this->call('AdvertisementsTableSeeder');
	}

}
