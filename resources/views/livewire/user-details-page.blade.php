<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session()->has('updateMessage'))
            <div class="alert alert-success">
                {{ session('updateMessage') }}
            </div>
        @endif
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="form-box-search section-padding pt-0">
                    <div class="container">
                        <form>
                            <div class="form-section">
                                <div class="row g-4">
                                    <div class="col-lg-4 col-md-6 col-12" >
                                        <x-jet-input type="text" class=" rounded w-full " style="border: 1px solid rgb(167, 166, 166)"  placeholder="Name" wire:model="name" />                                      
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12" >
                                        <x-jet-input type="text" class=" rounded w-full " style="border: 1px solid rgb(167, 166, 166)"  placeholder="Email" wire:model="email" />                                      
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12" >
                                        <x-jet-input type="number" class=" rounded w-full " style="border: 1px solid rgb(167, 166, 166)" placeholder="Phone" wire:model="phone" />                                      
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12" >
                                        <select style="color:rgb(107, 105, 105); border:1px solid rgb(167, 166, 166);" class=" rounded form-select form-control" id="gender" wire:model="gender"   >
                                            <option value="" >--Gender--</option>
                                            @foreach ($options['gender'] as $key => $item)
                                               <option value="{{$item}}" >{{$item}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12" wire:ignore>
                                        <select class="js-select2 form-select form-control" id="city" wire:model="city" multiple="multiple">
                                            @foreach ($options['city'] as $key => $item)
                                                <option value="{{$item}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                    <div class="col-lg-4 col-md-6 col-12" wire:ignore>
                                        <select class="js-select2 form-select form-control" id="state" wire:model="state" multiple="multiple">
                                            @foreach ($options['state'] as $key => $item)
                                                <option value="{{$item}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                            </div>
                        </form>     
                    </div>
                </section>
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
                                    <th class="border px-6 py-4">Name</th>
                                    <th class="border px-6 py-4">Email</th>
                                    <th class="border px-6 py-4">Role</th>
                                    <th class="border px-6 py-4">Actions</th>
                                </tr>
                            </thead>
                            
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <tr>
                                        <td class="border px-6 py-4">{{$user->name}}</td>
                                        <td class="border px-6 py-4">{{$user->email}}</td>
                                        <td class="border px-6 py-4">{{$user->role}}</td>
                                        <td class="border px-6 py-4">
                                            <form method="post" 
                                                action="{{ route('users.destroy', $user->id) }}" 
                                                class="del-form">
                                                @csrf
                                                @method('DELETE')
                                                <x-jet-link href="{{ route('users.edit', $user->id) }}">
                                                    {{ __('Edit') }}
                                                </x-jet-link>
                                                <button  type="submit" onClick="return confirm('Are you sure you want to delete userData?')">
                                                    {{ __('Delete') }}
                                                </button>
                                                <x-jet-link href="{{ route('users.show', $user->id) }}">
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
                         {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
         $("#city").select2({
			closeOnSelect : false,
            placeholder :" City",
			allowClear: true,
			tags: true 
		});
        $('#city').on('change',function(){
            @this.city=$(this).val();
        })
        $("#state").select2({
			closeOnSelect : false,
            placeholder :" State",
			allowClear: true,
			tags: true 
		});
        $('#state').on('change',function(){
            @this.state=$(this).val();
        })
    </script>
</div>
