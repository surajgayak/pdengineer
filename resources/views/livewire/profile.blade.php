    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-4">
            <div class="card author-box">
                <div class="card-body">
                    <div class="author-box-center">
                        {{-- <img alt="image" src="{{ asset('backend/assets/img/users/user-1.png') }}"
                            class="rounded-circle author-box-picture"> --}}

                        @if ($avatar)
                            <img class="img-responsive rounded-circle author-box-picture mb-2"
                                src="{{ $avatar->temporaryUrl() }}" alt="" width="100" height="90">
                        @else:
                            <img class="img-responsive rounded-circle author-box-picture mb-2"
                                src="{{ Storage::url($oldAvatar) }}" alt="" width="60" height="60">
                        @endif
                        <div class="clearfix"></div>
                        <div class="author-box-name">
                            <a href="#">
                                {{auth()->user()->fname . ' '. auth()->user()->lname}}
                            </a>
                        </div>
                        <div class="author-box-job">{{auth()->user()->position}}</div>
                    </div>
                    {{-- <div class="text-center">
                        <div class="author-box-description">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptatum alias
                                molestias
                                minus quod dignissimos.
                            </p>
                        </div>

                    </div> --}}
                </div>
            </div>

        </div>
        <div class="col-12 col-md-12 col-lg-8">
            <div class="card">
                <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab2" data-toggle="tab" href="#settings"
                                role="tab" aria-selected="true">Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="password-tab2" data-toggle="tab" href="#password" role="tab"
                                aria-selected="false">Manage Password</a>
                        </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">

                        <div class="tab-pane fade show active" id="settings" role="tabpanel"
                            aria-labelledby="profile-tab2">
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <form wire:submit.prevent='updateProfile'>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-danger" wire:loading wire:target='avatar'>Uploading...
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Profile Image</label>
                                            <input wire:model='avatar' type="file" class="form-control"
                                                value="{{ old('avatar') }}" name="avatar">

                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>First Name <span class="text-danger">*</span>
                                                @error('firstName')
                                                    <span class="font- text-danger ml-1" style="font-size: 12px;"> [
                                                        {{ $message }} ]</span>
                                                @enderror
                                            </label>
                                            <input wire:model='firstName' type="text"
                                                class="form-control @error('firstName') is-invalid @enderror"
                                                name="firstName">

                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Last Name</label>
                                            <input wire:model.defer='lastName' type="text" class="form-control"
                                                value="{{ old('lastName') ?? $lastName }}" name="lastName">

                                        </div>

                                        <div class="form-group col-md-6 col-12">
                                            <label>Email
                                                <span class="text-danger">*</span>
                                                @error('email')
                                                    <span class="font- text-danger ml-1" style="font-size: 12px;"> [
                                                        {{ $message }} ]</span>
                                                @enderror

                                            </label>
                                            <input wire:model.defer='email' type="email" class="form-control" value=""
                                                name="email">

                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Phone
                                                <span class="text-danger">*</span>
                                                @error('phone_no')
                                                    <span class="font- text-danger ml-1" style="font-size: 12px;"> [
                                                        {{ $message }} ]</span>
                                                @enderror
                                            </label>
                                            <input wire:model.defer='phone_no' type="tel" class="form-control"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class=" col-md-6 col-12 ">
                                            <div class="form-check d-md-flex d-lg-flex">

                                                @foreach (GenderType::getAllGenderType() as $key => $value)
                                                    <div
                                                        class="custom-control custom-radio {{ $loop->iteration == 2 ? 'mx-md-4 mx-lg-4' : '' }}">
                                                        <input wire:model.defer='gender' type="radio"
                                                            id="customRadio{{ $value }}" name="gender"
                                                            class="custom-control-input" value="{{ $value }}">
                                                        <label class="custom-control-label"
                                                            for="customRadio{{ $value }}">{{ $key }}</label>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-2">Save Changes</button>
                            </form>
                        </div>

                    </div>



                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab2">
                        <div class="card-header">
                            <h4>Change Password</h4>
                        </div>
                        <div class="card-body">
                            @livewire('change-password')
                        </div>

                    </div>






                </div>
            </div>
        </div>
    </div>
    </div>
