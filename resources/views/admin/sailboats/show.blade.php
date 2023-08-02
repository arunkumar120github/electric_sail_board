<x-app-layout>
 <div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="">
                    <div class="flex justify-between ">
                        <h1 class="italic">{{$sailboat->title}}</h1>
                        <div class="flex justify-between ">
                            <h1 class="p-2"><i class="fa fa-thumbs-up"></i> {{$sailboat->likes->count('id') }}</h1>
                            <h1 class="p-2"><i class="fa fa-heart"></i> {{$sailboat->favourites->count('id') }}</h1>
                        </div>
                    </div>
                    <h1 class="text-2xl">{{$sailboat->year}}</h1>
                </div>
                <div class="flex ">
                    <div class="w-full"> 
                        <div class="slider-for " style="width:500px;">
                            @foreach ($sailboat->photos as $item)
                                <div class="slick-list" >
                                    <img style="width:500px;" src="{{asset('storage/'.$item->image_path)}}">
                                </div>
                            @endforeach
                            @foreach ($sailboat->videos as $item)
                                <div class="slick-list" >
                                    <iframe src=" http://player.vimeo.com/video/{{$item->vimeo_id}} " width="500px" height="450" frameborder="0"></iframe>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class=" w-full">
                        <div class="flex ">
                            <div class='p-6 pt-0 '>
                                <h1 class="text-sm">Loa</h1>
                                <h1 class="font-bold uppercase">{{$sailboat->loa}}</h1>
                            </div>
                            <div class="p-6 pt-0">
                                <h1 class="text-sm">Displacement</h1>
                                <h1 class="font-bold uppercase ">{{$sailboat->displacement}}</h1>
                            </div>
                        </div>
                        <div class="flex ">
                            <div class='p-6 pt-1'>
                                <h1 class="text-sm">Motor </h1>
                                {{$sailboat->manufacturer}}
                                <h1 class="font-bold uppercase">{{$sailboat->motor}}</h1>
                            </div>
                            <div class="p-6 pt-1">
                                <h1 class="text-sm">Battery Brand</h1>
                                <h1 class="font-bold uppercase">{{$sailboat->battery_brand}}</h1>
                            </div>
                        </div>
                        <div class="flex">
                            <div class='p-6 pt-1'>
                                <h1 class="text-sm">Battery Type</h1>
                                <h1 class="font-bold uppercase">{{$sailboat->battery_type}}</h1>
                            </div>
                        </div>
                        <div class="flex ">
                            <div class='p-6 pt-1'>
                                <h1 class="text-sm">Solar Panel</h1>
                                <h1 class="font-bold uppercase">{{$sailboat->solar_panel}}</h1>
                            </div>
                        </div>
                        <div class="flex ">
                            <div class='p-6 pt-2'>
                                <h1 class="text-sm">Wind Generator</h1>
                                <h1 class="font-bold uppercase">{{$sailboat->wind_generator}}</h1>
                            </div>
                            <div class="p-6 pt-2">
                                <h1 class="text-sm">Genset</h1>
                                <h1 class="font-bold uppercase">{{$sailboat->genset}}</h1>
                            </div>
                        </div>
                        <div class="flex ">
                            <div class='p-6 pt-2'>
                                <h1 class="text-sm">Controller</h1>
                                <h1 class="font-bold uppercase">{{$sailboat->controller}}</h1>
                            </div>
                            <div class="p-6 pt-2">
                                <h1 class="text-sm">Type of Sailing</h1>
                                <h1 class="font-bold uppercase">{{$sailboat->sailing_type}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-nav "style="width:500px;">
                        @foreach ($sailboat->photos as $item)
                           <div class="photo">
                                <img class=" px-1/2 " style="width: 110px; height: 80px;" src="{{asset('storage/'.$item->image_path)}}">
                           </div>
                        @endforeach
                        @foreach ($sailboat->videos as $item)
                            @if (($item->vimeo_id)>0)
                                @php
                                    $api_url = "https://vimeo.com/api/v2/video/$item->vimeo_id.json";
                                    $json_data = file_get_contents($api_url);
                                    $response_data = json_decode($json_data);
                                    $user_data = $response_data;
                                    $user_data = array_slice($user_data, 0, 9);
                                    foreach ($user_data as $key => $value) {
                                    $data= $value->thumbnail_small;   
                                    }
                                @endphp
                                <div class="vimg">
                                    <img class=" px-1/2" style="width: 110px; height: 80px;" src="{{$data}}" alt="">
                                </div>
                            @else
                                <tr>
                                    <td colspan="6" class="border px-6 py-4"></td>
                                </tr>
                            @endif    
                        @endforeach
                </div>
                    <div class="py-2">
                        <h1 class="py-4 font-bold uppercase">Description</h1>
                        <div id="readmore">
                            <span class="readmore__content">
                                {{$sailboat->description}}
                            </span>
                            <button class="readmore__toggle" role="switch" aria-checked="true">
                                Read More
                            </button>
                        </div>
                    </div>
                    <div>
                        <h1 class="py-4 font-bold ">FAQs </h1>
                            @if (count($sailboat->faqs)>0)
                                <div class="accordion" id="accordionExample">
                                    @foreach ($sailboat->faqs as $key=> $item)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree_{{$item->id}}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree_{{$item->id}}" aria-expanded="false" aria-controls="collapseThree">
                                                    {{$item->question}}
                                                </button>
                                            </h2>
                                            <div id="collapseThree_{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="headingThree_{{$item->id}}" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    {{$item->answer}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div> 
                            @else
                                <tr>
                                    <td colspan="6" class="border px-6 py-4">Sorry, No question found.</td>
                                </tr>    
                            @endif   
                    </div>
                    <div class="pt-6 " >
                        <h1 class="font-bold">PHOTOS</h1>
                    </div>
                        <div class="flex w-full ">
                            @foreach ($sailboat->photos as $item)
                                <img class=" py-4 pr-4 " width="200px" src="{{asset('storage/'.$item->image_path)}}">
                            @endforeach
                        </div>
                    <div class="pt-6 flex justify-between " >
                        <h1 class="font-bold">VIDEOS</h1>
                    </div>
                    <div class="flex p-2">
                        @foreach ($sailboat->videos as $item)
                            @if (($item->vimeo_id)>0)
                                <div class="py-4 pr-4 "width="320" height="240">
                                    <iframe  src=" http://player.vimeo.com/video/{{$item->vimeo_id}} " frameborder="0"></iframe>
                                </div>
                            @else
                                <tr>
                                    <td colspan="6" class="border px-6 py-4">Sorry, no video found.</td>
                                </tr>
                            @endif
                        @endforeach
                    </div>
                    <div class="pt-6 border-2">
                        <div class="p-2 flex justify-between ">
                            <h1 class="font-bold">COMMENTS</h1>
                        </div>
                        <div class="p-6 border-2">
                            @if (count($sailboat->comments)>0)
                                @foreach ($sailboat->comments as $item)
                                    <div class=" p-6 border-2">
                                        <div class="flex ">
                                            <div class="p-6 flex ">
                                                <img class="rounded-full w-6 " src="{{$item->user->profile_photo_url}}" alt="">
                                                {{$item->user->name}}
                                                {{$item->created_at->diffForHumans()}}
                                            </div>                             
                                        </div>
                                        <div class="p-6">
                                            {{$item->comment}}
                                        </div>
                                    </div><br>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="border px-6 py-4">Sorry, no comments found.</td>
                                </tr>
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/adminShow.js')}}"></script>
</x-app-layout>

