<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.book.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.book.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.book.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.description" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('description'), 'form-control-success': fields.description && fields.description.valid}" id="description" name="description" placeholder="{{ trans('admin.book.columns.description') }}">
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('writer_id'), 'has-success': fields.writer_id && fields.writer_id.valid }">
    <label for="writer_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.book.columns.writer_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.writer_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('writer_id'), 'form-control-success': fields.writer_id && fields.writer_id.valid}" id="writer_id" name="writer_id" placeholder="{{ trans('admin.book.columns.writer_id') }}">
        <div v-if="errors.has('writer_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('writer_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('writer_id'), 'has-success': this.fields.writer_id && this.fields.writer_id.valid }">
    <label for="writer_id"
           class="col-form-label text-center col-md-4 col-lg-3">{{ trans('admin.post.columns.writer_id') }}</label>
    <div class="col-md-8 col-lg-9">

        <multiselect
            v-model="form.writer"
            :options="writers"
            :multiple="false"
            track-by="id"
            label="full_name"
            tag-placeholder="{{ __('Select Writer') }}"
            placeholder="{{ __('Writer') }}">
        </multiselect>

        <div v-if="errors.has('writer_id')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('writer_id') }}
        </div>
    </div>
</div>


