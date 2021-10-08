<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateReportsViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
          CREATE VIEW reports AS(
            SELECT  agents.id,
                    agents.matricule,
                    agents.nom,
                    agents.prenom,
                    agents.date_naiss,
                    agents.lieu_naiss,
                    agents.ref_acte_naiss,
                    agents.date_etablissement_acte_naiss,
                    agents.lieu_etablissement_acte_naiss,
                    agents.sexe,
                    agents.nationnalite,
                    agents.type AS agents_type,
                    agents.date_prise_service,
                    grades.type AS grades_type,
                    grades.ref_avancement,
                    grades.date_decision_avancement,
                    grades.observation_avancement,
                    grades.ref_reclassement,
                    grades.date_reclassement,
                    grades.ref_titularisation,
                    grades.date_titularisation,
                    grades.ref_engagement,
                    grades.date_engagement,
                    fonctions.name AS fonction,
                    corps.name AS corps,
                    cadres.name AS cadre,
                    category_auxiliaires.name AS category_auxiliaire,
                    categories.name AS category,
                    classes.name AS classe,
                    echelons.name AS echelon,
                    indices.value AS indice,
                    indices.salary,
                    maladies.name AS maladie,
                    agent_maladie.observation AS observation_maladie,
                    agent_maladie.date_observation AS date_observation_maladie,
                    matrimoniales.name AS matrimoniale,
                    agent_matrimoniale.date AS date_matrimoiale,
                    agent_migrations.matricule AS old_matricule,
                    agent_migrations.type AS old_agents_type,
                    positions.name AS \"position\",
                    agent_position.date_effet AS date_effet_position,
                    agent_position.ref_decision AS ref_decision_position,
                    agent_position.date_decision AS date_decision_position,
                    agent_position.date_fin AS date_fin_position,
                    agent_position.observation AS observation_position,
                    affectations.ref AS ref_affectation,
                    affectations.date AS date_affectation,
                    affectations.date_prise_effet AS date_prise_effet_affectation,
                    affectations.observation AS observation_affectation,
                    etablissements.name AS etablissement,
                    type_etablissements.name AS type_etablissement,
                    secteur_pedagogiques.name AS secteur_pedagogique,
                    inspections.name AS inpection,
                    communes.name AS commune,
                    departements.name AS departement,
                    regions.id AS region_id,
                    regions.name AS region,
                    ministeres.id AS ministere_id,
                    ministeres.abreviation AS ministere,
                    conges.ref_decision AS ref_decision_conge,
                    conges.date_debut AS date_debut_conge,
                    conges.date_fin AS date_fin_conge,
                    conges.observation AS observation_conge,
                    conjoints.matricule AS matricule_conjoint,
                    conjoints.nom AS nom_conjoint,
                    conjoints.prenom AS prenom_conjoint,
                    conjoints.date_naiss AS date_naiss_conjoint,
                    conjoints.lieu_naiss AS lieu_naiss_conjoint,
                    conjoints.ref_acte_naiss AS ref_acte_naiss_conjoint,
                    conjoints.sexe AS sexe_conjoint,
                    conjoints.nationnalite AS nationnalite_conjoint,
                    conjoints.tel AS tel_conjoint,
                    conjoints.employeur AS employeur_conjoint,
                    conjoints.profession AS profession_conjoint,
                    conjoints.ref_acte_mariage,
                    conjoints.date_mariage,
                    deces.date AS date_deces,
                    deces.ref_document AS ref_document_deces,
                    deces.observation AS observation_deces,
                    formations.date_debut AS date_debut_formation,
                    formations.date_fin AS date_fin_formation,
                    ecole_formations.name AS ecole_formation,
                    diplomes.name AS diplome,
                    niveau_etudes.name AS niveau_etude,
                    equivalence_diplomes.name AS equivalence_diplome,
                    enfants.prenom AS prenom_enfant,
                    enfants.date_naiss AS date_naiss_enfant,
                    enfants.lieu_naiss AS lieu_naiss_enfant,
                    enfants.ref_acte_naiss AS ref_acte_naiss_enfant,
                    enfants.sexe AS sexe_enfant,
                    experiences.organisation AS organisation_experience,
                    experiences.date_debut AS date_debut_experience,
                    experiences.date_fin AS date_fin_experience,
                    experiences.fonction AS fonction_experience,
                    experiences.tache AS tache_experience,
                    experiences.observation AS observation_experience,
                    notations.date_debut AS date_debut_notation,
                    notations.date_fin AS date_fin_notation,
                    notations.note_adminitratif,
                    notations.note_pedagogique,
                    notations.responsable AS responsable_notation,
                    notations.observation AS observation_notation,
                    retraites.date AS date_retraite,
                    retraites.ref_decision AS ref_decision_retraite,
                    retraites.date_decision AS date_decision_retraite,
                    retraites.lieu AS lieu_retraite,
                    retraites.contact AS contact_retraite,
                    retraites.observation AS observation_retraite
            FROM    retraites
                     RIGHT JOIN (agent_matrimoniale
                     JOIN (agents
                     JOIN grades ON agents.id = grades.agent_id
                     JOIN fonctions ON grades.fonction_id = fonctions.id
                     JOIN corps ON grades.corp_id = corps.id
                     JOIN cadres ON grades.cadre_id = cadres.id
                     JOIN regions ON agents.created_by_region_id = regions.id
                     JOIN ministeres ON agents.created_by_ministere_id = ministeres.id) ON agent_matrimoniale.agent_id = agents.id
                     JOIN matrimoniales ON agent_matrimoniale.matrimoniale_id = matrimoniales.id
                     JOIN agent_position ON agents.id = agent_position.agent_id
                     JOIN positions ON agent_position.position_id = positions.id) ON retraites.agent_id = agents.id
                     LEFT JOIN notations ON agents.id = notations.agent_id
                     LEFT JOIN experiences ON agents.id = experiences.agent_id
                     LEFT JOIN enfants ON agents.id = enfants.agent_id
                     LEFT JOIN (formations
                     JOIN ecole_formations ON formations.ecole_formation_id = ecole_formations.id
                     JOIN diplomes ON formations.diplome_id = diplomes.id
                     JOIN niveau_etudes ON formations.niveau_etude_id = niveau_etudes.id
                     JOIN equivalence_diplomes ON formations.equivalence_diplome_id = equivalence_diplomes.id) ON agents.id = formations.agent_id
                     LEFT JOIN deces ON agents.id = deces.agent_id
                     LEFT JOIN conjoints ON agents.id = conjoints.agent_id
                     LEFT JOIN conges ON agents.id = conges.agent_id
                     LEFT JOIN (etablissements
                     JOIN affectations ON etablissements.id = affectations.etablissement_id
                     JOIN secteur_pedagogiques ON etablissements.secteur_pedagogique_id = secteur_pedagogiques.id
                     JOIN type_etablissements ON etablissements.type_etablissement_id = type_etablissements.id
                     JOIN inspections ON secteur_pedagogiques.inspection_id = inspections.id
                     JOIN communes ON inspections.commune_id = communes.id
                     JOIN departements ON communes.departement_id = departements.id) ON regions.id = departements.region_id AND agents.id = affectations.agent_id
                     LEFT JOIN agent_migrations ON agents.id = agent_migrations.agent_id AND grades.id = agent_migrations.grade_id
                     LEFT JOIN (maladies
                     JOIN agent_maladie ON maladies.id = agent_maladie.maladie_id) ON agents.id = agent_maladie.agent_id
                     LEFT JOIN indices ON grades.indice_id = indices.id
                     LEFT JOIN categories ON grades.category_id = categories.id
                     LEFT JOIN classes ON grades.classe_id = classes.id
                     LEFT JOIN echelons ON grades.echelon_id = echelons.id
                     LEFT JOIN category_auxiliaires ON grades.category_auxiliaire_id = category_auxiliaires.id
          )"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS reports');
    }

}
