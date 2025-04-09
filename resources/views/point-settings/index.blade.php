<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengaturan Poin Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Point Settings -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Pengaturan Poin</h3>
                    <form id="pointSettingsForm" method="POST" action="{{ route('point-settings.conversion.update') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Point Value Settings -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-blue-600">Nilai Tukar Poin</h4>
                                <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                                    <p class="text-sm text-blue-700 dark:text-blue-200">
                                        Saat ini: 1 poin = Rp {{ number_format($pointSetting->points_to_rupiah ?? 1, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div>
                                    <label for="points_to_rupiah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Nilai Rupiah per Poin
                                    </label>
                                    <input type="number" 
                                           id="points_to_rupiah" 
                                           name="points_to_rupiah" 
                                           value="{{ $pointSetting->points_to_rupiah ?? 1 }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                           min="1">
                                    <p class="mt-1 text-sm text-gray-500">Contoh: Jika diisi 10, maka 1 poin = Rp 10</p>
                                </div>
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Deskripsi Nilai Tukar
                                    </label>
                                    <input type="text" 
                                           id="description" 
                                           name="description"
                                           value="{{ $pointSetting->description }}"
                                           placeholder="Deskripsi nilai tukar poin"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <!-- Point Earning Settings -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-green-600">Perolehan Poin</h4>
                                <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                                    <p class="text-sm text-green-700 dark:text-green-200">
                                        Saat ini: Rp {{ number_format($pointSetting->amount_per_point ?? 10000, 0, ',', '.') }} = 1 poin
                                    </p>
                                </div>
                                <div>
                                    <label for="amount_per_point" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Jumlah Rupiah untuk 1 Poin
                                    </label>
                                    <input type="number" 
                                           id="amount_per_point" 
                                           name="amount_per_point" 
                                           value="{{ $pointSetting->amount_per_point ?? 10000 }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                           min="1"
                                           step="1000">
                                    <p class="mt-1 text-sm text-gray-500">Contoh: Jika diisi 10000, maka setiap Rp 10.000 mendapat 1 poin</p>
                                </div>
                                <div>
                                    <label for="earning_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Deskripsi Perolehan Poin
                                    </label>
                                    <input type="text" 
                                           id="earning_description" 
                                           name="earning_description"
                                           value="{{ $pointSetting->earning_description }}"
                                           placeholder="Deskripsi perolehan poin"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Members Points Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Daftar Poin Member</h3>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama Member</th>
                                    <th scope="col" class="px-6 py-3">Poin Saat Ini</th>
                                    <th scope="col" class="px-6 py-3">Nilai Tukar (Rp)</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $member->nama_pelanggan }}</td>
                                    <td class="px-6 py-4">
                                        <span id="points-display-{{ $member->id }}">{{ $member->points }}</span>
                                        <input type="number" 
                                               id="points-input-{{ $member->id }}" 
                                               value="{{ $member->points }}" 
                                               class="hidden w-24 rounded-md border-gray-300"
                                               min="0">
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($member->points * ($pointSetting->points_to_rupiah ?? 1), 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        <button onclick="editPoints('{{ $member->id }}')"
                                                id="edit-btn-{{ $member->id }}"
                                                class="text-blue-600 hover:text-blue-900">
                                            Edit
                                        </button>
                                        <button onclick="savePoints('{{ $member->id }}')"
                                                id="save-btn-{{ $member->id }}"
                                                class="hidden text-green-600 hover:text-green-900">
                                            Simpan
                                        </button>
                                        <button onclick="cancelEdit('{{ $member->id }}')"
                                                id="cancel-btn-{{ $member->id }}"
                                                class="hidden text-gray-600 hover:text-gray-900">
                                            Batal
                                        </button>
                                        <button onclick="resetPoints('{{ $member->id }}')"
                                                class="text-red-600 hover:text-red-900">
                                            Reset
                                        </button>
                                        <a href="{{ route('point-settings.history', $member->id) }}"
                                           class="text-purple-600 hover:text-purple-900">
                                            Riwayat
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function editPoints(memberId) {
    document.getElementById(`points-display-${memberId}`).classList.add('hidden');
    document.getElementById(`points-input-${memberId}`).classList.remove('hidden');
    document.getElementById(`edit-btn-${memberId}`).classList.add('hidden');
    document.getElementById(`save-btn-${memberId}`).classList.remove('hidden');
    document.getElementById(`cancel-btn-${memberId}`).classList.remove('hidden');
}

function cancelEdit(memberId) {
    document.getElementById(`points-display-${memberId}`).classList.remove('hidden');
    document.getElementById(`points-input-${memberId}`).classList.add('hidden');
    document.getElementById(`edit-btn-${memberId}`).classList.remove('hidden');
    document.getElementById(`save-btn-${memberId}`).classList.add('hidden');
    document.getElementById(`cancel-btn-${memberId}`).classList.add('hidden');
}

function savePoints(memberId) {
    const points = document.getElementById(`points-input-${memberId}`).value;
    
    fetch(`/point-settings/${memberId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ points: points })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`points-display-${memberId}`).textContent = points;
            cancelEdit(memberId);
            Swal.fire({
                title: 'Berhasil!',
                text: data.message,
                icon: 'success'
            });
            location.reload();
        }
    })
    .catch(error => {
        Swal.fire({
            title: 'Error!',
            text: 'Gagal memperbarui poin',
            icon: 'error'
        });
    });
}

function resetPoints(memberId) {
    Swal.fire({
        title: 'Reset Poin?',
        text: "Poin akan direset menjadi 0",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/point-settings/${memberId}/reset`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`points-display-${memberId}`).textContent = '0';
                    document.getElementById(`points-input-${memberId}`).value = '0';
                    Swal.fire(
                        'Berhasil!',
                        data.message,
                        'success'
                    );
                    location.reload();
                }
            })
            .catch(error => {
                Swal.fire(
                    'Error!',
                    'Gagal mereset poin',
                    'error'
                );
            });
        }
    });
}

// Add form validation
document.getElementById('pointSettingsForm').addEventListener('submit', function(e) {
    const pointsToRupiah = parseInt(document.getElementById('points_to_rupiah').value);
    const amountPerPoint = parseFloat(document.getElementById('amount_per_point').value);

    if (!pointsToRupiah || pointsToRupiah < 1) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Nilai tukar poin harus lebih besar dari 0',
            icon: 'error'
        });
        return;
    }

    if (!amountPerPoint || amountPerPoint < 1) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Jumlah rupiah untuk mendapatkan 1 poin harus lebih besar dari 0',
            icon: 'error'
        });
        return;
    }
});
</script>
