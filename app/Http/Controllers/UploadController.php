<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UploadController extends Controller
{
    // public function uploadFile(Request $request)
    // {
    //     $file = $request->file('file');
    //     $chunkIndex = $request->input('resumableChunkNumber');
    //     $totalChunks = $request->input('resumableTotalChunks');
    //     $fileName = $request->input('resumableFilename');

    //     // Simpan chunk ke storage
    //     $path = 'temp-uploads/' . $fileName . '.part' . $chunkIndex;
    //     Storage::disk('public')->put($path, file_get_contents($file));

    //     // Jika semua chunk sudah diupload, gabungkan
    //     if ($chunkIndex == $totalChunks) {
    //         $this->combineChunks($fileName, $totalChunks);
    //     }

    //     return response()->json(['status' => 'success']);
    // }

    // protected function combineChunks($fileName, $totalChunks)
    // {
    //     $finalPath = 'uploads/' . $fileName;
    //     $finalFile = fopen(public_path('app/public/' . $finalPath), 'wb');

    //     for ($i = 1; $i <= $totalChunks; $i++) {
    //         $chunkPath = 'temp-uploads/' . $fileName . '.part' . $i;
    //         $chunk = fopen(public_path('app/public/' . $chunkPath), 'rb');
    //         stream_copy_to_stream($chunk, $finalFile);
    //         fclose($chunk); 
    //         // Hapus chunk setelah digabung
    //         Storage::disk('public')->delete($chunkPath);
    //     }

    //     fclose($finalFile);
    // }

    public function uploadFile(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded.'], 400);
        }

        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            return response()->json(['error' => 'File not uploaded properly.'], 400);
        }

        $fileReceived = $receiver->receive();
        if ($fileReceived->isFinished()) {
            $file = $fileReceived->getFile();
            $extension = $file->getClientOriginalExtension();
            // $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName());
            $fileName = md5(time()) . '.' . $extension;

            $disk = Storage::disk('public');
            $path = $disk->putFileAs('temp-uploads', $file, $fileName);

            Session::put('file_path', $path);

            // delete chunks
            if (file_exists($file->getPathName())) {
                unlink($file->getPathName());
            }

            return [
                'path' => asset('temp-uploads/' . $path),
                'filename' => $fileName
            ];
        }

        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}
