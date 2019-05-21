<?php

namespace App\Forms;

use App\Models\Category;
use Kris\LaravelFormBuilder\Form;

class CorpForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Libellé'
        ])
            ->add('abreviation', 'text', [
                'label' => 'Abréviation',
                'rules' => 'required|max:15'

            ])
            ->add('category_id', 'entity', [
                'label' => 'Catégorie',
                'rules' => 'required|integer',
                'class' => Category::class,
                'query_builder' => function (Category $category) {
                    return $category->pluck('name', 'id');
                }
            ]);
    }
}
