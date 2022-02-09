<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Writer\BulkDestroyWriter;
use App\Http\Requests\Admin\Writer\DestroyWriter;
use App\Http\Requests\Admin\Writer\IndexWriter;
use App\Http\Requests\Admin\Writer\StoreWriter;
use App\Http\Requests\Admin\Writer\UpdateWriter;
use App\Models\Writer;
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

class WritersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexWriter $request
     * @return array|Factory|View
     */
    public function index(IndexWriter $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Writer::class)->processRequestAndGet(
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

        return view('admin.writer.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.writer.create');

        return view('admin.writer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWriter $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreWriter $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Writer
        $writer = Writer::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/writers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/writers');
    }

    /**
     * Display the specified resource.
     *
     * @param Writer $writer
     * @throws AuthorizationException
     * @return void
     */
    public function show(Writer $writer)
    {
        $this->authorize('admin.writer.show', $writer);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Writer $writer
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Writer $writer)
    {
        $this->authorize('admin.writer.edit', $writer);


        return view('admin.writer.edit', [
            'writer' => $writer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWriter $request
     * @param Writer $writer
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateWriter $request, Writer $writer)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Writer
        $writer->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/writers'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/writers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyWriter $request
     * @param Writer $writer
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyWriter $request, Writer $writer)
    {
        $writer->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyWriter $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyWriter $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Writer::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
