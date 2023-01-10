<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ArticleCrudController extends CrudController
{
    use Operations\ListOperation;
    use Operations\CreateOperation;
    use Operations\UpdateOperation;
    use Operations\CloneOperation;
    use Operations\DeleteOperation;
    use Operations\BulkDeleteOperation;
    use Operations\BulkCloneOperation;

    public function setup()
    {
        CRUD::setModel(Article::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/article');
        CRUD::setEntityNameStrings(__('article'), __('articles'));
    }

    public function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'date',
            'label' => __('Date'),
            'type' => 'date',
        ]);

        CRUD::addColumn([
            'name' => 'status',
            'label' => __('Status'),
            'type' => 'trans',
        ]);

        CRUD::addColumn([
            'name' => 'title',
            'label' => __('Title'),
        ]);

        CRUD::addColumn([
            'name' => 'featured',
            'label' => __('Featured'),
            'type' => 'boolean',
        ]);

        CRUD::addColumn([
            'name' => 'category_id',
            'label' => __('Category'),
            'type' => 'select',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => Category::class,
        ]);

        /*$filtered_id = map_contains([
            'article' => 1,
            'press-release' => 2,
            'contests' => 3,
        ], $_SERVER['REQUEST_URI']);

        CRUD::query->whereHas('category', function ($query) use ($filtered_id) {
            $query->where('id', $filtered_id)->orWhere('parent_id', $filtered_id);
        });*/
    }

    public function setupCreateOperation()
    {
        CRUD::setValidation(ArticleRequest::class);

        CRUD::addField([
            'name' => 'title',
            'label' => __('Title'),
            'type' => 'text',
            'placeholder' => 'Your title here',
        ]);

        CRUD::addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Will be automatically generated from your title, if left empty.',
        ]);

        CRUD::addField([
            'name' => 'date',
            'label' => __('Date'),
            'type' => 'date',
            'value' => date('Y-m-d'),
        ]);

        CRUD::addField([
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
        ]);

        CRUD::addField([
            'name' => 'content',
            'label' => __('Content'),
            'type' => 'ckeditor',
            'placeholder' => 'Your textarea text here',
        ]);

        CRUD::addField([
            'name' => 'documents',
            'label' => __('Upload documents'),
            'type' => 'upload_multiple',
            'upload' => true,
            'disk' => 'uploads',
        ]);

        CRUD::addField([
            'name' => 'image',
            'label' => __('Image'),
            'type' => 'image',
            'upload' => true,
            'crop' => true,
            'disk' => 'uploads',
        ]);

        // CRUD::addField([
        //     'name' => 'images',
        //     'label' => __('Images'),
        //     'type' => 'dropzone',

        //     'class' => Article::class,
        //     'path' => 'articles',
        //     'media' => 'image',

        //     'save_original' => true,
        //     'sizes' => [1600, 800, 256],
        //     'quality' => 85,
        // ]);

        // CRUD::addField([
        //     'name' => 'videos',
        //     'label' => __('Videos'),
        //     'type' => 'dropzone',

        //     'class' => Article::class,
        //     'path' => 'articles/videos',
        //     'media' => 'video',

        //     'sizes' => [640, 256],
        // ]);

        CRUD::addField([
            'name' => 'articles',
            'label' => __('Related'),
            'type' => 'select2_from_ajax_multiple',
            'entity' => 'articles',
            'attribute' => 'title_translated',
            'model' => Article::class,
            'data_source' => url('admin/api/article/ajax/search'),
            'placeholder' => __('Select an Article'),
            'minimum_input_length' => 2,
            'pivot' => true,
        ]);

        CRUD::addField([
            'name' => 'category_id',
            'label' => __('Category'),
            'type' => 'select2',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => Category::class,
        ]);

        CRUD::addField([
            'name' => 'tags',
            'label' => __('Tags'),
            'type' => 'select2_multiple',
            'entity' => 'tags',
            'attribute' => 'name',
            'model' => Tag::class,
            'pivot' => true,
        ]);

        CRUD::addField([
            'name' => 'status',
            'label' => __('Status'),
            'type' => 'enum',
        ]);

        CRUD::addField([
            'name' => 'featured',
            'label' => __('Featured item'),
            'type' => 'checkbox',
        ]);
    }

    public function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
