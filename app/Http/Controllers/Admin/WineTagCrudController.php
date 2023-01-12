<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WineTagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WineTagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WineTagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\WineTag::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/wine-tags');
        CRUD::setEntityNameStrings(__('Wine Tag'), __('Wine Tags'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::column('name');
        CRUD::column('slug');
        CRUD::addColumn([
            'name'  => 'status',
            'label' => __('Status'),
            'type'  => 'enum',
            'options' => [
                '0' => 'Inactive',
                '1' => 'Active'
            ]
        ]);
        CRUD::addColumn([
            'name' => 'is_approved',
            'label' => __('Is Approved'),
            'type' => 'enum',
            'placeholder' => __('Is Approved'),
            'options' => [
                '0' => __('No'),
                '1' => __('Yes')
            ]
        ]);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(WineTagRequest::class);

        CRUD::field('name');
        CRUD::field('slug');
        CRUD::addField([
            'name' => 'status',
            'label' => __('Status'),
            'type' => 'enum',
            'placeholder' => __('Status'),
            'options' => [
                '1' => __('Active'),
                '0' => __('Inactive')
            ]
        ]);

        CRUD::addField([
            'name' => 'is_approved',
            'label' => __('is approved'),
            'type' => 'enum',
            'placeholder' => __('is approved'),
            'options' => [
                '1' => __('Yes'),
                '0' => __('No')
            ]
        ]);


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
