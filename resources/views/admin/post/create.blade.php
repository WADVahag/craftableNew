@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.post.actions.create'))

@section('body')

    <div class="container-xl">

                <div class="card">
        
        <post-form
            :action="'{{ url('admin/posts') }}'"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" enctype="multipart/form-data" method="post" @submit.prevent="onSubmit" :action="action" novalidate>
                
                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.post.actions.create') }}
                </div>

                <div class="card-body">
                    @include('admin.post.components.form-elements')
                    @include('brackets/admin-ui::admin.includes.media-uploader', [
                        'mediaCollection' => app(App\Models\Post::class)->getMediaCollection('gallery'),
                        'label' => 'Gallery'
                    ])
                </div>
                                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>
                </div>
                
            </form>

        </post-form>

        </div>

        </div>

    
@endsection