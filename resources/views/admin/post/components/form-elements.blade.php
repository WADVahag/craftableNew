<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': fields.title && fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.post.columns.title') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': fields.title && fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.post.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shortdescription'), 'has-success': fields.shortdescription && fields.shortdescription.valid }">
    <label for="shortdescription" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.post.columns.shortdescription') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shortdescription" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shortdescription'), 'form-control-success': fields.shortdescription && fields.shortdescription.valid}" id="shortdescription" name="shortdescription" placeholder="{{ trans('admin.post.columns.shortdescription') }}">
        <div v-if="errors.has('shortdescription')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shortdescription') }}</div>
    </div>
</div>


