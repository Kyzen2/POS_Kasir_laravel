<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pengguna as ModelPengguna;
use Livewire\WithPagination;

class Pengguna extends Component
{
    use WithPagination;
    public $pilihanMenu = "lihat";
    public $nama;
    public $nis;
    public $jabatan;
    public $penggunaTerpilih;
    
    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function render()
    {
        return view('livewire.pengguna', [
            'penggunas' => ModelPengguna::all(), 
        ]);
    }
    public function pilihEdit($id)
    {
        $this->penggunaTerpilih = ModelPengguna::findOrFail($id);
        $this->nama = $this->penggunaTerpilih->nama;
        $this->nis = $this->penggunaTerpilih->nis;
        $this->jabatan = $this->penggunaTerpilih->jabatan;
        $this->pilihanMenu = "edit";
    }
    public function simpanEdit()
    {
        $this->validate([
            'nama' => 'required',
            'nis' => ['required','unique:pengguna,nis,' . $this->penggunaTerpilih->id],
            'jabatan' => 'required',
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'nis.required' => 'NIS tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
        ]);
        $simpan = $this->penggunaTerpilih;
        $simpan->nama = $this->nama;
        $simpan->nis = $this->nis;
        $simpan->jabatan = $this->jabatan;
        $simpan->save();

        $this->reset(['nama', 'nis', 'jabatan',]);
        $this->pilihanMenu = "lihat";
        session()->flash('pesan', 'Data berhasil disimpan');
    }

    public function pilihHapus($id)
    {
        $this->penggunaTerpilih = ModelPengguna::findOrFail($id);
        $this->pilihanMenu = "hapus";
    }
    public function batal()
    {
        $this->reset();
    }
    public function hapus()
    {
        $this->penggunaTerpilih->delete();
        $this->pilihanMenu = "lihat";
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'nis' => 'required',
            'jabatan' => 'required',
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'nis.required' => 'NIS tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
        ]);

        $simpan = new ModelPengguna();
        $simpan->nama = $this->nama;
        $simpan->nis = $this->nis;
        $simpan->jabatan = $this->jabatan;
        $simpan->save();

        $this->reset(['nama', 'nis', 'jabatan']);
        $this->pilihanMenu = "lihat";
        session()->flash('pesan', 'Data berhasil disimpan');
    }
    
}
