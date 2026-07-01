<div class="bg-white border rounded-2xl shadow-sm overflow-hidden">
    <x-flash-message/>
    <div class="flex items-center justify-between p-6 border-b">

        <div>

            <h1 class="text-2xl font-bold text-gray-800">
                Tax Brackets (Semi-Monthly)
            </h1>

            <p class="text-sm text-gray-500">
                Payroll withholding tax configuration
            </p>

        </div>

        <div class="flex gap-2">

            @if($isEditing)

                <button
                    wire:click="addBracket"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl">

                    Add Bracket

                </button>

                <button
                    wire:click="save"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">

                    Save Changes

                </button>

            @endif

            <button
                wire:click="toggleEdit"
                class="px-4 py-2 border rounded-xl hover:bg-gray-50">

                {{ $isEditing ? 'Cancel' : 'Edit Tax Table' }}

            </button>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-4 text-left">
                        Min Amount
                    </th>

                    <th class="px-6 py-4 text-left">
                        Max Amount
                    </th>

                    <th class="px-6 py-4 text-left">
                        Base Tax
                    </th>

                    <th class="px-6 py-4 text-left">
                        Percentage
                    </th>

                    @if($isEditing)
                        <th class="px-6 py-4 text-center">
                            Action
                        </th>
                    @endif

                </tr>

            </thead>

            <tbody>

                @forelse($brackets as $index => $bracket)

                    <tr class="border-t">

                        @if($isEditing)

                            <td class="p-4">

                                <input
                                    type="number"
                                    step="0.01"
                                    wire:model="brackets.{{ $index }}.min_amount"
                                    class="w-full border rounded-lg p-2">

                            </td>

                            <td class="p-4">

                                <input
                                    type="number"
                                    step="0.01"
                                    wire:model="brackets.{{ $index }}.max_amount"
                                    class="w-full border rounded-lg p-2">

                            </td>

                            <td class="p-4">

                                <input
                                    type="number"
                                    step="0.01"
                                    wire:model="brackets.{{ $index }}.base_tax"
                                    class="w-full border rounded-lg p-2">

                            </td>

                            <td class="p-4">

                                <input
                                    type="number"
                                    step="0.01"
                                    wire:model="brackets.{{ $index }}.percentage"
                                    class="w-full border rounded-lg p-2">

                            </td>

                            <td class="p-4 text-center">

                                <button
                                    wire:click="removeBracket({{ $index }})"
                                    class="text-red-600 hover:text-red-800">

                                    Delete

                                </button>

                            </td>

                        @else

                            <td class="px-6 py-4">
                                ₱{{ number_format($bracket['min_amount'], 2) }}
                            </td>

                            <td class="px-6 py-4">

                                @if($bracket['max_amount'])

                                    ₱{{ number_format($bracket['max_amount'], 2) }}

                                @else

                                    No Limit

                                @endif

                            </td>

                            <td class="px-6 py-4">
                                ₱{{ number_format($bracket['base_tax'], 2) }}
                            </td>

                            <td class="px-6 py-4">
                                {{ number_format($bracket['percentage'], 2) }}%
                            </td>

                        @endif

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-10 text-gray-500">

                            No tax brackets found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
