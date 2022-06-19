<!--Author: Loh Wei Sheng -->
@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add New Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Admin</li>
                    </ol>
                </nav>
            </div>






        </div>

        <div id="app">
            @include('backend.admin.flash-message')
            
            @yield('content')
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="{{ route('store.admin') }}" method="POST">
                        @csrf

                        <div class="card">
                            <div class="card-header">New Admin</div>

                            <div class="card-body">

                                <div class="mb-3">
                                    <x-jet-label for="name" value="{{ __('Name') }}" />
                                    <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>

                                <div class="mb-3">
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                    <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                                </div>

                                <div class="mb-3">
                                    <x-jet-label for="roleID" value="{{ __('Register as:') }}" />
                                    <select name="roleID" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo=200 focus:ring-opacity-50 rounded-md shadow-sm">                                 
                                        <option value="2" @if (old('roleID')==2) selected @endif'>Admin</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <x-jet-label for="password" value="{{ __('Password') }}" />
                                    <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                                </div>

                                <div class="mb-3">
                                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>












@endsection 