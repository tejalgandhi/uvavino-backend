<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BasketRequest;
use App\Models\Country;
use App\Models\DrinkType;
use App\Models\Product;
use App\Models\WineUser;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Str;

/**
 * Class BasketCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BasketCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Basket::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/basket');
        CRUD::setEntityNameStrings('basket', 'baskets');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('title');
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
        CRUD::setValidation(BasketRequest::class);
        $drinkTypeOptions = DrinkType::pluck('name', 'id');
        $wineUserOptions = WineUser::pluck('username', 'id');
        $countryOptions = Country::OrderBy('name')->pluck('name','id');
        CRUD::field('title');
        CRUD::addField([
            'name' => 'description',
            'label' => __('description'),
            'type' => 'ckeditor',
            'placeholder' => 'Your textarea text here',
        ]);
        CRUD::addField([
            'name' => 'stock',
            'label' => __('Stock'),
            'type' => 'number',
        ]);
        CRUD::addField([
            'name' => 'price',
            'label' => __('price'),
            'type' => 'number',
        ]);
        CRUD::addField([
            'name' => 'weight',
            'label' => __('weight'),
            'type' => 'number',
        ]);
        CRUD::field('dimensions');
        CRUD::addField(
            [ // Table
                'name' => 'product',
                'label' => 'Product',
                'type' => 'repeatable',
                'wrapper' => [
                    'id' => 'product-field',
                ],
                'fields' => [
                    [   // Hidden
                        'name'  => 'id',
                        'type'  => 'hidden',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'title',
                        'label' => __('Title'),
                        'type' => 'text',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'description',
                        'label' => __('description'),
                        'type' => 'ckeditor',
                        'placeholder' => 'Your textarea text here',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'wine_user_id',
                        'label' => __('Wine User'),
                        'type' => 'select_from_array',
                        'options' => $wineUserOptions,
                        'attributes' => [
                            'class' => 'form-control size-dropdown',
                        ],
                        'allows_null' => false,
                    ],
                    [
                        'name' => 'drink_type_id',
                        'label' => __('Drink Type'),
                        'type' => 'select_from_array',
                        'options' => $drinkTypeOptions,
                        'attributes' => [
                            'class' => 'form-control size-dropdown',
                        ],
                        'allows_null' => false,
                    ],
                    [
                        'name' => 'wine_name',
                        'label' => __('Wine Name'),
                        'type' => 'text',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'bottle_size',
                        'label' => __('Bottle Size'),
                        'type' => 'select_from_array',
                        'options' => config('constants.bottle_size'),
                        'attributes' => [
                            'class' => 'form-control size-dropdown',
                        ],
                        'allows_null' => false,
                    ],
                    [
                        'name' => 'country_id',
                        'label' => __('Country'),
                        'type' => 'select_from_array',
                        'options' => $countryOptions,
                        'attributes' => [
                            'class' => 'form-control size-dropdown',
                        ],
                        'allows_null' => false,
                    ],
                    [
                        'label'     => __("Region"),
                        'type'      => 'select',
                        'name'      => 'region_id',
                        'entity'    => 'region',
                        'model'     => "App\Models\Region",
                        'attribute' => 'name',
                        'options'   => (function ($query) {
                            return $query->orderBy('name', 'ASC')->get();
                        }),
                    ],
                    [
                        'label'     => __("Producer"),
                        'type'      => 'select',
                        'name'      => 'producer_id',
                        'entity'    => 'producer',
                        'model'     => "App\Models\Producer",
                        'attribute' => 'name',
                        'options'   => (function ($query) {
                            return $query->orderBy('name', 'ASC')->get();
                        }),
                    ],
                    [
                        'name' => 'wine_maker',
                        'label' => __('Wine Maker'),
                        'type' => 'text',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'label'     => __("Wine Type"),
                        'type'      => 'select',
                        'name'      => 'type_of_wine',
                        'entity'    => 'wine_type',
                        'model'     => "App\Models\WineType",
                        'attribute' => 'name',
                        'options'   => (function ($query) {
                            return $query->orderBy('name', 'ASC')->get();
                        }),
                    ],
                    [
                        'name' => 'year',
                        'label' => __('Year'),
                        'type' => 'number',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'grape_varieties',
                        'label' => __('Grape varieties'),
                        'type' => 'text',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'label'     => __("Wine Tag"),
                        'type'      => 'select',
                        'name'      => 'wine_tag_id',
                        'entity'    => 'wine_tag',
                        'model'     => "App\Models\WineTag",
                        'attribute' => 'name',
                        'options'   => (function ($query) {
                            return $query->orderBy('name', 'ASC')->get();
                        }),
                    ],
                    [
                        'name' => 'storage_condition',
                        'label' => __('Storage Conditions'),
                        'type' => 'text',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'review_and_rewards',
                        'label' => __('Review and Rewards'),
                        'type' => 'text',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'medal',
                        'label' => __('Medal'),
                        'type' => 'text',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'award_name',
                        'label' => __('Award Name'),
                        'type' => 'text',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'score',
                        'label' => __('Score'),
                        'type' => 'number',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'review_name',
                        'label' => __('Review Name'),
                        'type' => 'text',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'weight',
                        'label' => __('Weight'),
                        'type' => 'number',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'dimensions',
                        'label' => __('Dimension'),
                        'type' => 'text',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'basket_quantity',
                        'label' => __('Basket Quantity'),
                        'type' => 'number',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'unit_quantity',
                        'label' => __('Unit Quantity'),
                        'type' => 'number',
                        'attributes' => ["step" => "any"],
                    ],
                    [
                        'name' => 'unit',
                        'label' => __('Unit'),
                        'type' => 'select_from_array',
                        'options' => config('constants.unit'),
                        'attributes' => [
                            'class' => 'form-control size-dropdown',
                        ],
                        'allows_null' => false,
                    ],

                ],
                'new_item_label' => 'Add Product',
            ]
        );


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

    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        // insert item in the db
        $product = $this->crud->getStrippedSaveRequest($request)['product'] ?? [];


        $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));

        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }
    public function edit($id)
    {
        $this->crud->hasAccessOrFail('update');
        // get entry ID from Request (makes sure its the last ID for nested resources)
        $this->crud->setOperationSetting('fields', $this->crud->getUpdateFields($id));
        // get the info for that entry
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->crud->getSaveAction();
        $this->data['title'] = trans('backpack::crud.edit') . ' ' . $this->crud->entity_name;

        $this->data['id'] = $id;
        return view($this->crud->getEditView(), $this->data);
    }
    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        // update the row in the db
        $item = $this->crud->update($request->get($this->crud->model->getKeyName($request->except('product'))), $this->crud->getStrippedSaveRequest($request));
        $product = $this->crud->getStrippedSaveRequest($request)['product'] ?? [];


        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
