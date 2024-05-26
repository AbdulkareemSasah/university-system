<x-filament::page>
    <div class="mx-auto w-full">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                <tr class="bg-gray-200 dark:bg-gray-800 border">
                    <th class="px-4 py-2 font-semibold border">Day</th>
                    @foreach ($data[1] as $dataLevels)
                        <th class="px-4 py-2 font-semibold border">{{ $dataLevels['level']->name }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($data as $day => $row)
                    <tr @class(["border"])>
                        <th class="px-4 py-2 border font-semibold">{{ $this->list_days($day) }}</th>
                        @foreach($row as $levelData)
                            <td class="px-4 py-2 border space-y-2">
                                @foreach($levelData['lectures'] as $lecture)
                                    @if(isset($lecture->doctor_id))
                                    <x-filament::section  @class(["flex space-y-2 bg-transparent flex-col justify-center items-center text-center"])>
                                        <div class="space-y-2">
                                            <div class="text-2xl font-bold">{{$lecture->subject->name}}</div>
                                            <div class="font-bold">د/{{$lecture->doctor->name}}</div>
                                            <div class="">
                                                @foreach($lecture->departments as $department)
                                                    <span class="px-1">{{$department->slug}}{{$lecture->level->slug}}</span>
                                                @endforeach
                                            </div>
                                            <div class="">{{ $lecture->classRoom->name }}</div>
                                            <div class="flex justify-between items-center gap-x-3">
                                                <div class="bg-primary-500/10 p-2 text-primary-500 rounded-md ">{{$lecture->start}}</div>
                                                >
                                                <div class="bg-primary-500/10 p-2 text-primary-500 rounded-md ">{{$lecture->end}}</div>
                                            </div>
                                        </div>
                                    </x-filament::section>
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page>
