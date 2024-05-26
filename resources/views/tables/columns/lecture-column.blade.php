<div class="flex flex-col justify-center items-center gap-y-3 w-full">
    <div class="text-2xl font-bold">{{$getRecord()->subject->name}}</div>
    <div class="font-bold">د/{{$getRecord()->doctor->name}}</div>
    <div class="">
        @foreach($getRecord()->departments as $department)
            <span class="px-1">{{$department->slug}}{{$getRecord()->level->slug}}</span>
        @endforeach
    </div>
    <div class="">{{ $getRecord()->classRoom->name }}</div>
    <div class="flex justify-between items-center gap-x-3">
        <div class="bg-primary-500/10 p-2 text-primary-500 rounded-md ">{{$getRecord()->start}}</div> -->
        <div class="bg-primary-500/10 p-2 text-primary-500 rounded-md ">{{$getRecord()->end}}</div>
    </div>
</div>
