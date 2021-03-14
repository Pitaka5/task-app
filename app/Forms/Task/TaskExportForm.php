<?php

namespace App\Forms\Task;

use Kris\LaravelFormBuilder\Form;

class TaskExportForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('date_from', 'text', [
                'rules' => ['nullable', 'date_format:Y-m-d'],
            ])
            ->add('date_to', 'text', [
                'rules' => ['nullable', 'required_with:date_from', 'date_format:Y-m-d', 'after_or_equal:date_from',],
            ])
            ->add('type', 'choice', [
                'choices' => [
                    'csv' => 'csv',
                    'xlsx' => 'xlsx',
                    'pdf' => 'pdf',
                ],
            ])
            ->add('submit', 'submit', ['label' => 'Export']);
    }
}
