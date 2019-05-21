<?php

namespace App\Forms;

use App\Models\Category;
use App\Models\Classe;
use App\Models\Echelon;
use Kris\LaravelFormBuilder\Form;

class IndiceForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Libellé'
        ])->add('value', 'number')
            ->add('salary', 'number')
            ->add('category_id', 'entity', [
                'label' => 'Catégorie',
                'rules' => 'required|integer',
                'class' => Category::class,
                'query_builder' => function (Category $category) {
                    return $category->pluck('name', 'id');
                }
            ])
            ->add('echelon_id', 'entity', [
                'label' => 'Echelon',
                'rules' => 'required|integer',
                'class' => Echelon::class,
                'query_builder' => function (Echelon $echelon) {
                    return $echelon->pluck('name', 'id');
                }
            ])
            ->add('classe_id', 'entity', [
                'label' => 'classe',
                'rules' => 'required|integer',
                'class' => Classe::class,
                'query_builder' => function (Classe $classe) {
                    return $classe->pluck('name', 'id');
                }
            ]);
    }
}
