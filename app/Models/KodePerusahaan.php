<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodePerusahaan extends Model
{
    use HasFactory, SpatialTrait;

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
        "tanggal_pengajuan" => "date",
    ];

    protected $spatialFields = [
        'coordinates'
    ];

    protected static function booted()
    {
        static::created(function ($kode) {
            try {
                $coordinates = \explode(' ', str_replace(',', ' ', trim(request()->coordinates)));
                // \Log::debug($coordinates);
                $kode->coordinates = new Point(trim($coordinates[0]), trim($coordinates[1]));
                $kode->saveQuietly();
            } catch (\Exception $e) {
                \Log::debug($e->getMessage());
            }
        });

        static::updated(function ($kode) {
            try {
                $coordinates = \explode(' ', str_replace(',', ' ', trim(request()->coordinates)));
                // \Log::debug($coordinates);
                $kode->coordinates = new Point(trim($coordinates[0]), trim($coordinates[1]));
                $kode->saveQuietly();
            } catch (\Exception $e) {
                \Log::debug($e->getMessage());
            }
        });
    }

    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }
}
