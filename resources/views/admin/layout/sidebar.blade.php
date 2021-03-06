<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/products') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.product.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/posts') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.post.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/writers') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.writer.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/books') }}"><i class="nav-icon icon-compass"></i> {{ trans('admin.book.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/tessters') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.tesster.title') }}</a></li>
           {{-- <li class="nav-item"><a class="nav-link" href="{{ url('admin/rooms') }}"><i class="nav-icon icon-star"></i> {{ trans('admin.room.title') }}</a></li> --}}
           {{-- <li class="nav-item"><a class="nav-link" href="{{ url('admin/customers') }}"><i class="nav-icon icon-puzzle"></i> {{ trans('admin.customer.title') }}</a></li> --}}
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/hotelrooms') }}"><i class="nav-icon icon-compass"></i> {{ trans('admin.hotelroom.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/newcustomers') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.newcustomer.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
