<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TagCrudController extends CrudController
{
    use Operations\ListOperation;
    use Operations\CreateOperation;
    use Operations\UpdateOperation;
    use Operations\CloneOperation;
    use Operations\DeleteOperation;
    use Operations\BulkDeleteOperation;
    use Operations\BulkCloneOperation;
    use Operations\ReorderOperation;

    public function setup()
    {
        CRUD::setModel(Tag::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/tag');
        CRUD::setEntityNameStrings(__('tag'), __('tags'));
    }

    public function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'name',
            'label' => __('Name'),
        ]);

        CRUD::addColumn([
            'name' => 'slug',
            'label' => 'Slug',
        ]);
    }

    public function setupCreateOperation()
    {
        CRUD::setValidation(TagRequest::class);

        CRUD::addField([
            'name' => 'name',
            'label' => __('Name'),
        ]);

        CRUD::addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => __('Will be automatically generated from your name, if left empty.'),
        ]);
    }

    public function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
