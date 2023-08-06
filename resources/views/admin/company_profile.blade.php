@extends('layouts.master')
@section('title', 'Company Profile')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Company Profile</span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            <i class="fas fa-edit"></i> Update Company Profile
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        
                            <form method="post" action="{{ route('company.profile.update', $profile->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="title" class="col-sm-3 col-form-label">Company Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="com_name" value="{{ $profile->com_name }}" class="form-control form-control-sm shadow-none" id="com_name">
                                                @error('com_name') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
            
                                            <label for="title" class="col-sm-3 col-form-label">Phone One</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="phone_one" value="{{ $profile->phone_one }}" class="form-control form-control-sm shadow-none" id="phone_one">
                                                @error('phone_one') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
            
                                            {{-- <label for="title" class="col-sm-3 col-form-label">Phone Two</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="phone_two" value="{{ $profile->phone_two }}" class="form-control form-control-sm shadow-none" id="phone_two">
                                                @error('phone_two') <span style="color: red">{{$message}}</span> @enderror
                                            </div> --}}
            
                                            <label for="title" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email" value="{{ $profile->email }}" class="form-control form-control-sm shadow-none" id="email">
                                                @error('email') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
            
                                            {{-- <label for="title" class="col-sm-3 col-form-label">Website</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="website" value="{{ $profile->website }}" class="form-control form-control-sm shadow-none" id="website">
                                                @error('website') <span style="color: red">{{$message}}</span> @enderror
                                            </div> --}}

                                            <label for="title" class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea name="address" rows="2" class="form-control form-control-sm shadow-none">{{ $profile->address }}</textarea>
                                                @error('address') <span style="color: red">{{$message}}</span> @enderror
                                            </div>

                                            <label for="logo" class="col-sm-3 col-form-label">Logo (<small class="text-danger">350×100</small>)</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="logo" class="form-control shadow-none" id="logo" onchange="mainThambUrl(this)">
                                                @error('image') <span style="color: red">{{$message}}</span> @enderror
                                                
                                                <div class="">
                                                    <img src="{{ (!empty($profile)) ? asset($profile->logo) : asset('images/no.png') }}" id="mainThmb" style="width: 100px; height: 100px; border: 1px solid #999; padding: 2px;" alt="">
                                                </div>
                                            </div>
                                            {{-- <label for="contact_image" class="col-sm-3 col-form-label">Contact Image (<small class="text-danger">1920×700</small>)</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="contact_image" class="form-control shadow-none" id="contact_image" onchange="contactThambUrl(this)">
                                                @error('contact_image') <span style="color: red">{{$message}}</span> @enderror
                                                
                                                <div class="">
                                                    <img src="{{ (!empty($profile)) ? asset($profile->contact_image) : asset('images/no.png') }}" id="contact_thum" style="width: 100px; height: 100px; border: 1px solid #999; padding: 2px;" alt="">
                                                </div>
                                            </div> --}}
                                            
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="title" class="col-sm-3 col-form-label">Facebook</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="facebook" value="{{ $profile->facebook }}" class="form-control form-control-sm shadow-none" id="facebook">
                                                @error('facebook') <span style="color: red">{{$message}}</span> @enderror
                                            </div>

                                            <label for="title" class="col-sm-3 col-form-label">Twitter</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="twitter" value="{{ $profile->twitter }}" class="form-control form-control-sm shadow-none" id="twitter">
                                                @error('twitter') <span style="color: red">{{$message}}</span> @enderror
                                            </div>

                                            <label for="title" class="col-sm-3 col-form-label">Youtube</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="youtube" value="{{ $profile->youtube }}" class="form-control form-control-sm shadow-none" id="youtube">
                                                @error('youtube') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
                                            
                                            {{-- <label for="title" class="col-sm-3 col-form-label">Google Plus</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="google" value="{{ $profile->google }}" class="form-control form-control-sm shadow-none">
                                                @error('google') <span style="color: red">{{$message}}</span> @enderror
                                            </div> --}}
                                            
                                            <label for="title" class="col-sm-3 col-form-label">Instagram</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="instagram" value="{{ $profile->instagram }}" class="form-control form-control-sm shadow-none" id="instagram">
                                                @error('instagram') <span style="color: red">{{$message}}</span> @enderror
                                            </div>

                                            <label for="linkedin" class="col-sm-3 col-form-label">LinkedIn</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="linkedin" value="{{ $profile->linkedin }}" class="form-control form-control-sm shadow-none" id="linkedin">
                                                @error('linkedin') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
                                            <label for="whatsapp" class="col-sm-3 col-form-label">Whatsapp</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="whatsapp" value="{{ $profile->whatsapp }}" class="form-control form-control-sm shadow-none" id="whatsapp">
                                                @error('whatsapp') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
                                            {{-- <label for="linkedin" class="col-sm-3 col-form-label">Pinterest</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pinterest" value="{{ $profile->pinterest }}" class="form-control form-control-sm shadow-none" id="pinterest">
                                                @error('pinterest') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
                                            
                                            <label for="title" class="col-sm-3 col-form-label">Map</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="map" value="{{ $profile->map }}" class="form-control form-control-sm shadow-none" id="map">
                                                @error('map') <span style="color: red">{{$message}}</span> @enderror
                                            </div> --}}

                                            {{-- <label for="add_image" class="col-sm-3 col-form-label">Advertis Image (<small class="text-danger">800×800</small>)</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="add_image" class="form-control shadow-none" id="add_image" onchange="addThambUrl(this)">
                                                @error('add_image') <span style="color: red">{{$message}}</span> @enderror
                                                
                                                <div class="">
                                                    <img src="{{ (!empty($profile)) ? asset($profile->add_image) : asset('images/no.png') }}" id="addThmb" style="width: 100px; height: 100px; border: 1px solid #999; padding: 2px;" alt="">
                                                </div>
                                            </div> --}}

                                             <label for="linkedin" class="col-sm-3 col-form-label">Footer Content</label>
                                            <div class="col-sm-9">
                                                <textarea name="footer_text" class="form-control form-control-sm shadow-none" id="" cols="30" rows="5">{{ $profile->footer_text }}</textarea>
                                                {{-- <input type="text" name="footer_text" value=""  id="footer_text"> --}}
                                                @error('footer_text') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
                                            

                                            
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                        <button type="submit" class="btn btn-success shadow-none">Update</button>
                                    </div>
                                </div>
                            </form> 
                        
                         
                    </div>
                </div>  
            </div>
            
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function mainThambUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result).width(100)
                  .height(100);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function addThambUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            $('#addThmb').attr('src',e.target.result).width(100)
                  .height(100);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    
    function contactThambUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            $('#contact_thum').attr('src',e.target.result).width(100)
                  .height(100);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>

@endpush
