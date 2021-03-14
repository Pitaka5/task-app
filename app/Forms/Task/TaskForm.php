<?php

namespace App\Forms\Task;

use Kris\LaravelFormBuilder\Form;

class TaskForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text', [
                'rules' => 'required|max:225',
            ])
            ->add('date', 'text', [
                'rules' => ['required', 'date_format:Y-m-d'],
            ])
            ->add('time_spent', 'number', [
                'label' => __('Time spent (in minutes)'),
                'rules' => 'required|integer|max:10000'
            ])
            ->add('comment', 'textarea', [
                'rules' => 'nullable|max:65535'
            ])
            ->add('user_id', 'hidden', [
                'value' => auth()->user()->id,
            ])
            ->add('submit', 'submit', ['label' => 'Create']);
    }
}
