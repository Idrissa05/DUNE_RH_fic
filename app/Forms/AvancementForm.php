<?php

namespace App\Forms;

use App\Models\Category;
use App\Models\Classe;
use App\Models\Echelon;
use App\Models\Titulaire;
use Kris\LaravelFormBuilder\Form;

class AvancementForm extends Form
{
    public function buildForm()
    {
            $this->add('agent_id','entity', [
                    'class' => Titulaire::class,
                    'label' => 'Matricule Agent *', 'rules' => 'required',
                    'query_builder' => function (Titulaire $titulaire) {
                        return $titulaire->pluck('matricule','id');
                    },
                    'empty_value' => 'Sélectionner'
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
                    'label' => 'Classe *', 'rules' => 'required',
                    'query_builder' => function (Classe $classe) {
                        return $classe->pluck('name','id');
                    },
                    'empty_value' => 'Sélectionner'
                ])
                ->add('echelon_id','entity', [
                    'class' => Echelon::class,
                    'label' => 'Echelon *', 'rules' => 'required',
                    'query_builder' => function (Echelon $echelon) {
                        return $echelon->pluck('name','id');
                    },
                    'empty_value' => 'Sélectionner'
                ])
                ->add('ref_avancement', 'text', [
                    'label' => 'Ref Avancemenet *',
                    'rules' => 'required'
                ])
                ->add('date_decision_avancement', 'date', [
                    'label' => 'Date Décision Avancement *',
                    'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null]
                ])
                ->add('observation_avancement','textarea', [
                    'label'=>'Observation', 'rules' => 'max:190', 'attr' => ['rows' => 3, 'placeholder' => 'Limité à 190 caractères !']
                ])
                ->add('indice_id','text', ['attr' => ['hidden' => true, 'id' => 'indice_id']])
            ;
    }
}
