<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Newcustomer\BulkDestroyNewcustomer;
use App\Http\Requests\Admin\Newcustomer\DestroyNewcustomer;
use App\Http\Requests\Admin\Newcustomer\IndexNewcustomer;
use App\Http\Requests\Admin\Newcustomer\StoreNewcustomer;
use App\Http\Requests\Admin\Newcustomer\UpdateNewcustomer;
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

class NewcustomersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexNewcustomer $request
     * @return array|Factory|View
     */
    public function index(IndexNewcustomer $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Newcustomer::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.newcustomer.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.newcustomer.create');

        return view('admin.newcustomer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewcustomer $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreNewcustomer $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Newcustomer
        $newcustomer = Newcustomer::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/newcustomers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/newcustomers');
    }

    /**
     * Display the specified resource.
     *
     * @param Newcustomer $newcustomer
     * @throws AuthorizationException
     * @return void
     */
    public function show(Newcustomer $newcustomer)
    {
        $this->authorize('admin.newcustomer.show', $newcustomer);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Newcustomer $newcustomer
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Newcustomer $newcustomer)
    {
        $this->authorize('admin.newcustomer.edit', $newcustomer);


        return view('admin.newcustomer.edit', [
            'newcustomer' => $newcustomer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewcustomer $request
     * @param Newcustomer $newcustomer
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateNewcustomer $request, Newcustomer $newcustomer)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Newcustomer
        $newcustomer->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/newcustomers'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/newcustomers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyNewcustomer $request
     * @param Newcustomer $newcustomer
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyNewcustomer $request, Newcustomer $newcustomer)
    {
        $newcustomer->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyNewcustomer $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyNewcustomer $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Newcustomer::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
