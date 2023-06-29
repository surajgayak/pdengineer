<x-component::layout>
    <x-slot:title>
        Setting Edit
    </x-slot:title>
    <x-component::breadcrumb title="Settings" :route="route('settings.edit')" />
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <x-component::card card_header="Header" :hasCreate='false'>
                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <img class="img-responsive rounded" src="{{ \Storage::url($setting->logo) }}"
                                    alt="" height="auto" width="250">
                            </div>
                            <div class="col-12 col-md-6 ">
                                <x-component::form.prepend-input label="Company Logo" type='file'
                                    iconName='file-image' name="logo" />
                                <x-component::form.prepend-input label="Contact Number" type='number' iconName='phone'
                                    placeholder="Contact number" name="phone_no" :value="$setting->phone_no" />
                            </div>
                            <div class="col-12 col-md-6">
                                <x-component::form.prepend-input label="Company Email" type='email' name="email"
                                    :value="$setting->email" :hasIcon='false' :hasSvg="true"
                                    svg='M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z'
                                    placeholder="Email" />

                                <x-component::form.prepend-input label="Company Address" type='text' name="address"
                                    :value="$setting->address" :hasIcon='false' :hasSvg="true"
                                    svg='M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z'
                                    placeholder="Address" />
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12">
                                <h6 class="text-dark borderbottom">SEO Optimize</h6>
                                <hr>
                            </div>
                            <div class="col-12 col-md-6">
                                <x-component::form.prepend-input label="Meta Title" type='text' :value="$setting->meta_title"
                                    iconName='marker' name="meta_title" />
                                <x-component::form.textarea label="Meta Keywords" iconName="keyboard"
                                    name="meta_keywords">
                                    {!! $setting->meta_title !!}
                                </x-component::form.textarea>

                                <x-component::form.textarea label="Meta Description" name="meta_description"
                                    iconName="chess-board">
                                    {!! $setting->meta_description !!}

                                </x-component::form.textarea>
                            </div>
                            <div class="col-12 col-md-6">
                                <x-component::form.textarea label="Header Code" name="header_code"
                                    iconName="laptop-code">
                                    {!! $setting->header_code !!}

                                </x-component::form.textarea>
                                <x-component::form.textarea label="Footer Code" name="footer_code" iconName="code">
                                    {!! $setting->footer_code !!}

                                </x-component::form.textarea>
                            </div>
                        </div>
                        <x-component::button name="Update" btnType="primary px-4" />
                    </form>
                </x-component::card>
            </div>

        </div>
    </div>





</x-component::layout>
