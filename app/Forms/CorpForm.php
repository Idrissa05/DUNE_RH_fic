<?php

namespace App\Forms;

use App\Models\Category;
use Kris\LaravelFormBuilder\Form;

class CorpForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Libellé',
            'rules' => 'required'
        ])
            ->add('abreviation', 'text', [
                'label' => 'Abréviation',
                'rules' => 'required|max:15'

            ])
            ->add('category_id', 'entity', [
                'label' => 'Catégorie',
                'rules' => 'required|integer',
                'class' => Category::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Category $category) {
                    return $category->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ]);
    }
}
