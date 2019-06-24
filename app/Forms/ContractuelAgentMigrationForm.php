<?php

namespace App\Forms;

use App\Models\Cadre;
use App\Models\Category;
use App\Models\Classe;
use App\Models\Contractuel;
use App\Models\Corp;
use App\Models\Echelon;
use App\Models\Fonction;
use Kris\LaravelFormBuilder\Form;

class ContractuelAgentMigrationForm extends Form
{
    public function buildForm()
    {
        $this
            //******************************** Agents *****************************
            ->add('agent_id','entity', [
                'class' => Contractuel::class,
                'label' => 'Code Agent *', 'rules' => 'required',
                'query_builder' => function (Contractuel $contractuel) {
                    return $contractuel->orderBy('matricule', 'asc')->pluck('matricule','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('matricule','text', [
                'label'=>'Matricule *', 'rules' => 'required|string|unique:agents'
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
            ->add('dt_agent_test','text', ['attr' => ['hidden' => true, 'id' => 'dt_agent_test']])
            //******************************** Situation Administrative or Grades *****************************
            ->add('ref_engagement','text', [
                'label'=>'Ref Engagement *', 'rules' => 'required',
            ])
            ->add('date_engagement','date', [
                'label'=>'Date Engagement *', 'rules' => 'date|required|after:dt_agent_test','attr' => ['max' => null, 'min' => null]
            ])
            ->add('ref_titularisation','text', [
                'label'=>'Ref Titularisation *', 'rules' => 'required',
            ])
            ->add('date_titularisation','date', [
                'label'=>'Date Titularisation *', 'rules' => 'date|required|after:dt_agent_test', 'attr' => ['max' => null, 'min' => null]
            ])
            ->add('category_id','entity', [
                'class' => Category::class,
                'label' => 'Catégorie *', 'rules' => 'required',
                'query_builder' => function (Category $category) {
                    return $category->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('classe_id','entity', [
                'class' => Classe::class,
                'label' => 'Classe *', 'rules' => 'required',
                'query_builder' => function (Classe $classe) {
                    return $classe->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('echelon_id','entity', [
                'class' => Echelon::class,
                'label' => 'Echelon *', 'rules' => 'required',
                'query_builder' => function (Echelon $echelon) {
                    return $echelon->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            // Others
            ->add('indice','text', ['label'=>'Indice', 'attr' => ['disabled' => 'disabled']])
            ->add('salary','text', ['label'=>'Salaire', 'attr' => ['disabled' => 'disabled']])
            ->add('indice_id','text', ['attr' => ['hidden' => true, 'id' => 'indice_id']])
            ->add('fullName','text', ['label'=>'Nom & Prénom', 'attr' => ['readonly' => true, 'disabled' => true]])
            ->add('type','text', ['value' => 'Titulaire' ,'attr' => ['hidden' => true, 'id' => 'type']])
            // Save
            ->add('cadre','text', ['attr' => ['hidden' => true, 'id' => 'cadre']])
            ->add('corps','text', ['attr' => ['hidden' => true, 'id' => 'corps']])
            ->add('fonction','text', ['attr' => ['hidden' => true, 'id' => 'fonction']])
            ->add('last_type','text', ['attr' => ['hidden' => true, 'id' => 'last_type']])
            ->add('code','text', ['attr' => ['hidden' => true, 'id' => 'code']])
        ;
    }
}
