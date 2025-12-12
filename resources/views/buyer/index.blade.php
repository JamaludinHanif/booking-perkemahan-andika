@extends('layouts.buyer')
@section('style')
@endsection
@section('content')
    <div class="bg-gray-100 p-3 lg:p-4 py-10 lg:px-5">
        <form id="form">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Booking Perkemahan</h2>
                    <p class="mt-1 text-sm/6 text-gray-600"> <span class="text-red-600">*</span> Silahkan isi <b>Formulir</b> dibawah ini </p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="campsite_id" class="block text-sm/6 font-medium text-gray-900">Area Kemah</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="campsite_id" name="campsite_id" required
                                    class="col-start-1 row-start-1 w-full text-sm appearance-none rounded-md bg-white border border-gray-200 py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option class="text-sm" value="" disabled selected>Pilih Area Kemah</option>
                                    @foreach (App\Models\Campsite::all() as $data)
                                        <option class="text-sm" value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true"
                                    class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                    <path
                                        d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" fill-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="customer_name" class="block text-sm/6 font-medium text-gray-900">Nama Lengkap Pelanggan</label>
                            <div class="mt-2">
                                <input id="customer_name" type="text" name="customer_name" required
                                    class="block w-full rounded-md bg-white border border-gray-200 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="customer_email" class="block text-sm/6 font-medium text-gray-900">Email Pelanggan</label>
                            <div class="mt-2">
                                <input id="customer_email" type="email" name="customer_email" required
                                    class="block w-full rounded-md bg-white border border-gray-200 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="customer_phone" class="block text-sm/6 font-medium text-gray-900">Nomor Telepon Pelanggan</label>
                            <div class="mt-2">
                                <input id="customer_phone" type="number" name="customer_phone" required
                                    class="block w-full rounded-md bg-white border border-gray-200 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="start_date" class="block text-sm/6 font-medium text-gray-900">Booking Dari Tanggal</label>
                            <div class="mt-2">
                                <input id="start_date" type="date" name="start_date" required
                                    class="block w-full rounded-md bg-white border border-gray-200 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="end_date" class="block text-sm/6 font-medium text-gray-900">Booking Sampai Tanggal</label>
                            <div class="mt-2">
                                <input id="end_date" type="date" name="end_date" required
                                    class="block w-full rounded-md bg-white border border-gray-200 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="payment_proof" class="block text-sm/6 font-medium text-gray-900">Bukti Pembayaran</label>
                            <div
                                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true"
                                        class="mx-auto size-12 text-gray-300">
                                        <path
                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm/6 text-gray-600">
                                        <label for="payment_proof"
                                            class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                                            <span>Upload foto</span>
                                            <input id="payment_proof" type="file" name="payment_proof" required
                                                class="sr-only" />
                                        </label>
                                        <p class="pl-1">atau geser foto kesini</p>
                                    </div>
                                    <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 5MB</p>
                                    <p class="mt-3 text-sm/6 text-gray-600">Silahkan masukan foto bukti pembayaran.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <img id="previewBukti" class="hidden max-h-48 rounded-lg border" alt="Preview Foto KK">
                            <p id="sizeInfo" class="text-xs text-gray-600 mt-2"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" onclick="resetForm()"
                    class="text-sm/6 font-semibold text-gray-900">Batalkan</button>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Kirim <li class="ml-1 text-sm fas fa-plus-circle"></li></button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(function() {

            const resetForm = () => {
                $form[0].reset()
                clearInvalid();
                $('.previewBukti').hide();
                $('.previewBukti').attr('src', '#')
            }

            const $form = $('#form');
            const $formSubmitBtn = $form.find(`[type="submit"]`);
            const originalBtnText = $formSubmitBtn.text();

            $form.on('submit', function(e) {
                e.preventDefault();
                $('.message-error').html('');

                const formData = new FormData(this);
                $formSubmitBtn.prop('disabled', true).text(
                    'Loading...');

                ajaxSetup();
                $.ajax({
                        url: `{{ route('masyarakat.pengajuan.store') }}`,
                        method: 'post',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false, 
                    })
                    .done(response => {
                        alertTailwind('Berhasil!',
                            response.message, 'success'
                        );
                        $formSubmitBtn.prop('disabled', false).text(
                            originalBtnText);
                        setTimeout(() => {
                            location.href = `{{ route('masyarakat.pengajuan.pengajuanSaya') }}`;
                        }, 1500)
                    })
                    .fail(error => {
                        $formSubmitBtn.prop('disabled', false).text(
                            originalBtnText);
                        if (error.responseJSON) {
                            if (error.responseJSON.errors) {
                                const validationErrors = Object.values(error.responseJSON.errors)
                                    .map(errArray => errArray.join('<br>'))
                                    .join('<br>');
                                alertTailwind('Pesan Validasi!', validationErrors, 'warning');
                            } else {
                                const errorMessage = error.responseJSON.message || error.responseJSON
                                    .details;
                                alertTailwind('Gagal!', errorMessage, 'error');
                            }
                        } else {
                            alertTailwind('Error!', 'An unexpected error occurred. Please try again.',
                                'error');
                        }
                    });
            });

            document.getElementById('payment_proof').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (!file) return;

                const preview = document.getElementById('previewBukti');
                const sizeInfo = document.getElementById('sizeInfo');

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');

                    // hitung ukuran gambar
                    const img = new Image();
                    img.src = e.target.result;

                    img.onload = function() {
                        sizeInfo.textContent = `Ukuran foto: ${img.width} x ${img.height} px`;
                    };
                };

                reader.readAsDataURL(file);
            });

            resetForm();

        })
    </script>
@endsection
