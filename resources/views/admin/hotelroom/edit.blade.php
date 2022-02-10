@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.hotelroom.actions.edit', ['name' => $hotelroom->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <hotelroom-form
                :action="'{{ $hotelroom->resource_url }}'"
                :data="{{ $hotelroom->toJson() }}"
                :available-newcustomers="{{ $newcustomers->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.hotelroom.actions.edit', ['name' => $hotelroom->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.hotelroom.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </hotelroom-form>

        </div>
    
</div>

@endsection