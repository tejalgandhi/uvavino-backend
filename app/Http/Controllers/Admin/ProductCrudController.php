<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Config;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addField([  // Select
            'label'     => "User",
            'type'      => 'select',
            'name'      => 'wine_user_id', // the db column for the foreign key

            // optional
            // 'entity' should point to the method that defines the relationship in your Model
            // defining entity will make Backpack guess 'model' and 'attribute'
            'entity'    => 'wine_user',

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
        CRUD::column('wine_name');
        CRUD::column('slug');

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
        CRUD::setValidation(ProductRequest::class);
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
        CRUD::addField([
            'label'     => "Wine User",
            'type'      => 'select',
            'name'      => 'wine_user_id',
            'entity'    => 'wine_user',
            'model'     => "App\Models\WineUser",
            'attribute' => 'username',
            'options'   => (function ($query) {
                return $query->orderBy('username', 'ASC')->get();
            }),
        ]);
        CRUD::field('wine_name');
        CRUD::addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Will be automatically generated from your title, if left empty.',
        ]);

        CRUD::addField([
            'name' => 'description',
            'label' => __('description'),
            'type' => 'ckeditor',
            'placeholder' => 'Your textarea text here',
        ]);
        CRUD::addField([
            'label'     => "Drink Type",
            'type'      => 'select',
            'name'      => 'drink_type_id',
            'entity'    => 'drink_type',
            'model'     => "App\Models\DrinkType",
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        CRUD::addField([
            'name' => 'bottle_size',
            'label' => __('Bottle Size'),
            'type' => 'enum',
            'placeholder' => __('Bottle Size'),
            'options' => config('constants.bottle_size')

        ]);
        CRUD::addField([
            'label'     => "Country",
            'type'      => 'select',
            'name'      => 'country_id',
            'entity'    => 'country',
            'model'     => "App\Models\Country",
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        CRUD::addField([
            'label'     => "Region",
            'type'      => 'select',
            'name'      => 'region_id',
            'entity'    => 'region',
            'model'     => "App\Models\Region",
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        CRUD::addField([
            'label'     => "Producer",
            'type'      => 'select',
            'name'      => 'producer_id',
            'entity'    => 'producer',
            'model'     => "App\Models\Producer",
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        CRUD::field('wine_maker');
        CRUD::addField([
            'label'     => "Wine Type",
            'type'      => 'select',
            'name'      => 'type_of_wine',
            'entity'    => 'wine_type',
            'model'     => "App\Models\WineType",
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        CRUD::field('year');
        CRUD::field('grape_varieties');
        CRUD::addField([
            'label'     => "Wine Tag",
            'type'      => 'select',
            'name'      => 'wine_tag_id',
            'entity'    => 'wine_tag',
            'model'     => "App\Models\WineTag",
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        CRUD::field('storage_condition');
        CRUD::field('review_and_rewards');
        CRUD::field('medal');
        CRUD::field('award_name');
        CRUD::field('score');
        CRUD::field('review_name');

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
