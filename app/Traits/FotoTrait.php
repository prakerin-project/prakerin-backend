<?php

namespace App\Traits;

use App\Models\Foto;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FotoTrait
{
    public function uploadFoto($perusaahanId, $foto)
    {
        $fileName = $perusaahanId . "_" . Str::random(10) . '.' . $foto->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('perusahaan', $foto, $fileName);

        Foto::query()->create([
            'id_perusahaan' => $perusaahanId,
            'path' => $fileName
        ]);
    }

    public function deleteFoto(int $id): void
    {
        $foto = Foto::query()->findOrFail($id);

        // Delete foto on storage
        Storage::disk("public")->delete("perusahaan/$foto->path");

        // Delete record of foto
        $foto->delete();
    }
}
