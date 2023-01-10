<?php

namespace App;

trait PageTemplates
{
    private function home()
    {
        $this->metas();

        $this->header(__('Content'));

        $this->addField([
            'name' => 'header',
            'label' => __('Title'),
            'type' => 'text',
        ]);
    }

    private function contacts()
    {
        $this->metas();

        $this->header(__('Content'));

        $this->addField([
            'name' => 'header',
            'label' => __('Title'),
            'type' => 'text',
        ]);

        $this->addField([
            'name' => 'contacts',
            'label' => __('Contacts'),
            'type' => 'table',
            'columns' => [
                'name' => __('Name'),
                'address' => __('Address'),
                'phone' => __('Phone'),
                'email' => __('Email'),
            ],
            'max' => 3,
            'min' => 1,
        ], false);
    }

    private function privacy()
    {
        $this->metas();

        $this->header(__('Content'));

        $this->addField([
            'name' => 'header',
            'label' => __('Title'),
            'type' => 'text',
        ]);

        $this->addField([
            'name' => 'description',
            'label' => __('Description'),
            'type' => 'wysiwyg',
        ]);
    }

    private function terms()
    {
        $this->metas();

        $this->header(__('Content'));

        $this->addField([
            'name' => 'header',
            'label' => __('Title'),
            'type' => 'text',
        ]);

        $this->addField([
            'name' => 'description',
            'label' => __('Description'),
            'type' => 'wysiwyg',
        ]);
    }

    // --------------------
    // Helpers
    private function metas()
    {
        $this->crud->addField([
            'name' => 'metas_separator',
            'type' => 'custom_html',
            'value' => '<br><h2>'.trans('backpack::pagemanager.metas').'</h2><hr>',
        ]);

        $this->crud->addField([
            'name' => 'meta_title',
            'label' => trans('backpack::pagemanager.meta_title'),
            'fake' => true,
            'store_in' => 'extras',
        ]);

        $this->crud->addField([
            'name' => 'meta_description',
            'label' => trans('backpack::pagemanager.meta_description'),
            'fake' => true,
            'store_in' => 'extras',
        ]);

        $this->crud->addField([
            'name' => 'meta_keywords',
            'type' => 'textarea',
            'label' => trans('backpack::pagemanager.meta_keywords'),
            'fake' => true,
            'store_in' => 'extras',
        ]);
    }

    public function addField($field, $translatable = true)
    {
        $this->crud->addField(array_merge($field, [
            'fake' => true,
            'store_in' => $translatable ? 'extras_translatable' : 'extras',
        ]));
    }

    private $id = 0;
    public function header($label)
    {
        $this->crud->addField([
            'name' => 'content_header_'.$this->id++,
            'type' => 'custom_html',
            'value' => "<br/><hr/><h2 style='margin-bottom:-5px'>$label</h2>",
        ]);
    }
}
