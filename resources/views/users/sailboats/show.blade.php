<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__("User Details")}}
            </h2>
        </div>
    </x-slot>
    <div class="row g-2 pt-20 ">
        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
            <div class=" flex justify-center p-0">
                <div class=" mx-auto sm:px-6 lg:px-4">
                    <div class=" p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="flex justify-center bg-white  ">
                            <div > 
                                <img class="rounded-circle  w-20 h-20"   src="{{($user->profile_photo_url)}}" alt="">
                                <h1 class=" font-bold py-2"> {{$user->name}}</h1>                              
                            </div>
                        </div>
                        <div class=" flex justify-center sm:px-6 sm:rounded-bl-md sm:rounded-br-md" >
                            <x-jet-link href="{{ route('users.edit', $user->id) }}" class="btn bg-danger text-white ">
                                {{ __('Edit Profile') }}
                            </x-jet-link>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class=" mx-auto sm:px-6 lg:px-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex pr-4 ">
                            <div class="px-6 mb-4">
                                <h1 class="font-bold py-4">Name</h1>
                                <h1 class="font-bold py-4">Status</h1>
                                <h1 class="font-bold py-4">Gender</h1>
                                <h1 class="font-bold py-4">Age</h1> 
                                <h1 class="font-bold py-4">Email</h1>
                                <h1 class="font-bold py-4">Phone</h1>
                                <h1 class="font-bold py-4">City</h1>
                                <h1 class="font-bold py-4">State</h1>
                                <h1 class="font-bold py-4">Zipcode</h1>
                                <h1 class="font-bold py-4">sailing_experience</h1>
                                <h1 class="font-bold py-4">Preferred_Type</h1>
                                <h1 class="font-bold py-4">Household_Income</h1>
                                <h1 class="font-bold py-4">Own a Sailboat</h1>
                                <h1 class="font-bold py-4">Vender ID</h1>
                            </div>
                            <div class="px-4 mb-4">
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1> 
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                                <h1 class="font-bold py-4">:</h1>
                            </div>
                            @if ($userProfile && $user)
                                @php
                                    if($userProfile->preferred_type){
                                        $preferred_types =json_decode($userProfile->preferred_type);
                                    }
                                @endphp   
                                <div class="px-4 mb-4">
                                    <div class="pr-4">
                                        <h1 class="py-4"> {{$user->name}}</h1>
                                        <h1 class="py-4">{{(!$user->deleted_at ==null ? "User is deactivate" :"Activate") }}</h1>
                                        <h1 class="py-4"> {{$userProfile->gender}}</h1>
                                        <h1 class="py-4"> {{$userProfile->age}}</h1>
                                        <h1 class="py-4"> {{$user->email}}</h1>
                                        <h1 class="py-4"> {{$userProfile->phone}}</h1>
                                        <h1 class="py-4"> {{$userProfile->city}}</h1>
                                        <h1 class="py-4"> {{$userProfile->state}}</h1>
                                        <h1 class="py-4"> {{$userProfile->zipcode}}</h1>
                                        <h1 class="py-4"> {{$userProfile->sailing_experience}}</h1>
                                        <h1 class=" flex py-4">
                                        @foreach ( $preferred_types as $key => $preferredItem)  
                                            {{$preferredItem}},                                    
                                        @endforeach
                                        </h1>   
                                        <h1 class="py-4"> {{$userProfile->household_income}}</h1>
                                        <h1 class="py-4"> {{$userProfile->is_sailboat_owner}}</h1>
                                        <h1 class="py-4"> {{$userProfile->vendor_id}}</h1>
                                    </div>
                                </div>
                            @else
                                <div class=" w-full py-4">
                                    <div class=" mx-auto sm:px-6 lg:px-4">
                                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="p-6 bg-white border-b border-gray-200">
                                                <div class="flex pr-4 ">
                                                    <div class="w-full">
                                                        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl " > Sorry,User profile is not found</h1>
                                                    </div>
                                                </div>
                                            </div>     
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>       
            </div>
        </div>  
    </div>
</x-app-layout>