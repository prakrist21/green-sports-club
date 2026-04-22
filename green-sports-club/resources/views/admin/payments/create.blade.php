<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Payment
            </h2>
            <a href="{{ route('admin.payments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.payments.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Student</label>
                        <select name="student_id" id="student_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="">Select Student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    data-sports="{{ json_encode($student->sports->map(fn($s) => ['id' => $s->id, 'name' => $s->name])) }}"
                                    data-coaches="{{ json_encode($student->sports->map(fn($s) => ['sport_id' => $s->id, 'coaches' => $s->coaches->map(fn($c) => ['id' => $c->id, 'name' => $c->user->name])])) }}"
                                    {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Sport</label>
                        <select name="sport_id" id="sport_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="">Select Student First</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Coach</label>
                        <select name="coach_id" id="coach_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="">Select Sport First</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Fee</label>
                        <select name="fee_id" id="fee_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="">Select Sport First</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Amount Paid</label>
                        <input type="number" step="0.01" name="amount_paid" id="amount_paid" value="{{ old('amount_paid') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                            placeholder="0.00">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Paid At</label>
                        <input type="date" name="paid_at" value="{{ old('paid_at', date('Y-m-d')) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">
                        Save Payment
                    </button>
                </form>

            </div>
        </div>
    </div>

    {{-- Pass fees data to JS --}}
    @php
        $feesData = $fees->map(fn($f) => [
            'id' => $f->id,
            'sport_id' => $f->sport_id,
            'amount' => $f->amount,
            'period' => $f->period,
            'sport_name' => $f->sport->name,
        ]);
    @endphp

    <script>
        const feesData = @json($feesData);

        const studentSelect = document.getElementById('student_id');
        const sportSelect = document.getElementById('sport_id');
        const coachSelect = document.getElementById('coach_id');
        const feeSelect = document.getElementById('fee_id');
        const amountInput = document.getElementById('amount_paid');

        studentSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            const sports = JSON.parse(selected.dataset.sports || '[]');
            const coachesData = JSON.parse(selected.dataset.coaches || '[]');

            // Reset dropdowns
            sportSelect.innerHTML = '<option value="">Select Sport</option>';
            coachSelect.innerHTML = '<option value="">Select Sport First</option>';
            feeSelect.innerHTML = '<option value="">Select Sport First</option>';
            amountInput.value = '';

            sports.forEach(sport => {
                sportSelect.innerHTML += `<option value="${sport.id}">${sport.name}</option>`;
            });

            sportSelect._coachesData = coachesData;
        });

        sportSelect.addEventListener('change', function () {
            const sportId = parseInt(this.value);
            const coachesData = this._coachesData || [];

            // Update coaches
            coachSelect.innerHTML = '<option value="">Select Coach</option>';
            const sportCoaches = coachesData.find(c => c.sport_id === sportId);
            if (sportCoaches && sportCoaches.coaches.length > 0) {
                sportCoaches.coaches.forEach(coach => {
                    coachSelect.innerHTML += `<option value="${coach.id}">${coach.name}</option>`;
                });
            } else {
                coachSelect.innerHTML = '<option value="">No coach assigned</option>';
            }

            // Update fees
            feeSelect.innerHTML = '<option value="">Select Fee</option>';
            const matchingFees = feesData.filter(f => f.sport_id === sportId);
            matchingFees.forEach(fee => {
                feeSelect.innerHTML += `<option value="${fee.id}" data-amount="${fee.amount}">${fee.sport_name} - Rs. ${fee.amount} (${fee.period})</option>`;
            });

            amountInput.value = '';
        });

        feeSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            const amount = selected.dataset.amount;
            if (amount) amountInput.value = amount;
        });
    </script>
</x-app-layout>