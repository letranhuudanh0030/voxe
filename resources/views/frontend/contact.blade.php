@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/title.css') }}">
@endsection

@section('content')
    <section id="contact">
        <div class="row">
            <div class="col-12 col-xl-11 mx-auto">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <x-title>
                            <x-slot name='title'>Thông tin công ty</x-slot>
                            <x-slot name='class'>col-12</x-slot>
                            <x-slot name='classBlock'>title-left</x-slot>
                        </x-title>
                        <div class="content">
                            {!! $configContact->contact_page !!}
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <x-title>
                            <x-slot name='title'>Liên hệ</x-slot>
                            <x-slot name='class'>col-12</x-slot>
                            <x-slot name='classBlock'>title-left</x-slot>
                        </x-title>
                        @include('frontend.components.contact.form_contact')
                    </div>
                    <div class="col-12">
                        {!! $configContact->work_footer !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    
@endsection