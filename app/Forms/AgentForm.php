<?php

namespace App\Forms;

use App\Models\Cadre;
use App\Models\Category;
use App\Models\Classe;
use App\Models\Corp;
use App\Models\Diplome;
use App\Models\EcoleFormation;
use App\Models\EquivalenceDiplome;
use App\Models\Etablissement;
use App\Models\Fonction;
use App\Models\Maladie;
use App\Models\Matrimoniale;
use App\Models\NiveauEtude;
use Kris\LaravelFormBuilder\Form;

class AgentForm extends Form
{
    public function buildForm()
    {
        $this
            //******************************** Agents *****************************
            ->add('matricule','text',[
                'label'=>'Identifiant *', 'rules' => 'required|string'
            ])
            ->add('nom','text', [
                'label'=>'Nom *', 'rules' => 'required|string'
            ])
            ->add('prenom','text', [
                'label'=>'Prénom *', 'rules' => 'required|string'
            ])
            ->add('date_naiss','date', [
                'label'=>'Date de Naissance *', 'rules' => 'required|date',
            ])
            ->add('lieu_naiss','text', [
                'label'=>'Lieu de Naissance *', 'rules' => 'required'
            ])
            ->add('sexe','select', [
                'label'=>'Sexe *', 'rules' => 'required',
                'choices' => ['F' => 'Féminin', 'M' => 'Masculin'],
                'empty_value' => 'Sélectionner'
            ])
            ->add('ref_acte_naiss','text', [
                'label'=>'Référence Acte de Naissance *', 'rules' => 'required'
            ])
            ->add('date_etablissement_acte_naiss','date', [
                'label'=>'Date d\'établissement *', 'rules' => 'required|date',
            ])
            ->add('lieu_etablissement_acte_naiss','text', [
                'label'=>'Lieu d\'établissement *', 'rules' => 'required'
            ])
            ->add('nationnalite','text', [
                'label'=>'Nationnalité *', 'rules' => 'required|string'
            ])
            ->add('type','select', [
                'label'=>'Type d\'Agent *', 'rules' => 'required',
                'choices' => ['Contractuel' => 'Contractuel', 'Titulaire' => 'Titulaire'],
                'empty_value' => 'Sélectionner'
            ])
            ->add('cadre_id','entity', [
                'class' => Cadre::class,
                'label' => 'Cadre *', 'rules' => 'required',
                'query_builder' => function (Cadre $cadre) {
                    return $cadre->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('corp_id','entity', [
                'class' => Corp::class,
                'label' => 'Corps *', 'rules' => 'required',
                'query_builder' => function (Corp $corp) {
                    return $corp->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('fonction_id','entity', [
                'class' => Fonction::class,
                'label' => 'Fonction *',
                'query_builder' => function (Fonction $fonction) {
                    return $fonction->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('date_prise_service','date', [
                'label'=>'Date de Prise de Service *', 'rules' => 'date|nullable',
            ])
            //******************************** Situation Matrimoniale *****************************
            ->add('matrimoniale_id', 'entity', [
                'class' => Matrimoniale::class,
                'label' => 'Situation Matrimoniale *', 'rules' => 'required',
                'query_builder' => function (Matrimoniale $matrimoniale) {
                    return $matrimoniale->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('date','date', [
                'label'=>'A quelle date ? *', 'rules' => 'required|date'
            ])
            //******************************** Situation Administrative or Grades *****************************
            ->add('ref_engagement','text', [
                'label'=>'Reférence de l\'Engagement *', //'rules' => 'required',
            ])
            ->add('date_engagement','date', [
                'label'=>'Date de l\'Engagement *', 'rules' => 'date|nullable',
            ])
            ->add('ref_titularisation','text', [
                'label'=>'Reférence de la Titularisation *', //'rules' => 'required',
            ])
            ->add('date_titularisation','date', [
                'label'=>'Date de Titularisation *', 'rules' => 'date|nullable',
            ])
            ->add('category_id','entity', [
                'class' => Category::class,
                'label' => 'Catégorie *', 'rules' => 'required',
                'query_builder' => function (Category $category) {
                    return $category->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('classe_id','entity', [
                'class' => Classe::class,
                'label' => 'Classe *', //'rules' => 'required',
                'query_builder' => function (Classe $classe) {
                    return $classe->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('echelon_id','select', [
                'label' => 'Echelon *', //'rules' => 'required',
                'empty_value' => 'Sélectionner'
            ])
            ->add('indice','text', [
                'label'=>'Indice', 'attr' => ['disabled' => 'disabled']
            ])
            ->add('salary','text', [
                'label'=>'Salaire', 'attr' => ['disabled' => 'disabled']
            ])
            //******************************** Niveau Etudes *****************************
            ->add('ecole_formation_id','entity', [
                'class' => EcoleFormation::class,
                'label' => 'Dernier Etablissement Fréquenté *', 'rules' => 'required',
                'query_builder' => function (EcoleFormation $ecoleFormation) {
                    return $ecoleFormation->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('niveau_etude_id','entity', [
                'class' => NiveauEtude::class,
                'label' => 'Niveau Etude *', 'rules' => 'required',
                'query_builder' => function (NiveauEtude $niveauEtude) {
                    return $niveauEtude->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('diplome_id','entity', [
                'class' => Diplome::class,
                'label' => 'Diplôme Obtenu *', 'rules' => 'required',
                'query_builder' => function (Diplome $diplome) {
                    return $diplome->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('equivalence_diplome_id','entity', [
                'class' => EquivalenceDiplome::class,
                'label' => 'Equivalence Diplôme *', 'rules' => 'required',
                'query_builder' => function (EquivalenceDiplome $equivalenceDiplome) {
                    return $equivalenceDiplome->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('date_debut','date', [
                'label'=>'Date Début Formation *', 'rules' => 'required|date|before:date_fin',
            ])
            ->add('date_fin','date', [
                'label'=>'Date Fin Formation *', 'rules' => 'required|date|after:date_debut',
            ])
            //******************************** Autres Infos *****************************
            ->add('maladie_id','entity', [
                'class' => Maladie::class,
                'label' => 'Maladie Diagnostiquée Connue',
                'query_builder' => function (Maladie $maladie) {
                    return $maladie->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('date_observation','date', [
                'label'=>'Date Observation',
            ])
            ->add('observation','textarea', [
                'label'=>'Observation', 'rules' => 'max:190', 'attr' => ['rows' => 3, 'placeholder' => 'Limité à 190 caractères !']
            ])
            //******************************** Affectations *****************************
            ->add('etablissement_id','entity', [
                'class' => Etablissement::class,
                'label' => 'Etablissement *', 'rules' => 'required',
                'query_builder' => function (Etablissement $etablissement) {
                    return $etablissement->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('ref','text', [
                'label'=>'Reférence Affectation *', 'rules' => 'required',
            ])
            ->add('date_affectation','date', [
                'label'=>'Date Affectation *', 'rules' => 'date|required',
            ])
            ->add('date_prise_effet','date', [
                'label'=>'Date Effet / Prise de service *', 'rules' => 'date|required',
            ])
            ->add('observation_affectation','textarea', [
                'label'=>'Observation', 'rules' => 'max:190', 'attr' => ['rows' => 3, 'placeholder' => 'Limité à 190 caractères !']
            ])
            //******************************** Enfants *****************************
            //******************************** Conjoints *****************************
        ;
    }
}
