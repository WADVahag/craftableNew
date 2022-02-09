@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.writer.actions.edit', ['name' => $writer->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <writer-form
                :action="'{{ $writer->resource_url }}'"
                :data="{{ $writer->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.writer.actions.edit', ['name' => $writer->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.writer.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </writer-form>

        </div>
    
</div>

@endsection