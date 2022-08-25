@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <!-- <h2 class="my-3 text-center">Contacts</h2> -->
                <a href="" class="btn btn-success my-3 add_contact_btn" data-bs-toggle="modal" data-bs-target="#addModal">Add Contact</a>
                <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="Search Here...">

                <div class="table-data">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <!-- <th scope="col">#</th> -->
                            <th scope="col">NAME</th>
                            <th scope="col">COMPANY</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $key=>$contact)
                            <tr>
                                <!-- <th>{{ $key+1 }}</th> -->
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->company }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    <a href=""
                                        class="btn btn-success update_product_form"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateModal"
                                        data-id="{{ $contact->id }}"
                                        data-name="{{ $contact->name }}"
                                        data-company ="{{ $contact->company }}"
                                        data-phone ="{{ $contact->phone }}"
                                        data-email ="{{ $contact->email }}">
                                        <i class="las la-edit"></i>
                                    </a>
                                    <a href=""
                                        class="btn btn-danger delete_contact_form"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-id="{{ $contact->id }}">
                                        <i class="las la-times"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $contacts->render() !!}

                </div>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            </div>
        </div>
    </div>

    @include('add_contact_modal')
    @include('update_contact_modal')
    @include('delete_contact_modal')
    @include('contact_js')
    {!! Toastr::message() !!}
@endsection
