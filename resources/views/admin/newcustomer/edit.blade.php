@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.newcustomer.actions.edit', ['name' => $newcustomer->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <newcustomer-form
                :action="'{{ $newcustomer->resource_url }}'"
                :data="{{ $newcustomer->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.newcustomer.actions.edit', ['name' => $newcustomer->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.newcustomer.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </newcustomer-form>

        </div>
    
</div>

@endsection