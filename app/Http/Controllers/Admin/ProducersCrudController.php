<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProducersRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProducersCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProducersCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Producers::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/producers');
        CRUD::setEntityNameStrings('producers', 'producers');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn(
            [
                // 1-n relationship
                'label'     => 'User', // Table column heading
                'type'      => 'select',
                'name'      => 'user_id', // the column that contains the ID of that connected entity;
                'entity'    => 'user', // the method that defines the relationship in your Model
                'attribute' => 'username', // foreign key attribute that is shown to user
                'model'     => "App\Models\WineUser", // foreign key model
            ]);
        CRUD::addColumn(
            [
                // 1-n relationship
                'label'     => 'Country', // Table column heading
                'type'      => 'select',
                'name'      => 'country_id', // the column that contains the ID of that connected entity;
                'entity'    => 'country', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "App\Models\Country", // foreign key model
            ]);
        CRUD::column('name');
        CRUD::column('slug');
        CRUD::addColumn([
            'name'  => 'status',
            'label' => 'Status',
            'type'  => 'enum',
            'options' => [
                '0' => 'Inactive',
                '1' => 'Active'
            ]
        ]);
        CRUD::addColumn([
            'name' => 'is_approved',
            'label' => __('is approved'),
            'type' => 'enum',
            'placeholder' => __('is approved'),
            'options' => [
                '0' => 'No',
                '1' => 'Yes'
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
        CRUD::setValidation(ProducersRequest::class);

        CRUD::addField([  // Select
            'label'     => "User",
            'type'      => 'select',
            'name'      => 'user_id', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'
            'entity'    => 'user',

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\WineUser", // related model
            'attribute' => 'username', // foreign key attribute that is shown to user

            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                return $query->orderBy('username', 'ASC')->get();
            }), //  you can use this to filter the results show in the select
        ]);
        CRUD::addField([  // Select
            'label'     => "Country",
            'type'      => 'select',
            'name'      => 'country_id', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'
            'entity'    => 'country',

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\Country", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user

            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), //  you can use this to filter the results show in the select
        ]);
        CRUD::field('name');
        CRUD::field('slug');
        CRUD::addField([
            'name' => 'status',
            'label' => __('Status'),
            'type' => 'enum',
            'placeholder' => __('Status'),
            'options' => [
                '0' => 'Inactive',
                '1' => 'Active'
            ]
        ]);

        CRUD::addField([
            'name' => 'is_approved',
            'label' => __('is approved'),
            'type' => 'enum',
            'placeholder' => __('is approved'),
            'options' => [
                '0' => 'No',
                '1' => 'Yes'
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
