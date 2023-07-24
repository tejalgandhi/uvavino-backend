<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuctionPackageRequest;
use App\Models\AuctionPackage;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class AuctionPackageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AuctionPackageCrudController extends CrudController
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
        $this->crud->addButtonFromView('top', 'reorderbestseller', 'reorderbestseller', 'beginning');

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

    public function reorder_product(Request $request,$slug)
    {
        if ($request->isMethod('post'))
        {
            $count = 0;
            $data = $request->all();

            if(isset($data['tree']))
            {
                $tree = collect($data['tree'])->pluck('item_id')->all();
                foreach (array_filter($tree) as $key => $id) {
                    AuctionPackage::where('id', $id)->update([$slug.'_order' => $key+1]);
                }
            }
        }
        $this->crud->set('reorder.max_level', AuctionPackage::MAX_DEPTH);
        $this->crud->addClause('where', $slug, '=', '1');
        $this->crud->orderBy($slug.'_order');
        $this->crud->set('reorder.label', 'name');
        $this->data['crud'] = $this->crud;
        $this->data['entries'] = $this->data['crud']->getEntries();
        $this->data['slug'] = $slug;
        return view('vendor/auction-packages/sort_new_release', $this->data);
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
        CRUD::addField([
            'name' => 'bestsellers',
            'label' => 'Best Seller',
            'type' => 'checkbox',
        ]);
        CRUD::addField([
            'name' => 'new_release',
            'label' => 'New Release',
            'type' => 'checkbox',
        ]);
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
    protected function setupUpdateOperation()
    {
//        $this->setupCreateOperation();
        CRUD::setValidation(AuctionPackageRequest::class);

        CRUD::field('name');
        CRUD::addField([
            'name' => 'image', // The db column name
            'label' => __('Image'), // Table column heading
            'type' => 'image',
            'disk' => 'uploads',
        ]);
        CRUD::addField([
            'name' => 'qty',
            'label' => __('qty'),
            'attributes' => [
                'readonly' => 'readonly',
            ],
        ]);
        CRUD::addField([
            'name' => 'amount',
            'label' => __('Amount'),
            'attributes' => [
                'readonly' => 'readonly',
            ],
        ]);
        CRUD::addField([
            'name' => 'discount_amount',
            'label' => __('Discount Amount'),
        ]);
        CRUD::addField([
            'name' => 'bestsellers',
            'label' => 'Best Seller',
            'type' => 'checkbox',
        ]);
        CRUD::addField([
            'name' => 'new_release',
            'label' => 'New Release',
            'type' => 'checkbox',
        ]);
    }
}
