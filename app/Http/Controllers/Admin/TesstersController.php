<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tesster\BulkDestroyTesster;
use App\Http\Requests\Admin\Tesster\DestroyTesster;
use App\Http\Requests\Admin\Tesster\IndexTesster;
use App\Http\Requests\Admin\Tesster\StoreTesster;
use App\Http\Requests\Admin\Tesster\UpdateTesster;
use App\Models\Tesster;
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

class TesstersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTesster $request
     * @return array|Factory|View
     */
    public function index(IndexTesster $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Tesster::class)->processRequestAndGet(
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

        return view('admin.tesster.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.tesster.create');

        return view('admin.tesster.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTesster $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTesster $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Tesster
        $tesster = Tesster::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/tessters'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/tessters');
    }

    /**
     * Display the specified resource.
     *
     * @param Tesster $tesster
     * @throws AuthorizationException
     * @return void
     */
    public function show(Tesster $tesster)
    {
        $this->authorize('admin.tesster.show', $tesster);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tesster $tesster
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Tesster $tesster)
    {
        $this->authorize('admin.tesster.edit', $tesster);


        return view('admin.tesster.edit', [
            'tesster' => $tesster,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTesster $request
     * @param Tesster $tesster
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTesster $request, Tesster $tesster)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Tesster
        $tesster->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/tessters'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/tessters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTesster $request
     * @param Tesster $tesster
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTesster $request, Tesster $tesster)
    {
        $tesster->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTesster $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTesster $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Tesster::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
