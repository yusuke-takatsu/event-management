<?php

declare(strict_types=1);

namespace App\UseCase\Participation;

use App\Services\UploadFileService;
use Illuminate\Http\UploadedFile;

class FetchParticipationDownloadCsvUseCase
{
    public function __construct(
      private readonly UploadFileService $uploadFileService
    )
    {
      
    }

    public function execute(UploadedFile $csvFile)
    {
        //ファイルの保存
        $newCsvFileName = $this->uploadFileService->createFileToStorage($csvFile, 'public/csv/projects');

        $newCsvStorageFilePath = 'public/csv/projects' . $newCsvFileName;

        //保存したCSVファイルを削除
        $this->uploadFileService->deleteFileForStorage("public/csv/projects/{$newCsvFileName}");

        // csvデータの加工
        $uploadedData = $this->csvService->convertingCsvToCollection($csvData);
        // csvのヘッダーが合っているかのチェック
        $itemsCollection = $this->csvService->compareHeader($this->csvHeader(), $uploadedData);
        // バリデーション
        $validateItems = $this->validate($itemsCollection);
        // フォーマット
        $formattedItems = $this->formatItems($validateItems);
        // DBに保存
        DB::transaction(function () use ($formattedItems) {
            $this->upsertDepartmentsRecords($formattedItems);
            $this->upsertTasksRecords($formattedItems);
        });
    }
}