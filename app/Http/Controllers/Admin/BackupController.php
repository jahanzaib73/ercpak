<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class BackupController extends Controller
{
    public function takeBackup()
    {
        try {
            $backupPath = 'mydb.sql';
            $command = "mysqldump --host=" . env('DB_HOST') . " --port=" . env('DB_PORT') . " --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " " . env('DB_DATABASE') . " > " . $backupPath;

            exec($command);

            return response()->download($backupPath)->deleteFileAfterSend(true);
        } catch (\Exception $ex) {
           dd($ex);
        }
    }
}
