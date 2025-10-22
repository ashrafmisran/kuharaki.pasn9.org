<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukServis extends Model
{
    protected $table = 'produk_servis';

    protected $fillable = [
        'nama',
        'keterangan',
        'harga',
        'kategori_harga',
        'jenis',
        'perniagaan_id',
        'featured_image',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'harga' => 'decimal:2',
    ];

    // Add accessor for deskripsi to use keterangan
    public function getDeskripsiAttribute()
    {
        return $this->keterangan;
    }

    public function perniagaan()
    {
        return $this->belongsTo(Perniagaan::class, 'perniagaan_id');
    }

    // Access industri through perniagaan (many-to-many relationship)
    public function getIndustriAttribute()
    {
        return $this->perniagaan?->industri->first();
    }

    // Image helper methods
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image && \Storage::disk('public')->exists('img/produkservis/' . $this->featured_image)) {
            return asset('storage/img/produkservis/' . $this->featured_image);
        }
        
        // Return default image based on jenis (produk or servis)
        $defaultImage = $this->jenis === 'produk' ? 'default-produk.jpg' : 'default-servis.jpg';
        return asset('storage/img/produkservis/' . $defaultImage);
    }

    public function getImagesUrlsAttribute()
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }

        return collect($this->images)->map(function ($image) {
            if (\Storage::disk('public')->exists('img/produkservis/' . $image)) {
                return asset('storage/img/produkservis/' . $image);
            }
            return null;
        })->filter()->values()->toArray();
    }

    public function hasFeaturedImage()
    {
        return $this->featured_image && \Storage::disk('public')->exists('img/produkservis/' . $this->featured_image);
    }

    public function hasAdditionalImages()
    {
        return $this->images && is_array($this->images) && count($this->images) > 0;
    }

    public function getFirstImageAttribute()
    {
        if ($this->hasFeaturedImage()) {
            return $this->featured_image_url;
        }
        
        if ($this->hasAdditionalImages()) {
            $imageUrls = $this->images_urls;
            return !empty($imageUrls) ? $imageUrls[0] : $this->featured_image_url;
        }
        
        return $this->featured_image_url; // Will return default image
    }
}
