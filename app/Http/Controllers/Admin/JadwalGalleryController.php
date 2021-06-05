<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\JadwalGallery;
use App\Jadwal;

use App\Http\Requests\Admin\JadwalGalleryRequest;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class JadwalGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = JadwalGallery::with(['jadwal']);

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                    type="button" id="action' .  $item->id . '"
                                        data-toggle="dropdown" 
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <form action="' . route('jadwal-gallery.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->editColumn('fotos', function ($item) {
                    return $item->fotos ? '<img src="' . Storage::url($item->fotos) . '" style="max-height: 80px;"/>' : '';
                })
                ->rawColumns(['action','fotos'])
                ->make();
        }

        return view('pages.admin.jadwal-gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jadwals = Jadwal::all();
        
        return view('pages.admin.jadwal-gallery.create',[
            'jadwals' => $jadwals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JadwalGalleryRequest $request)
    {
        $data = $request->all();

        $data['fotos'] = $request->file('fotos')->store('assets/jadwal', 'public');

        JadwalGallery::create($data);

        return redirect()->route('jadwal-gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JadwalGalleryRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = JadwalGallery::findorFail($id);
        $item->delete();

        return redirect()->route('jadwal-gallery.index');

    }
}
