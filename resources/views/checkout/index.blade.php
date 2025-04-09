@php
    $pointSetting = App\Models\PointSetting::first();
    $conversionRate = $pointSetting ? $pointSetting->points_to_rupiah : 1;
    $amountPerPoint = $pointSetting ? $pointSetting->amount_per_point : 10000;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <section class="dark:bg-gray-900 p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
                @csrf
                <div class="grid lg:grid-cols-2 gap-10">
                    <!-- Cart Items -->
                    <div class="space-y-6">
                        <p class="text-2xl font-semibold text-center">Daftar Barang</p>
                        <div class="space-y-4 rounded-lg border bg-white p-5">
                            @foreach ($cart as $item)
                                <div class="flex items-center justify-between p-4 border-b">
                                    <div class="flex flex-col flex-grow">
                                        <span class="font-semibold text-gray-800">{{ $item['nama_produk'] }}</span>
                                        <span class="text-gray-500">{{ $item['quantity'] }} x
                                            Rp.{{ number_format($item['harga'], 2, ',', '.') }}</span>
                                        <p class="text-md font-semibold text-gray-900">Subtotal:
                                            Rp.{{ number_format($item['harga'] * $item['quantity'], 2, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <input type="hidden" name="produk[{{ $loop->index }}][produk_id]"
                                    value="{{ $item['produk_id'] }}">
                                <input type="hidden" name="produk[{{ $loop->index }}][quantity]"
                                    value="{{ $item['quantity'] }}">
                                <input type="hidden" name="produk[{{ $loop->index }}][harga]" value="{{ $item['harga'] }}">
                            @endforeach
                        </div>
                    </div>

                    <!-- Customer Details -->
                    <div class="space-y-6">
                        <p class="text-2xl font-semibold text-center">Identitas Pelanggan</p>
                        <div class="space-y-6 bg-white p-6 rounded-lg shadow-md">
                            <!-- Customer Type Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Pelanggan</label>
                                <div class="flex space-x-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis_pelanggan" value="bukan_member" checked
                                            onclick="togglePelangganForm()">
                                        <span class="ml-2">Bukan Member</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis_pelanggan" value="member_baru"
                                            onclick="togglePelangganForm()">
                                        <span class="ml-2">Member Baru</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis_pelanggan" value="member"
                                            onclick="togglePelangganForm()">
                                        <span class="ml-2">Member</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Member Search -->
                            <div id="cari_member">
                                <label for="nama_member" class="block text-sm font-medium text-gray-700">Cari
                                    Member</label>
                                <input type="text" id="nama_member" name="nama_member"
                                    class="w-full rounded-md border-gray-300 px-4 py-3 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan nama pelanggan" oninput="cekMember()">
                                <ul id="daftar_member" class="border rounded-md mt-2 bg-white shadow-md hidden"></ul>
                                <p id="status_member" class="text-sm mt-2"></p>
                            </div>

                            <!-- Customer Form -->
                            <div id="form_pelanggan" class="hidden">
                                <div>
                                    <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama
                                        Pelanggan</label>
                                    <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                                        class="w-full rounded-md border-gray-300 px-4 py-3 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Masukkan nama Anda">
                                </div>
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="3"
                                        class="w-full rounded-md border-gray-300 px-4 py-3 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                <div>
                                    <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor
                                        Telepon</label>
                                    <input type="text" id="nomor_telepon" name="nomor_telepon"
                                        class="w-full rounded-md border-gray-300 px-4 py-3 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="08xxxxxxxxxx"
                                        maxlength="13"
                                        pattern="[0-9]*"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 13);">
                                </div>
                            </div>

                            <!-- Points Section -->
                            <div id="points_wrapper" class="hidden">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Poin Member</label>
                                    <div class="mt-2">
                                        <p id="available_points" class="text-sm text-gray-600">Poin tersedia: 0</p>
                                        <p id="points_value" class="text-sm text-blue-600 mt-1"></p>
                                        <div class="bg-gray-50 p-3 rounded-md mt-2">
                                            <p class="text-xs text-gray-600">Informasi Poin:</p>
                                            <ul class="list-disc list-inside text-xs text-gray-600 mt-1">
                                                <li>1 poin = Rp {{ number_format($conversionRate, 0, ',', '.') }} diskon</li>
                                                <li>Setiap pembelian Rp {{ number_format($amountPerPoint, 0, ',', '.') }} mendapat 1 poin</li>
                                            </ul>
                                        </div>
                                        <label class="flex items-center mt-3">
                                            <input type="checkbox" id="use_points" name="use_points" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-600">Gunakan poin untuk diskon</span>
                                        </label>
                                        <div id="points_input_wrapper" class="mt-2 hidden">
                                            <input type="number" id="points_to_use" name="points_to_use" 
                                                class="w-full rounded-md border-gray-300 px-4 py-2 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Masukkan jumlah poin yang ingin digunakan" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Section -->
                            <div id="nominal_bayar_wrapper">
                                <label for="nominal_bayar" class="block text-sm font-medium text-gray-700">Nominal
                                    Bayar</label>
                                <input type="number" id="nominal_bayar" name="nominal_bayar"
                                    class="w-full rounded-md border-gray-300 px-4 py-3 text-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan jumlah uang yang dibayarkan">
                            </div>

                            <!-- Total Section -->
                            <div class="space-y-2 mt-4">
                                <div class="flex justify-between">
                                    <p class="text-xl font-semibold">Total Harga</p>
                                    <p class="text-xl font-bold text-gray-900">
                                        Rp.{{ number_format(collect($cart)->sum(fn($item) => $item['harga'] * $item['quantity']), 2, ',', '.') }}
                                    </p>
                                </div>
                                <div id="points_discount_display" class="flex justify-between hidden">
                                    <p class="text-md font-semibold text-green-600">Diskon Poin</p>
                                    <p class="text-md font-semibold text-green-600">-<span id="points_discount">0</span></p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="text-xl font-semibold">Total Setelah Diskon</p>
                                    <p class="text-xl font-bold text-gray-900" id="final_total">
                                        Rp.{{ number_format(collect($cart)->sum(fn($item) => $item['harga'] * $item['quantity']), 2, ',', '.') }}
                                    </p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="text-md font semibold">Kembalian</p>
                                    <p class="text-md font-semibold"><span id="kembalian">0</span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="w-full md:w-auto bg-blue-600 text-white rounded-md py-2 px-3 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const elements = {
            nominalBayarInput: document.getElementById('nominal_bayar'),
            kembalianText: document.getElementById('kembalian'),
            jenisPelangganRadios: document.querySelectorAll('input[name="jenis_pelanggan"]'),
            namaPelangganInput: document.getElementById('nama_pelanggan'),
            alamatInput: document.getElementById('alamat'),
            nomorTeleponInput: document.getElementById('nomor_telepon'),
            statusMember: document.getElementById('status_member'),
            namaMemberInput: document.getElementById('nama_member'),
            daftarMember: document.getElementById('daftar_member'),
            formPelanggan: document.getElementById('form_pelanggan'),
            cariMember: document.getElementById('cari_member'),
            nominalBayarWrapper: document.getElementById('nominal_bayar_wrapper'),
            checkoutForm: document.getElementById('checkoutForm')
        };

        const formatCurrency = (amount) => {
            return 'Rp.' + new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(amount);
        };

        let memberPoints = 0;
        const originalTotal = parseFloat("{{ collect($cart)->sum(fn($item) => $item['harga'] * $item['quantity']) }}");
        let currentTotal = originalTotal;
        const conversionRate = {{ $conversionRate }};

        const hitungKembalian = () => {
            let nominalBayar = elements.nominalBayarInput.value.trim();

            if (!/^\d+(\.\d+)?$/.test(nominalBayar)) {
                elements.kembalianText.textContent = formatCurrency(0);
                return;
            }

            nominalBayar = parseFloat(nominalBayar);
            const kembalian = Math.max(nominalBayar - currentTotal, 0);

            elements.kembalianText.textContent = formatCurrency(kembalian);
        };

        const updatePointsDiscount = () => {
            const pointsToUse = parseInt(document.getElementById('points_to_use').value) || 0;
            const pointsDiscount = Math.min(pointsToUse, memberPoints) * conversionRate;
            
            document.getElementById('points_discount').textContent = formatCurrency(pointsDiscount);
            currentTotal = originalTotal - pointsDiscount;
            document.getElementById('final_total').textContent = formatCurrency(currentTotal);
            
            hitungKembalian();
        };

        // Add event listeners for points functionality
        document.getElementById('use_points')?.addEventListener('change', function() {
            const pointsInputWrapper = document.getElementById('points_input_wrapper');
            const pointsDiscountDisplay = document.getElementById('points_discount_display');
            pointsInputWrapper.classList.toggle('hidden', !this.checked);
            pointsDiscountDisplay.classList.toggle('hidden', !this.checked);
            if (!this.checked) {
                document.getElementById('points_to_use').value = '';
                currentTotal = originalTotal;
                document.getElementById('final_total').textContent = formatCurrency(originalTotal);
                document.getElementById('points_discount').textContent = formatCurrency(0);
                hitungKembalian();
            }
        });

        document.getElementById('points_to_use')?.addEventListener('input', function() {
            const maxPoints = memberPoints;
            let value = parseInt(this.value) || 0;
            if (value > maxPoints) {
                value = maxPoints;
                this.value = maxPoints;
            }
            updatePointsDiscount();
        });

        const togglePelangganForm = () => {
            const jenisPelanggan = document.querySelector('input[name="jenis_pelanggan"]:checked').value;

            elements.cariMember.classList.toggle('hidden', jenisPelanggan !== 'member');
            elements.formPelanggan.classList.toggle('hidden', jenisPelanggan !== 'member_baru');
            elements.nominalBayarWrapper.classList.toggle('hidden', false);

            if (jenisPelanggan === 'member_baru') {
                resetForm();
                setFormReadOnly(false);
            }
        };

        const toggleFormVisibility = (show) => {
            elements.formPelanggan.classList.toggle('hidden', !show);
        };

        const setFormReadOnly = (isReadOnly) => {
            [elements.namaPelangganInput, elements.alamatInput, elements.nomorTeleponInput].forEach(input => {
                input.toggleAttribute('readonly', isReadOnly);
            });
        };

        const resetForm = () => {
            elements.namaPelangganInput.value = "";
            elements.alamatInput.value = "";
            elements.nomorTeleponInput.value = "";
        };

        const cekMember = () => {
            const namaPelanggan = elements.namaMemberInput.value.trim();

            if (namaPelanggan.length < 3) {
                elements.daftarMember.classList.add('hidden');
                elements.daftarMember.innerHTML = "";
                toggleFormVisibility(false);
                return;
            }

            fetch(`${window.location.pathname.split('/checkout')[0]}/cek-member?nama_pelanggan=${encodeURIComponent(namaPelanggan)}`)
                .then(response => response.json())
                .then(data => {
                    elements.daftarMember.innerHTML = "";

                    if (data.length > 0) {
                        elements.daftarMember.classList.remove('hidden');
                        data.forEach(member => {
                            const listItem = document.createElement('li');
                            listItem.textContent = member.nama;
                            listItem.classList.add('cursor-pointer', 'p-2', 'hover:bg-gray-200', 'border-b');

                            listItem.addEventListener('click', () => {
                                elements.namaMemberInput.value = member.nama;
                                elements.daftarMember.classList.add('hidden');
                                elements.statusMember.textContent = "Member ditemukan: " + member.nama;

                                elements.namaPelangganInput.value = member.nama;
                                elements.alamatInput.value = member.alamat;
                                elements.nomorTeleponInput.value = member.nomor_telepon;

                                // Update points information
                                memberPoints = member.points || 0;
                                document.getElementById('available_points').textContent = `Poin tersedia: ${memberPoints}`;
                                document.getElementById('points_value').textContent = `Senilai: Rp ${formatCurrency(memberPoints * conversionRate)}`;
                                document.getElementById('points_wrapper').classList.remove('hidden');
                                document.getElementById('points_to_use').max = memberPoints;

                                toggleFormVisibility(true);
                                setFormReadOnly(true);
                            });

                            elements.daftarMember.appendChild(listItem);
                        });
                    } else {
                        elements.daftarMember.classList.add('hidden');
                        elements.statusMember.textContent = "Member tidak ditemukan.";
                        toggleFormVisibility(false);
                    }
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mencari member.',
                        icon: 'error',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                    elements.daftarMember.classList.add('hidden');
                    toggleFormVisibility(false);
                });
        };

        // Handle form submission
        elements.checkoutForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            try {
                const formData = new FormData(this);
                
                // Log form data for debugging
                console.log('Form Data:');
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                // Validate required fields
                const jenisPelanggan = formData.get('jenis_pelanggan');
                const nominalBayar = formData.get('nominal_bayar');

                if (!nominalBayar) {
                    throw new Error('Nominal bayar harus diisi!');
                }

                if (jenisPelanggan === 'member_baru') {
                    if (!formData.get('nama_pelanggan')) throw new Error('Nama pelanggan harus diisi!');
                    if (!formData.get('alamat')) throw new Error('Alamat harus diisi!');
                    if (!formData.get('nomor_telepon')) throw new Error('Nomor telepon harus diisi!');
                }

                if (jenisPelanggan === 'member' && !formData.get('nama_pelanggan')) {
                    throw new Error('Nama member harus diisi!');
                }

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    credentials: 'same-origin'
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => Promise.reject(data));
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = data.redirect;
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    let errorMessage = '';
                    if (error.errors) {
                        Object.values(error.errors).forEach(messages => {
                            errorMessage += messages.join('\n') + '\n';
                        });
                    } else if (error.message) {
                        errorMessage = error.message;
                    } else {
                        errorMessage = 'Terjadi kesalahan saat memproses transaksi.';
                    }
                    
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage.trim(),
                        icon: 'error',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                });
            } catch (error) {
                Swal.fire({
                    title: 'Error!',
                    text: error.message,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            }
        });

        elements.namaMemberInput.addEventListener('input', cekMember);
        elements.nominalBayarInput.addEventListener('input', hitungKembalian);
        elements.jenisPelangganRadios.forEach(radio => radio.addEventListener('change', togglePelangganForm));

        togglePelangganForm();

        // Show error messages from Laravel validation if any
        @if ($errors->any())
            Swal.fire({
                title: 'Error!',
                html: '{!! implode("<br>", $errors->all()) !!}',
                icon: 'error',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>
