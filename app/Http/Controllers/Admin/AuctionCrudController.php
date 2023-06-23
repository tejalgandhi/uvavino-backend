<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuctionRequest;
use App\Models\Basket;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Enums\AuctionPrivate;
use App\Enums\AuctionType;
/**
 * Class AuctionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AuctionCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Auction::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/auction');
        CRUD::setEntityNameStrings('Auction', 'Auctions');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
        CRUD::column('title');
        CRUD::column('description');
        CRUD::addColumn([
            'name' => 'is_private',
            'label' => __('Private'),
            'type' => 'select_from_array',
            'options' => AuctionPrivate::getValues(),
            'attributes' => [
                'class' => 'form-control size-dropdown',
            ],
            'allows_null' => false,
        ]);
        CRUD::addColumn([
            'name' => 'type',
            'label' => __('Type'),
            'type' => 'select_from_array',
            'options' => AuctionType::getValues(),
            'attributes' => [
                'class' => 'form-control size-dropdown',
            ],
            'allows_null' => false,
        ]);
        CRUD::column('max_price');

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(AuctionRequest::class);
        $basketOptions = Basket::pluck('title', 'id');

        CRUD::addField([
            'name' => 'basket_id',
            'label' => __('Basket'),
            'type' => 'select_from_array',
            'options' => $basketOptions,
            'attributes' => [
                'class' => 'form-control size-dropdown',
            ],
            'allows_null' => false,
        ]);
        CRUD::Field('title');
        CRUD::Field('description');
        CRUD::addField([
            'name' => 'is_private',
            'label' => __('Private'),
            'type' => 'select_from_array',
            'options' => AuctionPrivate::getValues(),
            'attributes' => [
                'class' => 'form-control size-dropdown',
            ],
            'allows_null' => false,
        ]);
        CRUD::addField([
            'name' => 'type',
            'label' => __('Type'),
            'type' => 'select_from_array',
            'options' => AuctionType::getValues(),
            'attributes' => [
                'class' => 'form-control size-dropdown',
            ],
            'allows_null' => false,
        ]);
        CRUD::Field('max_price');
        CRUD::addField([
            'name' => 'invitations',
            'label' => __('invitations'),
            'type' => 'select2_multiple',
            'entity' => 'invitations',
            'attribute' => 'username',
            'model' => "App\Models\WineUser",
            'pivot' => true,
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
