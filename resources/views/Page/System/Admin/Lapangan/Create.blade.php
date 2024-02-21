 @extends('Layouts.dashboard')

@section('title')
Dashboard | Lapangan
@endsection
@section('content')
<div class="bg-white text-white w-full rounded-lg p-8 shadow-lg shadow-gray-600">

    <div class="flex justify-between items-center">
        <span class="text-xl font-semibold text-black">Lapangan Create</span>
    </div>
    <div class="h-[2px] w-full bg-gray-200 my-4"></div>
    <div class="flex flex-col">
        <form action="{{route('lapangan.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="flex flex-col gap-x-2">
                <div class="flex flex-col w-full">
                    <label for="name" class="text-lg font-semibold text-black">Lapangan Name :</label>
                    <input id="name" type="text" name="name" class= "bg-white text-black p-2 border-[2px] border-gray-500 rounded-md" autocomplete="off" required>
                    @if (isset($error) && $error === true && isset($message['name']))
                        <span class="text-red-600">{{$message['name'][0]}}</span>
                    @endif
                </div>
                <div class="flex flex-col w-full">
                    <label for="amountInput" class="text-lg font-semibold text-black">Price :</label>
                    <input class="p-2 border-[2px] border-gray-500 bg-white text-black rounded-md" type="text" name="price" id="amountInput" oninput="formatAmount()" placeholder="10" autocomplete="off" required>
                    @if (isset($error) && $error === true && isset($message['price']))
                        <span class="text-red-600">{{$message['price'][0]}}</span>
                    @endif
                </div>
                <div class="flex flex-col w-full">
                    <label for="image" class="text-lg font-semibold text-black">Image Room :</label>
                    <input id="image" type="file" name="image" class= "bg-white text-black p-2 border-[2px] border-gray-500 rounded-md" autocomplete="off" required>
                    @if (isset($error) && $error === true && isset($message['image']))
                        <span class="text-red-600">{{$message['image'][0]}}</span>
                    @endif
                </div>
                <div class="flex flex-col w-full">
                    <label for="description" class="text-lg font-semibold text-black">Description :</label>
                    <textarea class="p-2 border-[2px] border-gray-500 bg-white text-black rounded-md"  type="number" name="description" id="description" placeholder="insert the description here"></textarea>
                    @if (isset($error) && $error === true && isset($message['description']))
                        <span class="text-red-600">{{$message['description'][0]}}</span>
                    @endif
                </div>
            </div>
            <div class="mt-2 flex justify-end gap-x-1">
                <button onclick="cleanAndSubmitForm()" class="px-5 py-2 bg-blue-700 text-lg font-semibold text-white rounded-lg">Create</button>
                <a href="{{route('lapangan.index')}}" class="px-5 py-2 bg-red-700 text-lg font-semibold text-white rounded-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>

    // * Clean Price
    function cleanAndSubmitForm() {
        var amountInput = document.getElementById('amountInput');

    // Hapus karakter "Rp " dan pemisah ribuan (titik)
        var cleanedValue = amountInput.value.replace(/[^\d]/g, '');

        // Konversi ke tipe data angka (number)
        var numericValue = parseFloat(cleanedValue);

        // Setel nilai input dengan format tanpa karakter "Rp" dan pemisah ribuan
        amountInput.value = numericValue.toLocaleString('id-ID', { minimumFractionDigits: 0 });

        document.getElementById('myForm').submit();
    }

     // Fungsi untuk mengatur nilai awal saat halaman dimuat
     function initializeAmount() {
        var amountInput = document.getElementById('amountInput');
        // Cek jika nilai input kosong atau tidak valid
        if (!amountInput.value.trim() || isNaN(parseFloat(amountInput.value))) {
            amountInput.value = 'Rp 0';
        } else {
            // Jika nilai input valid, lakukan pemformatan
            formatAmount();
        }
    }

    // Fungsi untuk memformat nilai saat pengguna memasukkan atau mengubah nilai
    function formatAmount() {
        var amountInput = document.getElementById('amountInput');
        var value = amountInput.value.trim();
        var numericValue = parseFloat(value.replace(/[^\d]/g, ''));
        if (!isNaN(numericValue)) {
            amountInput.value = 'Rp ' + numericValue.toLocaleString('id-ID');
        } else {
            amountInput.value = 'Rp 0';
        }
    }

    // Panggil fungsi initializeAmount saat halaman dimuat
    window.onload = initializeAmount;
</script>

@endsection
