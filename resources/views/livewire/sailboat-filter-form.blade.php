<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="form-box-search section-padding pt-0">
                        <div class="container">
                            <form>
                                <div class="form-section">
                                    <div class="row g-4 ">
                                        <div class="col-lg-4 col-md-6 col-12" wire:ignore>   
                                            <select  class="js-select2 form-select form-control" id="select2Displacement" wire:model="displacement" multiple="multiple" >
                                                @foreach ($options['displacements'] as $key => $item)
                                                    <option>{{$item}}</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-12" wire:ignore>
                                            <select class="js-select2 form-select form-control" id="battery_type"  wire:model='battery_type'   multiple="multiple">                   
                                                @foreach ($options['battery_types'] as $key => $item)
                                                    <option  value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-12" wire:ignore>
                                            <select class="js-select2 form-select form-control" id="genset" wire:model="genset"   multiple="multiple">
                                                @foreach ($options['gensets'] as $key => $item)
                                                     <option  value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-12" wire:ignore>
                                            <select class="js-select2 form-select form-control" id="sailing_type"  wire:model="sailing_type"  multiple="multiple">   
                                                @foreach ($options['sailing_types'] as $key => $item)
                                                    <option value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-12" wire:ignore>
                                            <select class="js-select2 form-select form-control" id="motor"  wire:model="motor"  multiple="multiple">
                                                @foreach ($options['motors'] as $key => $item)
                                                    <option value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-12" wire:ignore>
                                            <select class="js-select2 form-select form-control" id="status" wire:model="status"  multiple="multiple">
                                                @foreach ($options['status'] as $key => $item)
                                                    <option value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="col-lg-4 col-md-6 col-12 text-center">
                                            <x-jet-label for="age" value="{{ __('Age') }}" />
                                            <div class="container-range">
                                                <x-jet-input type="range" wire:click='ageIncrement' min="20" max="100" class=" w-full thumbM thumb--left" value="0" wire:model='age'/>
                                                <div class="slider">
                                                    <div class="flex justify-center ">
                                                        <div class="px-4 thumbM thumb--left">{{$age ? $age : "User Age" }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </form>     
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">    
                    <div class="table-responsive">            
                        <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
                            <thead>
                                <tr class="text-left font-bold">
                                    <th class="border px-6 py-4">Title</th>
                                    <th class="border px-6 py-4">Manufacturer</th>
                                    <th class="border px-6 py-4">Displacement</th>
                                    <th class="border px-6 py-4">Model</th>
                                    <th class="border px-6 py-4">Status</th>
                                    <th class="border px-6 py-4">Actions</th>
                                </tr>
                            </thead> 
                            @if(count($sailboats) > 0)
                                @foreach($sailboats as $sailboat)
                                    <tr>
                                        <td class="border px-6 py-4">{{$sailboat->title}}</td>
                                        <td class="border px-6 py-4">{{$sailboat->manufacturer}}</td>
                                        <td class="border px-6 py-4">{{$sailboat->displacement}}</td>
                                        <td class="border px-6 py-4">{{$sailboat->model}}</td>
                                        <td class="border px-6 py-4">{{$sailboat->status}}</td>
                                        <td class="border px-6 py-4">
                                            <form method="post" 
                                                action="{{ route('sailboats.destroy', $sailboat->id) }}" 
                                                class="del-form">
                                                @csrf
                                                @method('DELETE')
                                                <x-jet-link href="{{ route('sailboats.edit', $sailboat->id) }}">
                                                    {{ __('Edit') }}
                                                </x-jet-link>
                                                <x-jet-danger-button type="submit" onClick="return confirm('Are you sure you want to delete Sailboat?')">
                                                    {{ __('Delete') }}
                                                </x-jet-danger-button>
                                                <x-jet-link href="{{ route('sailboats.show', $sailboat->id) }}">
                                                    {{ __('Show') }}
                                                </x-jet-link>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="border px-6 py-4 text-gray-500">Sorry, no records found. You can try creating new sailboats.</td>
                                </tr>
                            @endif
                        </table>
                    </div>    
                    <div class="mt-6">
                        {{$sailboats->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>    
   <script>
        $('#select2Displacement').on('change',function() {
            @this.displacement=$(this).val();
        })
        $('#battery_type').on('change',function() {
            @this.battery_type=$(this).val();
        })
        $('#motor').on('change',function() {
            @this.motor=$(this).val();
        })
        $('#sailing_type').on('change',function() {
            @this.sailing_type=$(this).val();
        })
        $('#status').on('change',function() {
            @this.status=$(this).val();
        })
        $('#genset').on('change',function() {
            @this.genset=$(this).val();
        })
   </script>
    <script src="{{ asset('js/searchSelect2.js')}}"></script>
</div>


