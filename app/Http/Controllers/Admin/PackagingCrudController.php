<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PackagingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PackagingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PackagingCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Packaging::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/packaging');
        CRUD::setEntityNameStrings('packaging', 'packagings');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'label'     => __("Product"),
            'type'      => 'select',
            'name'      => 'product_id',
            'entity'    => 'product',
            'model'     => "App\Models\Product",
            'attribute' => 'wine_name',
            'options'   => (function ($query) {
                return $query->orderBy('wine_name', 'ASC')->get();
            }),
        ]);
        CRUD::column('stock');
        CRUD::column('price');

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
        CRUD::setValidation(PackagingRequest::class);

        CRUD::addField([
            'label'     => __("Product"),
            'type'      => 'select',
            'name'      => 'product_id',
            'entity'    => 'product',
            'model'     => "App\Models\Product",
            'attribute' => 'wine_name',
            'options'   => (function ($query) {
                return $query->orderBy('wine_name', 'ASC')->get();
            }),
        ]);

        CRUD::field('stock');
        CRUD::field('price');
        CRUD::field('weight');
        CRUD::field('dimension');
        CRUD::field('quantity');
        CRUD::addField([
            'name' => 'unit',
            'label' => __('Unit'),
            'type' => 'enum',
            'placeholder' => __('Unit'),
            'options' => config('constants.unit')

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
