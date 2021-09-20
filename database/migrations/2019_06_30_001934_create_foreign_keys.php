<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('affectations', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('affectations', function(Blueprint $table) {
			$table->foreign('etablissement_id')->references('id')->on('etablissements')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('etablissements', function(Blueprint $table) {
			$table->foreign('secteur_pedagogique_id')->references('id')->on('secteur_pedagogiques')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('etablissements', function(Blueprint $table) {
			$table->foreign('type_etablissement_id')->references('id')->on('type_etablissements')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('echelons', function(Blueprint $table) {
			$table->foreign('classe_id')->references('id')->on('classes')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('conges', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('conjoints', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('deces', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('enfants', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('departements', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('inspections', function(Blueprint $table) {
			$table->foreign('commune_id')->references('id')->on('communes')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('experiences', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('ecole_formation_id')->references('id')->on('ecole_formations')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('diplome_id')->references('id')->on('diplomes')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('niveau_etude_id')->references('id')->on('niveau_etudes')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('equivalence_diplome_id')->references('id')->on('equivalence_diplomes')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('notations', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('retraites', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('agent_matrimoniale', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('agent_matrimoniale', function(Blueprint $table) {
			$table->foreign('matrimoniale_id')->references('id')->on('matrimoniales')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('agent_maladie', function(Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('agents')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
		Schema::table('agent_maladie', function(Blueprint $table) {
			$table->foreign('maladie_id')->references('id')->on('maladies')
						->onDelete('NO ACTION')
						->onUpdate('NO ACTION');
		});
        Schema::table('corps', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('indices', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('indices', function(Blueprint $table) {
            $table->foreign('classe_id')->references('id')->on('classes')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('indices', function(Blueprint $table) {
            $table->foreign('echelon_id')->references('id')->on('echelons')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('agent_position', function(Blueprint $table) {
            $table->foreign('agent_id')->references('id')->on('agents')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('agent_position', function(Blueprint $table) {
            $table->foreign('position_id')->references('id')->on('positions')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('agents', function(Blueprint $table) {
            $table->foreign('created_by_region_id')->references('id')->on('regions')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('agents', function(Blueprint $table) {
            $table->foreign('created_by_ministere_id')->references('id')->on('ministeres')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->foreign('agent_id')->references('id')->on('agents')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->foreign('category_auxiliaire_id')->references('id')->on('category_auxiliaires')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->foreign('classe_id')->references('id')->on('classes')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->foreign('echelon_id')->references('id')->on('echelons')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->foreign('cadre_id')->references('id')->on('cadres')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->foreign('corp_id')->references('id')->on('corps')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->foreign('fonction_id')->references('id')->on('fonctions')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
		Schema::table('grades', function(Blueprint $table) {
            $table->foreign('programme_id')->references('id')->on('programmes')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->foreign('indice_id')->references('id')->on('indices')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('communes', function(Blueprint $table) {
            $table->foreign('departement_id')->references('id')->on('departements')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('secteur_pedagogiques', function(Blueprint $table) {
            $table->foreign('inspection_id')->references('id')->on('inspections')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('agent_migrations', function(Blueprint $table) {
            $table->foreign('agent_id')->references('id')->on('agents')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('agent_migrations', function(Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('regions')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('ministere_id')->references('id')->on('ministeres')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
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
			$table->dropForeign('etablissements_secteur_pedagogique_id_foreign');
		});
		Schema::table('etablissements', function(Blueprint $table) {
			$table->dropForeign('etablissements_type_etablissement_id_foreign');
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
			$table->dropForeign('inspections_commune_id_foreign');
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
		Schema::table('retraites', function(Blueprint $table) {
			$table->dropForeign('retraites_agent_id_foreign');
		});
		Schema::table('agent_matrimoniale', function(Blueprint $table) {
			$table->dropForeign('agent_matrimoniale_agent_id_foreign');
		});
		Schema::table('agent_matrimoniale', function(Blueprint $table) {
			$table->dropForeign('agent_matrimoniale_matrimoniale_id_foreign');
		});
		Schema::table('agent_maladie', function(Blueprint $table) {
			$table->dropForeign('agent_maladie_agent_id_foreign');
		});
		Schema::table('agent_maladie', function(Blueprint $table) {
			$table->dropForeign('agent_maladie_maladie_id_foreign');
		});
        Schema::table('corps', function(Blueprint $table) {
            $table->dropForeign('corps_category_id_foreign');
        });
        Schema::table('indices', function(Blueprint $table) {
            $table->dropForeign('indices_category_id_foreign');
        });
        Schema::table('indices', function(Blueprint $table) {
            $table->dropForeign('indices_classe_id_foreign');
        });
        Schema::table('indices', function(Blueprint $table) {
            $table->dropForeign('indices_echelon_id_foreign');
        });
        Schema::table('agent_position', function(Blueprint $table) {
            $table->dropForeign('agent_position_agent_id_foreign');
        });
        Schema::table('agent_position', function(Blueprint $table) {
            $table->dropForeign('agent_position_position_id_foreign');
        });
        Schema::table('agents', function(Blueprint $table) {
            $table->dropForeign('agents_created_by_region_id_foreign');
        });
        Schema::table('agents', function(Blueprint $table) {
            $table->dropForeign('agents_created_by_ministere_id_foreign');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->dropForeign('grades_agent_id_foreign');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->dropForeign('grades_category_id_foreign');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->dropForeign('grades_category_auxiliaire_id_foreign');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->dropForeign('grades_classe_id_foreign');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->dropForeign('grades_echelon_id_foreign');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->dropForeign('grades_cadre_id_foreign');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->dropForeign('grades_corp_id_foreign');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->dropForeign('grades_fonction_id_foreign');
        });
        Schema::table('grades', function(Blueprint $table) {
            $table->dropForeign('grades_indice_id_foreign');
        });
        Schema::table('communes', function(Blueprint $table) {
            $table->dropForeign('communes_departement_id_foreign');
        });
        Schema::table('secteur_pedagogiques', function(Blueprint $table) {
            $table->dropForeign('secteur_pedagogiques_inspection_id_foreign');
        });
        Schema::table('agent_migrations', function(Blueprint $table) {
            $table->dropForeign('agent_migrations_agent_id_foreign');
        });
        Schema::table('agent_migrations', function(Blueprint $table) {
            $table->dropForeign('agent_migrations_grade_id_foreign');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_region_id_foreign');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_ministere_id_foreign');
        });
	}
}
