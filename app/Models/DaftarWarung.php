<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Laravolt\Indonesia\Models\City;

class DaftarWarung extends Model
{
    use Filterable, HasFactory, SpatialTrait;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = ["id"];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "tanggal_lahir" => "date",
    ];

    protected $spatialFields = [
        'coordinates'
    ];

    protected static function booted()
    {
        if (!empty(auth()->user())) {
        static::addGlobalScope('warung_by_cabang', function (Builder $builder) {
            $builder->where('cabang_unit', '=', auth()->user()->cabang_unit)
            ->where('sub_branch_unit', '=', auth()->user()->sub_branch_unit);
        });
    }else{
        
    }
        static::creating(function ($warung) {

            $warung->cabang_unit = auth()->user()->cabang_unit;
            $warung->sub_branch_unit = auth()->user()->sub_branch_unit;
        });
        static::created(function ($warung) {
            try {
                $coordinates = \explode(' ', str_replace(',', ' ', trim(request()->coordinates)));
                // \Log::debug($coordinates);
                $warung->coordinates = new Point(trim($coordinates[0]), trim($coordinates[1]));
                $warung->saveQuietly();
            } catch (\Exception $e) {
                Log::debug($e->getMessage());
            }
        });

        static::updated(function ($warung) {
            try {
                if ($warung->wasChanged('coordinates')) {
                    $coordinates = \explode(' ', str_replace(',', ' ', trim($warung->coordinates)));
                    $warung->coordinates = new Point(trim($coordinates[0]), trim($coordinates[1]));
                    $warung->saveQuietly();
                }
            } catch (\Exception $e) {
                Log::debug($e->getMessage());
            }
        });
    }


    public function getStatusAktifTextAttribute()
    {
        switch ($this->attributes['status_aktif']) {
            case '0':
                $status_aktif = 'Tidak Aktif';
                break;

            case '1':
                $status_aktif = 'Aktif';
                break;
            default:
                $status_aktif = '-';
                break;
        }

        return $status_aktif;
    }
    public function daftarpembiayaan()
    {
        return $this->hasOne(DaftarPembiayaan::class,'id_anggota','id_anggota');
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function regencies()
    {
        return $this->hasOne(Regency::class,'id','kota');
    }

    public function districts()
    {
        return $this->hasOne(District::class,'id','kecamatan');
    }

    public function villages()
    {
        return $this->hasOne(Village::class,'id','desa');
    }

    public function province()
    {
        return$this->hasOne(Province::class,'id','provinsi');
    }
    public function kotas()
    {
        return$this->hasOne(City::class,'id','provinsi');
    }
    public function statusbangunan()
    {
        return $this->hasOne(KodeStatusBangunan::class,'status_bangunan','id');
    }
    public function bidangusaha()
    {
        return $this->hasOne(KodeBidangUsaha::class,'id','bidang_usaha');
    }
    public function status_keanggotaans()
    {
        return $this->hasOne(StatusKeanggotaan::class,'id','id_status_keanggotaan');
    }
    public function scopeNonactive($query)
    {
        return $query->where('id_status_keanggotaan','=','0');
    }
    public function statusbangunans()
    {
        return $this->hasOne(KodeStatusBangunan::class,'id','status_bangunan');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'kota');
    }

    public function getCoordinatesAttribute()
    {
        if (empty($this->attributes['coordinates'])) {
            $client = new \GuzzleHttp\Client();

            $geocoder = new \Spatie\Geocoder\Geocoder($client);

            $geocoder->setApiKey(config('geocoder.key'));

            $geocoder->setCountry(config('geocoder.country', 'ID'));

            $alamat = [
                $this->villages->name  ?? \null,
                $this->city->name      ?? \null,
                $this->districts->name ?? \null,
                $this->province->name  ?? \null,
            ];

            if ($this->attributes['tempat_sama']) {
                $alamat = [
                    $this->anggota->villages->name  ?? \null,
                    $this->anggota->city->name      ?? \null,
                    $this->anggota->districts->name ?? \null,
                    $this->anggota->province->name  ?? \null,
                ];
            }

            try {
                $results = $geocoder->getCoordinatesForAddress(\implode(', ', \array_filter($alamat)));

                if (!empty($results)) {
                    $this->coordinates = new Point($results['lat'], $results['lng']);
                    $this->saveQuietly();
                }

                return $this->coordinates;
            } catch (\Exception $e) {
                Log::debug($e);
            }
        }
        return $this->attributes['coordinates'];
    }
}
