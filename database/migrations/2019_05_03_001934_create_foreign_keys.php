<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('affectations', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('affectations', function(Blueprint $table) {
			$table->foreign('etablissement_id')->references('id')->on('etablissements')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('etablissements', function(Blueprint $table) {
			$table->foreign('inspection_id')->references('id')->on('inspections')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('etablissements', function(Blueprint $table) {
			$table->foreign('localite_id')->references('id')->on('localites')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('etablissements', function(Blueprint $table) {
			$table->foreign('type_etablissement_id')->references('id')->on('type_etablissements')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('classes', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('echelons', function(Blueprint $table) {
			$table->foreign('classe_id')->references('id')->on('classes')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('conges', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('conjoints', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('deces', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('enfants', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('departements', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('inspections', function(Blueprint $table) {
			$table->foreign('departement_id')->references('id')->on('departements')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('experiences', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('ecole_formation_id')->references('id')->on('ecole_formations')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('diplome_id')->references('id')->on('diplomes')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('niveau_etude_id')->references('id')->on('niveau_etudes')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('equivalence_diplome_id')->references('id')->on('equivalence_diplomes')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('notations', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('reclassements', function(Blueprint $table) {
			$table->foreign('angent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('retraites', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('agent_matrimoniales', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('agent_matrimoniales', function(Blueprint $table) {
			$table->foreign('matrimoniale_id')->references('id')->on('matrimoniales')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('agent_maladies', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('agent_maladies', function(Blueprint $table) {
			$table->foreign('maladie_id')->references('id')->on('maladies')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('agent_echelons', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('agent_echelons', function(Blueprint $table) {
			$table->foreign('echelon_id')->references('id')->on('echelons')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('affectations', function(Blueprint $table) {
			$table->dropForeign('affectations_agent_id_foreign');
		});
		Schema::table('affectations', function(Blueprint $table) {
			$table->dropForeign('affectations_etablissement_id_foreign');
		});
		Schema::table('etablissements', function(Blueprint $table) {
			$table->dropForeign('etablissements_inspection_id_foreign');
		});
		Schema::table('etablissements', function(Blueprint $table) {
			$table->dropForeign('etablissements_localite_id_foreign');
		});
		Schema::table('etablissements', function(Blueprint $table) {
			$table->dropForeign('etablissements_type_etablissement_id_foreign');
		});
		Schema::table('classes', function(Blueprint $table) {
			$table->dropForeign('classes_category_id_foreign');
		});
		Schema::table('echelons', function(Blueprint $table) {
			$table->dropForeign('echelons_classe_id_foreign');
		});
		Schema::table('conges', function(Blueprint $table) {
			$table->dropForeign('conges_agent_id_foreign');
		});
		Schema::table('conjoints', function(Blueprint $table) {
			$table->dropForeign('conjoints_agent_id_foreign');
		});
		Schema::table('deces', function(Blueprint $table) {
			$table->dropForeign('deces_agent_id_foreign');
		});
		Schema::table('enfants', function(Blueprint $table) {
			$table->dropForeign('enfants_agent_id_foreign');
		});
		Schema::table('departements', function(Blueprint $table) {
			$table->dropForeign('departements_region_id_foreign');
		});
		Schema::table('inspections', function(Blueprint $table) {
			$table->dropForeign('inspections_departement_id_foreign');
		});
		Schema::table('experiences', function(Blueprint $table) {
			$table->dropForeign('experiences_agent_id_foreign');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->dropForeign('formations_agent_id_foreign');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->dropForeign('formations_ecole_formation_id_foreign');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->dropForeign('formations_diplome_id_foreign');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->dropForeign('formations_niveau_etude_id_foreign');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->dropForeign('formations_equivalence_diplome_id_foreign');
		});
		Schema::table('notations', function(Blueprint $table) {
			$table->dropForeign('notations_agent_id_foreign');
		});
		Schema::table('reclassements', function(Blueprint $table) {
			$table->dropForeign('reclassements_angent_id_foreign');
		});
		Schema::table('retraites', function(Blueprint $table) {
			$table->dropForeign('retraites_agent_id_foreign');
		});
		Schema::table('agent_matrimoniales', function(Blueprint $table) {
			$table->dropForeign('agent_matrimoniales_agent_id_foreign');
		});
		Schema::table('agent_matrimoniales', function(Blueprint $table) {
			$table->dropForeign('agent_matrimoniales_matrimoniale_id_foreign');
		});
		Schema::table('agent_maladies', function(Blueprint $table) {
			$table->dropForeign('agent_maladies_agent_id_foreign');
		});
		Schema::table('agent_maladies', function(Blueprint $table) {
			$table->dropForeign('agent_maladies_maladie_id_foreign');
		});
		Schema::table('agent_echelons', function(Blueprint $table) {
			$table->dropForeign('agent_echelons_agent_id_foreign');
		});
		Schema::table('agent_echelons', function(Blueprint $table) {
			$table->dropForeign('agent_echelons_echelon_id_foreign');
		});
	}
}