<?php

namespace App\Forms;

use App\Models\Cadre;
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
use Kris\LaravelFormBuilder\Form;

class AgentEditForm extends Form
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
            //******************************** Situation Administrative or Grades *****************************
            ->add('ref_engagement','text', [
                'label'=>'Ref Engagement *', //'rules' => 'required',
            ])
            ->add('date_engagement','date', [
                'label'=>'Date Engagement *', 'rules' => 'date|nullable',
            ])
            ->add('ref_titularisation','text', [
                'label'=>'Ref Titularisation *', //'rules' => 'required',
            ])
            ->add('date_titularisation','date', [
                'label'=>'Date Titularisation *', 'rules' => 'date|nullable',
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
            ->add('echelon_id','entity', [
                'class' => Echelon::class,
                'label' => 'Echelon *', //'rules' => 'required',
                'query_builder' => function (Echelon $echelon) {
                    return $echelon->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('indice','text', [
                'label'=>'Indice', 'attr' => ['disabled' => 'disabled']
            ])
            ->add('salary','text', [
                'label'=>'Salaire', 'attr' => ['disabled' => 'disabled']
            ])
        ;
    }
}
