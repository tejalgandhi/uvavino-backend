<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuctionPackageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AuctionPackageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AuctionPackageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\AuctionPackage::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/auction-package');
        CRUD::setEntityNameStrings('Auction Package', 'Auction Packages');
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
        CRUD::addColumn([
            'name' => 'image', // The db column name
            'label' => __('Image'), // Table column heading
            'type' => 'image',
            'disk' => 'uploads',
        ]);
        CRUD::column('qty');
        CRUD::column('amount');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    protected function setupShowOperation()
    {

        CRUD::column('name');
        CRUD::column('slug');
        CRUD::addColumn([
            'name' => 'image', // The db column name
            'label' => __('Image'), // Table column heading
            'type' => 'image',
            'disk' => 'uploads',
        ]);
        CRUD::column('qty');
        CRUD::column('amount');
        CRUD::column('discount_amount');
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
        CRUD::setValidation(AuctionPackageRequest::class);

        CRUD::field('name');
        CRUD::addField([
            'name' => 'slug',
            'label' => __('Slug'),
            'type' => 'hidden',
        ]);
        CRUD::addField([
            'name' => 'image', // The db column name
            'label' => __('Image'), // Table column heading
            'type' => 'image',
            'disk' => 'uploads',
        ]);
        CRUD::field('qty');
        CRUD::field('amount');
        CRUD::field('discount_amount');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

//    /**
//     * Define what happens when the Update operation is loaded.
//     *
//     * @see https://backpackforlaravel.com/docs/crud-operation-update
//     * @return void
//     */
//    protected function setupUpdateOperation()
//    {
//        $this->setupCreateOperation();
//    }
}
