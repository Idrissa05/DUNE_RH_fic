<?php

namespace App\Forms;

use App\Models\Cadre;
use App\Models\CategoryAuxiliaire;
use App\Models\Category;
use App\Models\Classe;
use App\Models\Corp;
use App\Models\Diplome;
use App\Models\Echelon;
use App\Models\EcoleFormation;
use App\Models\EquivalenceDiplome;
use App\Models\Etablissement;
use App\Models\Fonction;
use App\Models\Maladie;
use App\Models\Matrimoniale;
use App\Models\NiveauEtude;
use App\Models\Programme;
use Kris\LaravelFormBuilder\Form;

class AgentForm extends Form
{
    public function buildForm()
    {
        $max = date('Y-m-d', strtotime('-18 years'));
        $this
            //******************************** Agents *****************************
            ->add('matricule','text',[
                'label'=>'Identifiant *', 'rules' => 'required|string|unique:agents'
            ])
            ->add('nom','text', [
                'label'=>'Nom *', 'rules' => 'required|string'
            ])
            ->add('prenom','text', [
                'label'=>'Prénom *', 'rules' => 'required|string'
            ])
            ->add('date_naiss','date', [
                'label'=>'Date de Naissance *', 'rules' => 'required|date','attr' => ['max' => $max, 'min' => null]
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
                'label'=>'Date d\'établissement *', 'rules' => 'required|date|after_or_equal:date_naiss', 'attr' => ['max' => null, 'min' => null]
            ])
            ->add('lieu_etablissement_acte_naiss','text', [
                'label'=>'Lieu d\'établissement *', 'rules' => 'required'
            ])
            ->add('nationnalite','text', [
                'label'=>'Nationnalité *', 'rules' => 'required|string'
            ])
            ->add('type','select', [
                'label'=>'Type d\'Agent *', 'rules' => 'required',
                'choices' => ['Auxiliaire' => 'Auxiliaire','Contractuel' => 'Contractuel','Civicard' => 'Civicard', 'Titulaire' => 'Titulaire'],
                'empty_value' => 'Sélectionner'
            ])
            ->add('date_prise_service','date', [
                'label'=>'Date Prise de Service de l\'Agent *', 'rules' => 'date|after:date_naiss|nullable', 'attr' => ['max' => null, 'min' => null]
            ])
            //******************************** Situation Matrimoniale *****************************
            ->add('matrimoniale_id', 'entity', [
                'class' => Matrimoniale::class,
                'label' => 'Situation Matrimoniale *', 'rules' => 'required',
                'query_builder' => function (Matrimoniale $matrimoniale) {
                    return $matrimoniale->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('date','date', [
                'label'=>'A quelle date ? *', 'rules' => 'required|date|after:date_naiss', 'attr' => ['max' => null, 'min' => null]
            ])
            //******************************** Situation Administrative or Grades *****************************
            ->add('ref_engagement','text', [
                'label'=>'Ref Engagement *', //'rules' => 'required',
            ])
            ->add('date_engagement','date', [
                'label'=>'Date Engagement *', 'rules' => 'date|nullable|after:date_naiss', 'attr' => ['max' => null, 'min' => null]
            ])
            ->add('ref_titularisation','text', [
                'label'=>'Ref Titularisation *', //'rules' => 'required',
            ])
            ->add('date_titularisation','date', [
                'label'=>'Date Titularisation *', 'rules' => 'date|nullable|after:date_naiss', 'attr' => ['max' => null, 'min' => null]
            ])
            ->add('cadre_id','entity', [
                'class' => Cadre::class,
                'label' => 'Cadre *', 'rules' => 'required',
                'query_builder' => function (Cadre $cadre) {
                    return $cadre->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('corp_id','entity', [
                'class' => Corp::class,
                'label' => 'Corps *', 'rules' => 'required',
                'query_builder' => function (Corp $corp) {
                    return $corp->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('fonction_id','entity', [
                'class' => Fonction::class, 'rules' => 'required',
                'label' => 'Fonction *',
                'query_builder' => function (Fonction $fonction) {
                    return $fonction->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('category_auxiliaire_id','entity', [
                'class' => CategoryAuxiliaire::class,
                'label' => 'Catégorie *',
                'query_builder' => function (CategoryAuxiliaire $categoryAuxiliaire) {
                    return $categoryAuxiliaire->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('category_id','entity', [
                'class' => Category::class,
                'label' => 'Catégorie *',
                'query_builder' => function (Category $category) {
                    return $category->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('classe_id','entity', [
                'class' => Classe::class,
                'label' => 'Classe *', //'rules' => 'required',
                'query_builder' => function (Classe $classe) {
                    return $classe->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('echelon_id','entity', [
                'class' => Echelon::class,
                'label' => 'Echelon *', //'rules' => 'required',
                'query_builder' => function (Echelon $echelon) {
                    return $echelon->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('indice','text', [
                'label'=>'Indice', 'attr' => ['disabled' => 'disabled']
            ])
            ->add('salary','text', [
                'label'=>'Salaire', 'attr' => ['disabled' => 'disabled']
            ])
            ->add('indice_id','text', ['attr' => ['hidden' => true, 'id' => 'indice_id']])
            //******************************** Niveau Etudes *****************************
            ->add('ecole_formation_id','entity', [
                'class' => EcoleFormation::class,
                'label' => 'Dernier Etablissement Fréquenté *', 'rules' => 'required',
                'query_builder' => function (EcoleFormation $ecoleFormation) {
                    return $ecoleFormation->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('diplome_id','entity', [
                'class' => Diplome::class,
                'label' => 'Diplôme Obtenu *', 'rules' => 'required',
                'query_builder' => function (Diplome $diplome) {
                    return $diplome->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('niveau_etude_id','entity', [
                'class' => NiveauEtude::class,
                'label' => 'Niveau Etude *', 'rules' => 'required','attr' => ['disabled' => 'disabled'],
                'query_builder' => function (NiveauEtude $niveauEtude) {
                    return $niveauEtude->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('equivalence_diplome_id','entity', [
                'class' => EquivalenceDiplome::class,
                'label' => 'Equivalence Diplôme *', 'rules' => 'required', 'attr' => ['disabled' => 'disabled'],
                'query_builder' => function (EquivalenceDiplome $equivalenceDiplome) {
                    return $equivalenceDiplome->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('date_debut','date', [
                'label'=>'Date Début Formation *', 'rules' => 'required|date|before:date_fin|after:date_naiss',
                'attr' => ['max' => null, 'min' => null]
            ])
            ->add('date_fin','date', [
                'label'=>'Date Fin Formation *', 'rules' => 'required|date|after:date_debut|after:date_naiss', 'attr' => ['max' => null, 'min' => null]
            ])
            //******************************** Autres Infos *****************************
            ->add('maladie_id','entity', [
                'class' => Maladie::class,
                'label' => 'Maladie Diagnostiquée Connue',
                'query_builder' => function (Maladie $maladie) {
                    return $maladie->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('date_observation','date', [
                'label'=>'Date Observation', 'rules' => 'date|nullable|after:date_naiss', 'attr' => ['max' => null, 'min' => null]
            ])
            ->add('observation','textarea', [
                'label'=>'Observation', 'rules' => 'max:190', 'attr' => ['rows' => 3, 'placeholder' => 'Limité à 190 caractères !']
            ])
            //******************************** Affectations *****************************
            ->add('etablissement_id','entity', [
                'class' => Etablissement::class,
                'label' => 'Etablissement *', 'rules' => 'required',
                'query_builder' => function (Etablissement $etablissement) {
                    return $etablissement->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('ref','text', [
                'label'=>'Reférence Affectation *', 'rules' => 'required',
            ])
            ->add('date_affectation','date', [
                'label'=>'Date Affectation *', 'rules' => 'date|required|after:date_naiss|after_or_equal:date_prise_service|after_or_equal:date_engagement',
                'attr' => ['max' => null, 'min' => null]
            ])
            ->add('date_prise_effet','date', [
                'label'=>'Date Effet / Prise de service *', 'rules' => 'date|required|after:date_naiss|after_or_equal:date_affectation',
                'attr' => ['max' => null, 'min' => null]
            ])
            ->add('observation_affectation','textarea', [
                'label'=>'Observation', 'rules' => 'max:190', 'attr' => ['rows' => 3, 'placeholder' => 'Limité à 190 caractères !']
            ])
            ->add('programme_id','entity', [
                'class' => Programme::class,
                'label' => 'Code programme *', 'rules' => 'required',
                'query_builder' => function (Programme $programme) {
                    return $programme->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            //******************************** Enfants *****************************
            //******************************** Conjoints *****************************
        ;
    }
}
