<?php

namespace App\Forms;

use App\Models\Category;
use Kris\LaravelFormBuilder\Form;

class ClasseForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom classe'
        ])
            ->add('description', 'text')
            ->add('category_id', 'entity', [
                'label' => 'Catégorie',
                'class' => Category::class,
                'query_builder' => function (Category $category) {
                    return $category->pluck('name', 'id');
                }
            ]);
    }
}
