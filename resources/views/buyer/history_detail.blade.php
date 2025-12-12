@extends('layouts.buyer')
@section('content')
    <div class="bg-gray-100 p-3 lg:p-4 py-10 lg:px-5">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Detail Pengajuan Surat</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    {{-- Jenis Surat --}}
                    <div class="sm:col-span-3">
                        <label for="surat_type_id" class="block text-sm/6 font-medium text-gray-900">Jenis Surat</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="surat_type_id" name="surat_type_id" disabled
                                class="col-start-1 row-start-1 w-full text-sm appearance-none rounded-md bg-white text-sm border border-gray-200 py-1.5 pr-8 pl-3">
                                <option value="" disabled>Pilih Jenis Surat</option>
                                @foreach (App\Models\SuratTypes::all() as $data)
                                    <option value="{{ $data->id }}" @selected($detail->surat_type_id == $data->id)>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Nama Lengkap --}}
                    <div class="sm:col-span-3">
                        <label for="nama_lengkap" class="block text-sm/6 font-medium text-gray-900">Nama Lengkap</label>
                        <div class="mt-2">
                            <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ $detail->nama_lengkap }}"
                                readonly
                                class="block w-full rounded-md bg-white text-sm border border-gray-200 px-3 py-1.5 text-base" />
                        </div>
                    </div>

                    {{-- NIK --}}
                    <div class="sm:col-span-3">
                        <label for="nik" class="block text-sm/6 font-medium text-gray-900">NIK</label>
                        <div class="mt-2">
                            <input id="nik" type="text" name="nik" value="{{ $detail->nik }}" readonly
                                class="block w-full rounded-md bg-white text-sm border border-gray-200 px-3 py-1.5" />
                        </div>
                    </div>

                    {{-- No KK --}}
                    <div class="sm:col-span-3">
                        <label for="no_kk" class="block text-sm/6 font-medium text-gray-900">Nomor KK</label>
                        <div class="mt-2">
                            <input id="no_kk" type="text" name="no_kk" value="{{ $detail->no_kk }}" readonly
                                class="block w-full rounded-md bg-white text-sm border border-gray-200 px-3 py-1.5" />
                        </div>
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="sm:col-span-3">
                        <label for="tempat_lahir" class="block text-sm/6 font-medium text-gray-900">Tempat Lahir</label>
                        <div class="mt-2">
                            <input id="tempat_lahir" type="text" name="tempat_lahir" value="{{ $detail->tempat_lahir }}"
                                readonly
                                class="block w-full rounded-md bg-white text-sm border border-gray-200 px-3 py-1.5" />
                        </div>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="sm:col-span-3">
                        <label for="tanggal_lahir" class="block text-sm/6 font-medium text-gray-900">Tanggal Lahir</label>
                        <div class="mt-2">
                            <input id="tanggal_lahir" type="date" name="tanggal_lahir"
                                value="{{ $detail->tanggal_lahir }}" readonly
                                class="block w-full rounded-md bg-white text-sm border border-gray-200 px-3 py-1.5" />
                        </div>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="sm:col-span-3">
                        <label for="jenis_kelamin" class="block text-sm/6 font-medium text-gray-900">Jenis Kelamin</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="jenis_kelamin" name="jenis_kelamin" disabled
                                class="col-start-1 row-start-1 w-full rounded-md bg-white text-sm border border-gray-200 py-1.5 pl-3">
                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki Laki" @selected($detail->jenis_kelamin == 'Laki Laki')>Laki Laki</option>
                                <option value="Perempuan" @selected($detail->jenis_kelamin == 'Perempuan')>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    {{-- Agama --}}
                    <div class="sm:col-span-3">
                        <label for="agama" class="block text-sm/6 font-medium text-gray-900">Agama</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="agama" name="agama" disabled
                                class="col-start-1 row-start-1 w-full rounded-md bg-white text-sm border border-gray-200 py-1.5 pl-3">
                                <option value="" disabled>Pilih Agama</option>
                                <option value="Islam" @selected($detail->agama == 'Islam')>Islam</option>
                                <option value="Kristen" @selected($detail->agama == 'Kristen')>Kristen</option>
                                <option value="Katholik" @selected($detail->agama == 'Katholik')>Katholik</option>
                                <option value="Buddha" @selected($detail->agama == 'Buddha')>Buddha</option>
                                <option value="Hindu" @selected($detail->agama == 'Hindu')>Hindu</option>
                                <option value="Konghucu" @selected($detail->agama == 'Konghucu')>Konghucu</option>
                            </select>
                        </div>
                    </div>

                    {{-- Status Perkawinan --}}
                    <div class="sm:col-span-3">
                        <label for="status_perkawinan" class="block text-sm/6 font-medium text-gray-900">Status
                            Perkawinan</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="status_perkawinan" name="status_perkawinan" disabled
                                class="col-start-1 row-start-1 w-full rounded-md bg-white text-sm border border-gray-200 py-1.5 pl-3">
                                <option value="" disabled>Pilih Status</option>
                                <option value="Menikah" @selected($detail->status_perkawinan == 'Menikah')>Menikah</option>
                                <option value="Belum Menikah" @selected($detail->status_perkawinan == 'Belum Menikah')>Belum Menikah</option>
                                <option value="Cerai Hidup" @selected($detail->status_perkawinan == 'Cerai Hidup')>Cerai Hidup</option>
                                <option value="Cerai Mati" @selected($detail->status_perkawinan == 'Cerai Mati')>Cerai Mati</option>
                            </select>
                        </div>
                    </div>

                    {{-- Pekerjaan --}}
                    <div class="sm:col-span-3">
                        <label for="pekerjaan" class="block text-sm/6 font-medium text-gray-900">Pekerjaan</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="pekerjaan" name="pekerjaan" disabled
                                class="col-start-1 row-start-1 w-full rounded-md bg-white text-sm border border-gray-200 py-1.5 pl-3">
                                <option value="" disabled>Pilih Pekerjaan</option>
                                <option value="Petani" @selected($detail->pekerjaan == 'Petani')>Petani</option>
                                <option value="Pegawai Swasta" @selected($detail->pekerjaan == 'Pegawai Swasta')>Pegawai Swasta</option>
                                <option value="Pelajar" @selected($detail->pekerjaan == 'Pelajar')>Pelajar</option>
                                <option value="Ibu Rumah Tangga" @selected($detail->pekerjaan == 'Ibu Rumah Tangga')>Ibu Rumah Tangga</option>
                                <option value="Guru" @selected($detail->pekerjaan == 'Guru')>Guru</option>
                                <option value="Wirausaha" @selected($detail->pekerjaan == 'Wirausaha')>Wirausaha</option>
                            </select>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="col-span-full">
                        <label for="alamat" class="block text-sm/6 font-medium text-gray-900">Alamat Lengkap</label>
                        <div class="mt-2">
                            <textarea id="alamat" name="alamat" rows="3" readonly
                                class="block w-full rounded-md bg-white text-sm border border-gray-200 px-3 py-1.5">{{ $detail->alamat }}</textarea>
                        </div>
                    </div>

                    {{-- File KK (Preview) --}}
                    <div class="col-span-full">
                        <label class="block text-sm/6 font-medium text-gray-900">Lampiran Foto KK</label>
                        <div class="mt-2">
                            <img src="{{ $detail->keteranganLink() }}" class="max-h-48 rounded-lg border" />
                        </div>
                    </div>

                    {{-- Keperluan --}}
                    <div class="col-span-full">
                        <label for="keperluan" class="block text-sm/6 font-medium text-gray-900">Keperluan
                            Pengajuan</label>
                        <div class="mt-2">
                            <textarea id="keperluan" name="keperluan" rows="3" readonly
                                class="block w-full rounded-md bg-white text-sm border border-gray-200 px-3 py-1.5">{{ $detail->keperluan }}</textarea>
                        </div>
                    </div>

                </div>
            </div>

            @if ($detail->status == '2')
                <div class="mt-10 w-full">
                    <a href="{{ route('surat.download', $detail->id) }}"
                        class="block w-full text-center rounded-md bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Download Surat
                        <i class="ml-1 fas fa-download"></i>
                    </a>
                </div>
            @endif

        </div>
    </div>
@endsection
