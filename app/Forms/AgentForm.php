<?php

namespace App\Forms;

use App\Models\Category;
use App\Models\Classe;
use App\Models\Diplome;
use App\Models\Echelon;
use App\Models\EcoleFormation;
use App\Models\EquivalenceDiplome;
use App\Models\Maladie;
use App\Models\Matrimoniale;
use App\Models\NiveauEtude;
use Kris\LaravelFormBuilder\Form;

class AgentForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('matricule','text',[
                'label'=>'N° Matricule *', 'rules' => 'required|string'
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
                'label'=>'Lieu de Naissance'
            ])
            ->add('sexe','select', [
                'label'=>'Sexe *', 'rules' => 'required',
                'choices' => ['F' => 'Féminin', 'M' => 'Masculin'],
                'empty_value' => 'Sélectionner'
            ])
            ->add('nationnalite','text', [
                'label'=>'Nationnalité *', 'rules' => 'required|string'
            ])
            ->add('matrimoniale_id', 'entity', [
                'class' => Matrimoniale::class,
                'label' => 'Situation Matrimoniale *', 'rules' => 'required|integer',
                'query_builder' => function (Matrimoniale $matrimoniale) {
                    return $matrimoniale->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('date','date', [
                'label'=>'A quelle date ? *', 'rules' => 'required|date'
            ])
            ->add('type','select', [
                'label'=>'Type d\'Agent *', 'rules' => 'required',
                'choices' => ['Contractuel' => 'Contractuel', 'Titulaire' => 'Titulaire'],
                'empty_value' => 'Sélectionner'
            ])
            ->add('ref_engagement','text', [
                'label'=>'Reférence de l\'Engagement *', //'rules' => 'required',
            ])
            ->add('date_engagement','date', [
                'label'=>'Date de l\'Engagement *', 'rules' => 'date|nullable',
            ])
            ->add('date_titularisation','date', [
                'label'=>'Date de Titularisation *', 'rules' => 'date|nullable',
            ])
            ->add('category_id','entity', [
                'class' => Category::class,
                'label' => 'Catégorie *', 'rules' => 'required|integer',
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
            ->add('echelon_id','entity', [
                'class' => Echelon::class,
                'label' => 'Echelon *', //'rules' => 'required',
                'query_builder' => function (Echelon $echelon) {
                    return $echelon->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('date_prise_service','date', [
                'label'=>'Date de Prise de Service *', 'rules' => 'date|nullable',
            ])
            ->add('ecole_formation_id','entity', [
                'class' => EcoleFormation::class,
                'label' => 'Dernier Etablissement Fréquenté *', 'rules' => 'required|integer',
                'query_builder' => function (EcoleFormation $ecoleFormation) {
                    return $ecoleFormation->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('niveau_etude_id','entity', [
                'class' => NiveauEtude::class,
                'label' => 'Niveau Etude *', 'rules' => 'required|integer',
                'query_builder' => function (NiveauEtude $niveauEtude) {
                    return $niveauEtude->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('diplome_id','entity', [
                'class' => Diplome::class,
                'label' => 'Diplôme Obtenu *', 'rules' => 'required|integer',
                'query_builder' => function (Diplome $diplome) {
                    return $diplome->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('equivalence_diplome_id','entity', [
                'class' => EquivalenceDiplome::class,
                'label' => 'Equivalence Diplôme *', 'rules' => 'required|integer',
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
            ->add('maladie_id','entity', [
                'class' => Maladie::class,
                'label' => 'Maladie Diagnostiquée Connue',
                'query_builder' => function (Maladie $maladie) {
                    return $maladie->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('observation','text', [
                'label'=>'Observation',
            ])
            ->add('date_observation','date', [
                'label'=>'Date Observation',
            ])
        ;
    }
}
