<?php

namespace App\Http\Controllers\Backend\Agency;

use Illuminate\Http\Request;
use App\Models\Agency\Agency;
use App\Http\Controllers\Controller;
use App\Repositories\AgencyRepository;
use App\Http\Requests\Backend\Agency\StoreAgencyRequest;
use App\Http\Requests\Backend\Agency\UpdateAgencyRequest;

class AgencyController extends Controller
{
    protected $agencies;

    public function __construct(AgencyRepository $agencies)
    {
        $this->agencies = $agencies;
    }

    /**
     * Show the search results and listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->only(['term']);

        $agencies = $this->agencies->search($input)->paginate();

        return view('backend.agencies.index')
            ->withagencies($agencies)
            ->withRequests($input);
    }

    public function show($id, Request $request)
    {
        $agency = $this->agencies->find($id);

        return view('backend.agencies.show')
            ->withEvent($agency);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.agencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgencyRequest $request)
    {
        $agency = $this->agencies->store($request->all());

        if (!$agency->save()) {
            throw new GeneralException('Maaf, aktiviti gagal disimpan.');
        }

        return redirect()->route('admin.agencies.edit', $agency->id)->withFlashSuccess('Maklumat agensi telah ditambah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agencies)
    {
        return view('backend.agencies.edit')
            ->withAgency($agencies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgencyRequest $request, Agency $agencies)
    {
        $agencies->update($request->all());

        return redirect()->route('admin.agencies.edit', $agencies->id)->withFlashSuccess('Maklumat agensi telah dikemaskini');
    }

    /**
     * Delete agencies
     *
     * @param  App\Event  $agencies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agencies)
    {
        $agencies->delete();

        return redirect()->route('admin.agencies.index')->withFlashSuccess('Agensi berjaya dihapus.');
    }
}
