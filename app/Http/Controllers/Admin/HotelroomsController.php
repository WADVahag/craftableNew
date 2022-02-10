<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Hotelroom\BulkDestroyHotelroom;
use App\Http\Requests\Admin\Hotelroom\DestroyHotelroom;
use App\Http\Requests\Admin\Hotelroom\IndexHotelroom;
use App\Http\Requests\Admin\Hotelroom\StoreHotelroom;
use App\Http\Requests\Admin\Hotelroom\UpdateHotelroom;
use App\Models\Hotelroom;
use App\Models\Newcustomer;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HotelroomsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexHotelroom $request
     * @return array|Factory|View
     */
    public function index(IndexHotelroom $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Hotelroom::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name' , 'newcustomers.name'],

            function ($query) use ($request) {                      
                $query->with(['newcustomers']);
    
                // add this line if you want to search by newcustomers attributes
                $query->join('hotelroom_newcustomer', 'hotelroom_newcustomer.hotelroom_id', '=', 'hotelrooms.id')
                      ->join('newcustomers', 'newcustomers.id', '=', 'hotelroom_newcustomer.newcustomer_id')
                      ->groupBy('hotelrooms.id');
            }


        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.hotelroom.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.hotelroom.create');

        return view('admin.hotelroom.create' , ['newcustomers' => Newcustomer::all()] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHotelroom $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreHotelroom $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['newcustomers'] = $request->getNewcustomers();

        
    DB::transaction(function () use ($sanitized) {
        // Store the ArticlesWithRelationship
        $hotelroom = Hotelroom::create($sanitized);
        $hotelroom->newcustomers()->sync($sanitized['newcustomers']);
    });
  

        if ($request->ajax()) {
            return ['redirect' => url('admin/hotelrooms'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/hotelrooms');
    }

    /**
     * Display the specified resource.
     *
     * @param Hotelroom $hotelroom
     * @throws AuthorizationException
     * @return void
     */
    public function show(Hotelroom $hotelroom)
    {
        $this->authorize('admin.hotelroom.show', $hotelroom);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hotelroom $hotelroom
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Hotelroom $hotelroom)
    {
        $this->authorize('admin.hotelroom.edit', $hotelroom);

        $hotelroom->load('newcustomers');

        return view('admin.hotelroom.edit', [
            'hotelroom' => $hotelroom,
            'newcustomers' => Newcustomer::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHotelroom $request
     * @param Hotelroom $hotelroom
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateHotelroom $request, Hotelroom $hotelroom)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['newcustomers'] = $request->getNewcustomers();

        
        DB::transaction(function () use ($hotelroom , $sanitized) {
            // Update changed values Hotelroom
            $hotelroom->update($sanitized);
            $hotelroom->newcustomers()->sync($sanitized['newcustomers']);
        });

    

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/hotelrooms'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/hotelrooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyHotelroom $request
     * @param Hotelroom $hotelroom
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyHotelroom $request, Hotelroom $hotelroom)
    {
        $hotelroom->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyHotelroom $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyHotelroom $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Hotelroom::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
