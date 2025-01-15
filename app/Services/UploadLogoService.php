<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class UploadLogoService
{
    public function upload(array|UploadedFile|null $file, int|null $id)
    {
        if(!empty($file)) {
            $file->store('public/logos');

            $this->delete($id);

            return $file->hashName();
        }

        return null;
    }

    public function delete(int|null $id): void
    {
        $company = (new CompanyRepository())->one($id);
        $logo = data_get($company, 'logo');
        $fullPathToLogo = storage_path('app/public/logos/' . data_get($company, 'logo'));

        if (!empty($logo) && File::exists($fullPathToLogo)) {
            File::delete($fullPathToLogo);
        }
    }
}
