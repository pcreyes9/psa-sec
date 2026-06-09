<div class="max-w-7xl mx-auto">

    <form wire:submit="attendanceSettings" class="space-y-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- ATTENDANCE SETTINGS -->
            <div class="bg-white border rounded-2xl p-6">

                <h3 class="text-lg font-semibold mb-5">
                    Attendance Settings
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <x-input-label
                            for="time_in"
                            value="Official Time In" />

                        <x-text-input
                            wire:model="time_in"
                            type="time"
                            class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input-label
                            for="time_out"
                            value="Official Time Out" />

                        <x-text-input
                            wire:model="time_out"
                            type="time"
                            class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input-label
                            for="grace_period"
                            value="Grace Period" />

                        <x-text-input
                            wire:model="grace_period"
                            type="time"
                            class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input-label
                            for="working_hours"
                            value="Working Hours" />

                        <x-text-input
                            wire:model="working_hours"
                            type="number"
                            step="0.5"
                            class="mt-1 block w-full" />
                    </div>

                </div>

            </div>

            <!-- LEAVE SETTINGS -->
            <div class="bg-white border rounded-2xl p-6">

                <h3 class="text-lg font-semibold mb-5">
                    Leave Settings
                </h3>
                <div>

                    <x-input-label
                        for="vacation_leave"
                        value="Vacation Leave Credits" />

                    <x-text-input
                        wire:model="vacation_leave"
                        type="number"
                        step="1"
                        class="mt-1 block w-full" />

                </div>

                <div>

                    <x-input-label
                        for="sick_leave"
                        value="Sick Leave Credits" />

                    <x-text-input
                        wire:model="sick_leave"
                        type="number"
                        step="1"
                        class="mt-1 block w-full" />

                </div>
            </div>

            <!-- NIGHT DIFFERENTIAL -->
            <div class="bg-white border rounded-2xl p-6">

                <h3 class="text-lg font-semibold mb-5">
                    Night Differential
                </h3>

                <div>

                    <x-input-label
                        for="night_diff_start"
                        value="Night Differential Starts" />

                    <x-text-input
                        wire:model="night_diff_start"
                        type="time"
                        class="mt-1 block w-full" />

                </div>

                <div class="mt-4">

                    <x-input-label
                        for="night_diff_rate"
                        value="Night Differential Rate %" />

                    <x-text-input
                        wire:model="night_diff_rate"
                        type="number"
                        step="0.01"
                        class="mt-1 block w-full" />

                </div>

            </div>

            <!-- OT SETTINGS -->
            <div class="bg-white border rounded-2xl p-6">

                <h3 class="text-lg font-semibold mb-5">
                    Overtime Settings
                </h3>

                <div>

                    <x-input-label
                        for="weekday_ot_rate"
                        value="Weekday OT Rate %" />

                    <x-text-input
                        wire:model="weekday_ot_rate"
                        type="number"
                        step="1.00"
                        class="mt-1 block w-full" />

                </div>

                <div>

                    <x-input-label
                        for="weekend_ot_rate"
                        value="Weekend OT Rate %" />

                    <x-text-input
                        wire:model="weekend_ot_rate"
                        type="number"
                        step="1.00"
                        class="mt-1 block w-full" />

                </div>
            </div>

            <!-- Holiday SETTINGS -->
            <div class="bg-white border rounded-2xl p-6">

                <h3 class="text-lg font-semibold mb-5">
                    Holiday Settings
                </h3>

                <div>

                    <x-input-label
                        for="reg_holiday_rate"
                        value="Regular Holiday Rate %" />

                    <x-text-input
                        wire:model="reg_holiday_rate"
                        type="number"
                        step="1.00"
                        class="mt-1 block w-full" />

                </div>

                <div>

                    <x-input-label
                        for="non_working_holiday_rate"
                        value="Non-Working Holiday Rate %" />

                    <x-text-input
                        wire:model="non_working_holiday_rate"
                        type="number"
                        step="1.00"
                        class="mt-1 block w-full" />

                </div>


            </div>

            
        </div>

        <!-- SAVE -->
        <div class="flex justify-end">

            <x-primary-button>

                Save Settings

            </x-primary-button>

        </div>

    </form>

</div>