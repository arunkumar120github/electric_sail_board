<div>
    <div class="py-6">
        <form wire:submit.prevent="{{ $this->user && $this->profile ? 'updateUser' : 'createUser' }}" enctype ="multipart/form-data">
            <div >
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <section class="form-box-search section-padding pt-0">
                                <div class="container">
                                    <div class="form-section">
                                        <div class="row g-2 ">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="flex  items-center justify-center p-0" >
                                                    <span class=" flex justify-center">
                                                        @if ($this->user)
                                                            <img class="rounded-circle w-1/2" src="{{($user->profile_photo_url)}}" alt="" style="width: 100px"> 
                                                        @else
                                                            <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="" style="width: 100px"> 
                                                        @endif
                                                    </span>
                                                </div>
                                                <input type="file" wire:model="photo" id="profile_pic" style="display: none">
                                                <div class="flex  items-center justify-center py-3 sm:px-6 sm:rounded-bl-md sm:rounded-br-md" >
                                                    <a href="javaSacript:void(0)"  class="btn sm:px-6 bg-dark text-white" id="profile_pic_btn" >
                                                        {{ __('Upload Photo') }}
                                                    </a>
                                                </div>                
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class=" col-12 py-1" >
                                                    <x-jet-label for="password" value="{{__('Password')}}" />
                                                    <x-jet-input id="password" type="password" class="mt-1  w-full" placeholder="Password" name='password' wire:model.lazy="password" />
                                                    <x-jet-input-error for="password" class="mt-2" />
                                                </div>
                                                <div class=" col-12 py-1" >
                                                    <x-jet-label for="password" value="{{__('Confirm Password')}} " />
                                                    <x-jet-input  wire:model.lazy="password_confirmation" class="mt-1 block w-full" placeholder="Confirm Password" type="password" id="password_confirmation" name="password_confirmation" />
                                                    <x-jet-input-error for="password_confirmation" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto sm:px-2 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <section class="form-box-search section-padding pt-0">
                                <div class="container">
                                    <div class="form-section">
                                        <div class="row g-2 ">
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                                <x-jet-input id="name" type="text" class="mt-1 block w-full" placeholder="Name" wire:model="name" />
                                                <x-jet-input-error for="name" class="mt-2" />  
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                                <x-jet-input id="email" type="text" class="mt-1 block w-full" placeholder="Email" wire:model="email" />
                                                <x-jet-input-error for="email" class="mt-2" />  
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="age" value="{{ __('Age') }}" />
                                                <x-jet-input id="age" type="text" class="mt-1 block w-full" placeholder="Age" wire:model="age" />
                                                <x-jet-input-error for="age" class="mt-2" />  
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                                                <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="gender">
                                                    <option value="null" disabled>--Gender--</option>
                                                            <option value="Male" >Male</option>
                                                            <option value="Female" >Female</option>
                                                            <option value="Other" >Other</option>
                                                    </option>            
                                                </select>
                                                <x-jet-input-error for="gender" class="mt-2" />
                                            </div> 
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                                                <x-jet-input id="phone" type="text" class="mt-1 block w-full" placeholder="Phone" wire:model="phone" />
                                                <x-jet-input-error for="phone" class="mt-2" />  
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="city" value="{{ __('City') }}" />
                                                <x-jet-input id="city" type="text" class="mt-1 block w-full" placeholder="City" wire:model="city" />
                                                <x-jet-input-error for="city" class="mt-2" />  
                                            </div> 
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="state" value="{{ __('State') }}" />
                                                <x-jet-input id="state" type="text" class="mt-1 block w-full" placeholder="State" wire:model="state" />
                                                <x-jet-input-error for="state" class="mt-2" />  
                                            </div>                                           
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="householdIncome" value="{{ __('Household Income') }}" />
                                                <x-jet-input id="householdIncome" type="text" class="mt-1 block w-full" placeholder="Household Income" wire:model="householdIncome" />
                                                <x-jet-input-error for="householdIncome" class="mt-2" />  
                                            </div> 
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="zipcode" value="{{ __('Zipcode') }}" />
                                                <x-jet-input id="zipcode" type="text" class="mt-1 block w-full" placeholder="Zipcode" wire:model="zipcode" />
                                                <x-jet-input-error for="zipcode" class="mt-2" />  
                                            </div> 
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="vendorId" value="{{ __('Vendor Id') }}" />
                                                <x-jet-input id="vendorId" type="text" class="mt-1 block w-full" placeholder="Vendor Id" wire:model="vendorId" />
                                                <x-jet-input-error for="vendorId" class="mt-2" />  
                                            </div> 
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="role" value="{{ __('Role') }}" />
                                                <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="role">
                                                    <option value="null" disabled>--Select--</option>
                                                            <option value="Member" >Member</option>
                                                            <option value="Admin" >Admin</option>
                                                    </option>            
                                                </select>
                                                <x-jet-input-error for="role" class="mt-2" />
                                            </div> 
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="isSailboatOwner" value="{{ __(' Sailboat Owner') }}" />
                                                <div class="flex pt-2 ">
                                                    <div class="flex p-2"><x-jet-input  type="radio" id="radio" wire:model='isSailboatOwner' value="1" /><x-jet-label class="px-2" for="yes" value="Yes" /></div>
                                                    <div class="flex p-2"><x-jet-input  type="radio" id="radio" wire:model='isSailboatOwner' value="0" /><x-jet-label class="px-2" for="no" value="No" /></div>
                                                </div>
                                                <x-jet-input-error for="isSailboatOwner" class="mt-2" />
                                            </div> <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="sailing_experience" value="{{ __('Sailing Experience') }}" />
                                                <div class="flex pt-2 ">
                                                    <div class="flex p-2"><x-jet-input  type="radio" id="radio" wire:model='sailingExperience' value="Beginner" /><x-jet-label class="px-1" for="Beginner" value="Beginner" /></div>
                                                    <div class="flex p-2"><x-jet-input  type="radio" id="radio" wire:model='sailingExperience' value="Intermediate" /><x-jet-label class="px-1" for="no" value="Intermediate" /></div>
                                                    <div class="flex p-2"><x-jet-input  type="radio" id="radio" wire:model='sailingExperience' value="Exprience" /><x-jet-label class="px-1" for="no" value="Exprience" /></div>
                                                </div>
                                                <x-jet-input-error for="sailingExperience" class="mt-2" />
                                            </div> 
                                            <div class="col-lg-6 col-md-6 col-12" >
                                                <x-jet-label for="" value=" {{ __('Preferred Type') }} " />
                                                <div class="flex pt-2 ">
                                                    <div class="flex p-2"><x-jet-input  type="checkbox"  wire:model='preferredType' value="Day_Sailing"/><x-jet-label class="px-lg-1" for="" value="Day_Saling" /></div>
                                                    <div class="flex p-2"><x-jet-input  type="checkbox"  wire:model='preferredType' value="Racing" /><x-jet-label class="px-lg-1" for="" value="Racing" /></div>
                                                    <div class="flex p-2"><x-jet-input  type="checkbox"  wire:model='preferredType' value="Cruising" /><x-jet-label class="px-lg-1" for="" value="Cruising" /></div>
                                                    <div class="flex p-2"><x-jet-input  type="checkbox"  wire:model='preferredType' value="Blue_Water" /><x-jet-label class="px-lg-1" for="" value="Blue_Water" /></div>
                                                </div>
                                                <x-jet-input-error for="preferred_type" class="mt-2" />
                                            </div> 
                                        </div>
                                    </div>                               
                                </div>
                                <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                                    <x-jet-button>
                                        {{ __('Save Details') }}
                                    </x-jet-button>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </form>       
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#profile_pic_btn').click(function()  { 
            $('#profile_pic').click()
        })
    });
</script>
